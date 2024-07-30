@extends('scene::layout.app')

@section('title', 'POS')
@section('content')
    <main class="pos">
        <section class="pos-products">
            <div class="card pos-card-override">
                <div class="card-header">
                    Product section
                </div>
                <div class="card-body">
                    <form class="pos-search">
                        <input type="search" name="q" placeholder="Search items..." value="{{ request()->get('q') }}"
                            id="search">

                    </form>
                    <ul class="pos-products-list">
                        @forelse ($products as $product)
                            <li>
                                <button class="pos-product-item" data-id="{{ $product->id }}">
                                    <figure><img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                                            width="50" height="80">
                                        <h3>{{ $product->name }}</h3>
                                    </figure>
                                    <div class="pos-product-price">
                                        <span>
                                            @if ($product->discount > 0)
                                                <del>${{ $product->selling_price }}</del>
                                                ${{ $product->selling_price - ($product->selling_price * $product->discount) / 100 }}
                                            @else
                                                ${{ $product->selling_price }}
                                            @endif
                                        </span>
                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                            <title>Add</title>
                                            <path
                                                d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 13h-5v5h-2v-5h-5v-2h5v-5h2v5h5v2z" />
                                        </svg>
                                    </div>
                                </button>
                            </li>
                        @empty
                            <li>
                                <h2>No Product Found</h2>
                            </li>
                        @endforelse

                    </ul>
                    <div class="mt-5">
                        {{ $products->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </section>

        <section class="pos-cart flex">
            <div class="card pos-card-override billing-section">
                <div class="card-header">
                    Billing section
                </div>
                <div class="card-body">
                    <table class="pos-cart-products">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                    <div class="card-bottom area">
                        <div class="bottom-cart">
                            <div class="item sub-total">
                                <span>Sub Total</span>
                                <span>$0.00</span>
                            </div>
                            <div class="item discount">
                                <span>Discount(%)</span>
                                <span>0</span>
                            </div>
                            <div class="item tax">
                                <span>Tax (%)</span>
                                <span>0</span>
                            </div>

                            <div class="item total">
                                <span>Total</span>
                                <span>$0.00</span>
                            </div>
                        </div>
                    </div>
                </div>

                <button class="confirm">Place Order</button>
            </div>
            </div>
        </section>
    </main>
@endsection


@push('scripts')
    <script>
        const products = document.querySelectorAll('.pos-product-item');
        const cart = document.querySelector('.pos-cart-products tbody');
        const subTotal = document.querySelector('.sub-total span:last-child');
        const discount = document.querySelector('.discount span:last-child');
        const tax = document.querySelector('.tax span:last-child');
        const total = document.querySelector('.total span:last-child');
        const confirm = document.querySelector('.confirm');

        let cartItems = [];

        products.forEach(product => {
            product.addEventListener('click', () => {
                const id = product.getAttribute('data-id');

                fetch(`/pos/product/item/${id}`)
                    .then(response => response.json())
                    .then(data => {
                        const productData = {
                            id: id,
                            name: data.name,
                            price: data.selling_price,
                            purchase_price: data.purchase_price,
                            image: data.image,
                            sku: data.sku,
                            tax: data.tax,
                            discount: data.discount,
                            quantity: 1
                        };

                        const existingProduct = cartItems.find(item => item.id === id);

                        if (existingProduct) {
                            existingProduct.quantity += 1;
                        } else {
                            cartItems.push(productData);
                        }

                        renderCartItems();
                    });
            });
        });

        function renderCartItems() {
            cart.innerHTML = '';

            cartItems.forEach(item => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>
                        <div class="product">
                            <figure><img src="${item.image}" alt="">
                            </figure>
                            <span>
                                <h5>${item.name}</h5>
                            </span>
                        </div>
                    </td>
                    <td>
                        <input type="number" value="${item.quantity}" class="product_ty">
                    </td>
                    <td>$${item.price}</td>
                    <td>
                        <button class="delete-item-button">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 128" width="30px"
                                height="30px">
                                <path
                                    d="M 49 1 C 47.34 1 46 2.34 46 4 C 46 5.66 47.34 7 49 7 L 79 7 C 80.66 7 82 5.66 82 4 C 82 2.34 80.66 1 79 1 L 49 1 z M 24 15 C 16.83 15 11 20.83
                                    11 28 C 11 35.17 16.83 41 24 41 L 101 41 L 101 104 C 101 113.37 93.37 121 84 121 L 44 121 C 34.63 121 27 113.37 27 104 L 27 52 C 27 50.34 25.66 49 24 49 C 22.34 49 21 50.34 21 52 L 21 104 C 21 116.68 31.32 127 44 127 L 84 127 C 96.68 127 107 116.68 107 104 L 107 40.640625 C 112.72 39.280625 117 34.14 117 28 C 117 20.83 111.17 15 104 15 L 24 15 z M 24 21 L 104 21 C 107.86 21 111 24.14 111 28 C 111 31.86 107.86 35 104 35 L 24 35 C 20.14 35 17 31.86 17 28 C 17 24.14 20.14 21 24 21 z M 50 55 C 48.34 55 47 56.34 47 58 L 47 104 C 47 105.66 48.34 107 50 107 C 51.66 107 53 105.66 53 104 L 53 58 C 53 56.34 51.66 55 50 55 z M 78 55 C 76.34 55 75 56.34 75 58 L 75 104 C 75 105.66 76.34 107 78 107 C 79.66 107 81 105.66 81 104 L 81 58 C 81 56.34 79.66 55 78 55 z" />
                            </svg>
                        </button>
                    </td>
                `;
                cart.appendChild(tr);
            });


            calculateTotal();
        }

        function calculateTotal() {
            let subTotalValue = 0;
            let discountValue = 0;
            let taxValue = 0;

            cartItems.forEach(item => {
                const itemPrice = parseFloat(item.price.replace('$', ''));
                const itemSubTotal = itemPrice * item.quantity;
                const itemDiscount = itemSubTotal * (parseFloat(item.discount) / 100);
                const itemTax = (itemSubTotal - itemDiscount) * (parseFloat(item.tax) / 100);

                subTotalValue += itemSubTotal;
                discountValue += itemDiscount;
                taxValue += itemTax;
            });

            subTotal.textContent = `$${subTotalValue.toFixed(2)}`;
            discount.textContent = `$${discountValue.toFixed(2)}`;
            tax.textContent = `$${taxValue.toFixed(2)}`;
            total.textContent = `$${(subTotalValue - discountValue + taxValue).toFixed(2)}`;
        }

        confirm.addEventListener('click', () => {
            fetch('/pos/order', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content'),
                    },
                    body: JSON.stringify({
                        order_items: cartItems,
                        total: parseFloat(total.textContent.replace('$', '')),
                        sub_total: parseFloat(subTotal.textContent.replace('$', '')),
                        discount: parseFloat(discount.textContent.replace('$', '')),
                        tax: parseFloat(tax.textContent.replace('$', '')),
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                })
                .catch(error => {
                    console.error('Error:', error);
                });

            cartItems = [];
            renderCartItems();
        });

        cart.addEventListener('click', (e) => {
            if (e.target.closest('.delete-item-button')) {
                const index = e.target.closest('.delete-item-button').getAttribute('data-index');
                cartItems.splice(index, 1);
                renderCartItems();
            }
        });

        document.addEventListener('input', e => {
            if (e.target.classList.contains('product_ty')) {
                const id = e.target.closest('tr').querySelector('.product h5').textContent;
                const quantity = e.target.value;
                const product = cartItems.find(item => item.name === id);
                product.quantity = quantity;
                renderCartItems();
            }
        });

        const search = document.getElementById('search');

        // when user change the search input
        search.addEventListener('input', () => {
            fetch(`/pos/product?search=${search.value}`)
                .then(response => response.json())
                .then(data => {
                    const pos_products_list = document.querySelector('.pos-products-list');
                    pos_products_list.innerHTML = '';

                    data.forEach(product => {
                        const productElement = document.createElement('li');
                        productElement.innerHTML = `
                            <button class="pos-product-item" data-id="${product.id}">
                                <figure><img src="${product.image}" alt="${product.name}" width="50" height="80">
                                    <h3>${product.name}</h3>
                                </figure>
                                <div class="pos-product-price">
                                    <span>
                                        ${product.discount > 0 ? `<del>$${product.selling_price}</del> $${product.selling_price - (product.selling_price * product.discount) / 100}` : `$${product.selling_price}`}
                                    </span>
                                    <svg width="24" height="24" viewBox="0 0 24 24">
                                        <title>Add</title>
                                        <path
                                            d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 13h-5v5h-2v-5h-5v-2h5v-5h2v5h5v2z" />
                                    </svg>
                                </div>
                            </button>
                        `;
                        pos_products_list.appendChild(productElement);
                    });

                    if (data.length === 0) {
                        pos_products_list.innerHTML = '<h2>No Product Found</h2>';
                    }
                });
        });
    </script>
@endpush
