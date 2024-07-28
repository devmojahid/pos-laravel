@extends('scene::layout.app')

@section('title', 'Products List')
@section('content')
    <main class="products">
        <section class="pos-products">
            <div class="card pos-card-override">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5>All Products</h5>
                    <a href="{{ route('add.product') }}" class="btn btn-primary">Add Product</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Image</th>
                                <th scope="col">Selling Price</th>
                                <th scope="col">Purchase Price</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td>{{ $product->name }}</td>
                                    <td>
                                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" width="50">
                                    </td>
                                    <td>${{ $product->selling_price }}</td>
                                    <td>${{ $product->purchase_price }}</td>
                                    <td>
                                        <form action="" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">
                                        <h2>No Product Found</h2>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                        @if ($products->hasPages())
                            <tfoot>
                                <tr>
                                    <td colspan="6">
                                        {{ $products->links('pagination::bootstrap-5') }}
                                    </td>
                                </tr>
                            </tfoot>
                        @endif
                    </table>
                </div>
            </div>
        </section>
    </main>
@endsection
