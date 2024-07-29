<?php

namespace App\Services;

use App\Models\Product;
use App\Models\VariationAttribute;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductService
{
    public function createProduct(array $data)
    {

        DB::transaction(function () use ($data) {

            try {
                $image = $data['image'];
                $imageName = time() . '.' . $image->extension();
                $image->move(public_path('uploads'), $imageName);
            } catch (\Exception $e) {
                throw new \Exception('File upload failed: ' . $e->getMessage());
            }

            $product = Product::create([
                'name' => $data['name'],
                'sku' => 'SKU' . rand(1000, 9999),
                'unit' => $data['unit'],
                'unit_value' => $data['unit_value'],
                'selling_price' => $data['selling_price'],
                'purchase_price' => $data['purchase_price'],
                'discount' => $data['discount'],
                'tax' => $data['tax'],
                'image' => 'uploads/' . $imageName,
            ]);

            // foreach ($data['variations'] as $variationItem) {
            //     $variation = $product->variations()->create([
            //         'purchase_price' => $variationItem['purchase_price'],
            //         'selling_price' => $variationItem['selling_price'],
            //     ]);

            //     foreach ($variationItem['attributes'] as $attribute) {
            //         VariationAttribute::create([
            //             'variation_id' => $variation->id,
            //             'name' => $attribute['name'],
            //             'value' => $attribute['value'],
            //         ]);
            //     }
            // }
            if (is_array($data['variations'])) {
                foreach ($data['variations'] as $variationItem) {
                    $variation = $product->variations()->create([
                        'purchase_price' => $variationItem['purchase_price'],
                        'selling_price' => $variationItem['selling_price'],
                    ]);

                    if (is_array($variationItem['attributes'])) {
                        foreach ($variationItem['attributes'] as $attribute) {
                            VariationAttribute::create([
                                'variation_id' => $variation->id,
                                'name' => $attribute['name'],
                                'value' => $attribute['value'],
                            ]);
                        }
                    } else {
                        // Handle the case where attributes are not an array
                        Log::error('Attributes are not an array: ' . json_encode($variationItem['attributes']));
                    }
                }
            } else {
                // Handle the case where variations are not an array
                Log::error('Variations are not an array: ' . json_encode($data['variations']));
            }
        }, 5);
    }

    public function deleteProduct(Product $product): void
    {
        $product->delete();
    }
}
