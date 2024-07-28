@extends('scene::layout.app')

@section('title', 'Products Create')
@section('content')
    <main class="mb-5">
        <section class="pos-products">
            <div class="card pos-card-override" style="border-radius: 0">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5>Add Products</h5>
                    <a href="{{ route('products') }}" class="btn btn-primary">All Product</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('store.product') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="productName" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="productName">
                        </div>

                        <div class="mb-3">
                            <label for="productImage" class="form-label">Image</label>
                            <input class="form-control" name="image" type="file" id="productImage">
                        </div>

                        <div class="form-group mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="sellingPrice" class="form-label">Selling Price</label>
                                    <input type="number" class="form-control" id="sellingPrice" name="selling_price"
                                        min="0">
                                </div>

                                <div class="col-md-6">
                                    <label for="purchasePrice" class="form-label">Purchase Price</label>
                                    <input type="number" class="form-control" id="purchasePrice" name="purchase_price"
                                        min="0">
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="discount" class="form-label">Discount (%)</label>
                                    <input type="number" class="form-control" id="discount" name="discount"
                                        min="0">
                                </div>

                                <div class="col-md-6">
                                    <label for="tax" class="form-label">Tax (%)</label>
                                    <input type="number" class="form-control" id="tax" name="tax" min="0">
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="unit" class="form-label">Unit</label>
                                    <input type="text" class="form-control" name="unit" id="unit"
                                        name="selling_price">
                                </div>

                                <div class="col-md-6">
                                    <label for="unitValue" class="form-label">Unit Value</label>
                                    <input type="text" class="form-control" name="unit_value" id="unitValue"
                                        name="purchase_price">
                                </div>
                            </div>
                        </div>

                        <div id="variations-container">
                            <div class="d-flex justify-content-between">
                                <h4>Variations</h4>
                                <button type="button" onclick="addVariation()">Add Variation</button>
                            </div>
                            <div class="variation">
                                <div class="form-group mb-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="sellingPrice" class="form-label">Selling Price</label>
                                            <input type="number" class="form-control" id="sellingPrice"
                                                name="variations[0][selling_price]" min="0">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="purchasePrice" class="form-label">Purchase Price</label>
                                            <input type="number" class="form-control" id="purchasePrice"
                                                name="variations[0][purchase_price]" min="0">
                                        </div>
                                    </div>
                                </div>


                                <div class="attributes-container">
                                    <div class="d-flex justify-content-between">
                                        <h5>Attributes</h5>
                                        <button type="button" onclick="addAttribute(0)">Add Attribute</button>
                                    </div>
                                    <div class="attribute">
                                        <div class="form-group mb-3">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="attributeName" class="form-label">Attribute Name</label>
                                                    <input type="text" class="form-control" id="attributeName"
                                                        name="variations[0][attributes][0][name]" required>

                                                </div>

                                                <div class="col-md-6">
                                                    <label for="attributeValue" class="form-label">Attribute Value</label>
                                                    <input type="text" class="form-control" id="attributeValue"
                                                        name="variations[0][attributes][0][value]" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                    </form>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('scripts')
    <script>
        let variationIndex = 1;
        let attributeIndices = [1];

        function addVariation() {
            const container = document.getElementById('variations-container');
            const newVariation = document.createElement('div');
            newVariation.className = 'variation';
            newVariation.innerHTML = `
    <div class="form-group mb-3">
        <div class="row">
            <div class="col-md-6">
                <label for="sellingPrice" class="form-label">Selling Price</label>
                <input type="number" class="form-control" id="sellingPrice"
                    name="variations[${variationIndex}][selling_price]" min="0" required>
            </div>

            <div class="col-md-6">
                <label for="purchasePrice" class="form-label">Purchase Price</label>
                <input type="number" class="form-control" id="purchasePrice"
                    name="variations[${variationIndex}][purchase_price]" min="0" required>
            </div>
        </div>
    </div>


    <div class="attributes-container">
        <div class="d-flex justify-content-between">
            <h5>Attributes</h5>
            <button type="button" onclick="addAttribute(${variationIndex})">Add Attribute</button>
        </div>
        <div class="attribute">
            <div class="form-group mb-3">
                <div class="row">
                    <div class="col-md-6">
                        <label for="attributeName" class="form-label">Attribute Name</label>
                        <input type="text" class="form-control" id="attributeName"
                            name="variations[${variationIndex}][attributes][0][name]" required>
                    </div>

                    <div class="col-md-6">
                        <label for="attributeValue" class="form-label
                        ">Attribute Value</label>
                        <input type="text" class="form-control" id="attributeValue"
                            name="variations[${variationIndex}][attributes][0][value]" required>
                    </div>
                </div>
            </div>
        </div>
    </div>
    `;
            container.appendChild(newVariation);
            attributeIndices[variationIndex] = 1;
            variationIndex++;
        }

        function addAttribute(variationIndex) {
            const container = document.querySelector(`.variation:nth-child(${variationIndex + 1}) .attributes-container`);
            const newAttribute = document.createElement('div');
            newAttribute.className = 'attribute';
            newAttribute.innerHTML = `
    <div class="form-group mb-3">
        <div class="row">
            <div class="col-md-6">
                <label for="attributeName" class="form-label">Attribute Name</label>
                <input type="text" class="form-control" id="attributeName"
                    name="variations[${variationIndex}][attributes][${attributeIndices[variationIndex]}][name]" required>
            </div>

            <div class="col-md-6">
                <label for="attributeValue" class="form-label">Attribute Value</label>
                <input type="text" class="form-control" id="attributeValue"
                    name="variations[${variationIndex}][attributes][${attributeIndices[variationIndex]}][value]" required>
            </div>
        </div>
    </div>
    `;
            container.appendChild(newAttribute);
            attributeIndices[variationIndex]++;
        }
    </script>
@endpush
