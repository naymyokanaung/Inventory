@extends('layout.master')
@section('main')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-5">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h2>Edit Order of {{$purchaseOrder->order_no}}</h2>
                        <a href="{{ route('purchase.index') }}" class="btn btn-secondary">Back to List Page</a>
                    </div>
                    <div class="card-body">
                        @foreach ($purchaseDetails as $purchaseDetail)
                            @if ($purchaseDetail->id == $purchaseOrder->order_id)
                                <form action="{{ route('purchase.update', $purchaseDetail->id) }}" method="POST">
                                    @csrf
                                    @method('put')
        
                                    <div class="form-group">
                                        <label for="provider_id">Provider ID:</label>
                                        <input type="text" id="provider_id" name="provider_id" class="form-control @error('provider_id') is-invalid @enderror" value="{{$purchaseDetail->provider_id}}" required>
                                        @error('provider_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="product_id">Product ID:</label>
                                        <input type="text" id="product_id" name="product_id" class="form-control @error('product_id') is-invalid @enderror" value="{{$purchaseDetail->product_id}}" required>
                                        @error('product_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="qty">Quantity:</label>
                                        <input type="number" id="qty" name="qty" class="form-control @error('qty') is-invalid @enderror" value="{{$purchaseDetail->qty}}" required>
                                        @error('qty')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="price">Price:</label>
                                        <input type="text" id="price" name="price" class="form-control @error('price') is-invalid @enderror" value="{{$purchaseDetail->price}}" required>
                                        @error('price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group text-right">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
