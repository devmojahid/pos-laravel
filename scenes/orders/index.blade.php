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
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">Handle</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>
@endsection