@extends('layout.master')

@section('main')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-5">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h2>Order Purchase</h2>
                        <a href="{{ route('purchase.index') }}" class="btn btn-secondary">Back to List Page</a>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form action="{{ route('purchase.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="provider_id">Provider:</label>
                                <select id="provider_id" name="provider_id" class="form-control @error('provider_id') is-invalid @enderror" required>
                                    <option value="" selected>Choose Provider...</option>
                                    @foreach($providers as $provider)
                                        <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                                    @endforeach
                                </select>
                                @error('provider_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="product_id">Product:</label>
                                <select id="product_id" name="product_id" class="form-control @error('product_id') is-invalid @enderror" required>
                                    <option value="" selected>Choose Product...</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                                @error('product_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="qty">Quantity:</label>
                                <input type="number" id="qty" name="qty" class="form-control @error('qty') is-invalid @enderror" min="1" required>
                                @error('qty')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="price">Price:</label>
                                <input type="number" id="price" name="price" class="form-control @error('price') is-invalid @enderror" step="0.01" min="0" required>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
