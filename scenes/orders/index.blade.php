@extends('scene::layout.app')

@section('title', 'Orders List')
@section('content')
    <main class="products">
        <section class="pos-products">
            <div class="card pos-card-override">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5>All Orders</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Order Number</th>
                                <th scope="col">Order Item Count</th>
                                <th scope="col">Order Subtotal</th>
                                <th scope="col">Order Total</th>
                                <th scope="col">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                                <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td>{{ $order->order_number }}</td>
                                    <td>{{ $order->item_count }}</td>
                                    <td>{{ $order->sub_total }}</td>
                                    <td>{{ $order->total }}</td>
                                    <td>
                                        {{-- {{ route('order.show', ['order' => $order->id]) }} --}}
                                        <a href="" class="btn btn-primary">View</a>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">
                                        <h2>No Order Found</h2>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                        @if ($orders->hasPages())
                            <tfoot>
                                <tr>
                                    <td colspan="6">
                                        {{ $orders->links('pagination::bootstrap-5') }}
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
