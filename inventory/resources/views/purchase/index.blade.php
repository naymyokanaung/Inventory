@extends('layout.master')

@section('main')
<section>
    <div class="d-flex justify-content-between align-items-center mb-4 mt-3">
        <h2 class="h4">Purchase Info</h2>
        <a href="{{ route('purchase.create') }}" class="btn btn-primary btn-m mr-2">Order Purchase</a>
    </div>

    <!-- Success Alert -->
    @if (session('createsuccess'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('createsuccess') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    @if (session('editsuccess'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('editsuccess') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('deletesuccess'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('deletesuccess') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($purchaseOrders->isEmpty())
        <div class="alert alert-info" role="alert">
            No customers found.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover table-m">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Order-No.</th>
                        <th>Order Item</th>
                        <th>Purchaseorder Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($purchaseOrders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->order_no }}</td>
                            <td>
                                @foreach ($purchaseDetails as $purchase)
                                    @if ($order->order_id == $purchase->id)
                                        @foreach ($products as $product)
                                            @if ($purchase->product_id == $product->id)
                                                {{$product->name}}
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </td>
                            <td>{{ $order->purchaseorder_date }}</td>
                            <td>
                                <a href="{{ route('purchase.show', $order->id) }}" class="btn btn-info btn-sm">
                                    <i class="fa fa-eye"></i> View
                                </a>
                                <a href="{{ route('purchase.edit', $order->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('purchase.destroy', $order->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</section>

@endsection
