@extends('layout.master')

@section('main')
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
        margin: 0;
        padding: 0;
    }

    .invoice-container {
        width: 70%;
        margin: auto;
        background-color: #fff;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .logo h1 {
        margin: 0;
        color: #4b70f9;
        font-size: 36px;
        line-height: 1;
    }

    .invoice-details {
        text-align: right;
    }

    .invoice-details h1 {
        margin: 0;
        color: #1E3AA3;
        font-size: 24px;
    }

    .invoice-details p {
        margin: 5px 0;
        font-size: 14px;
    }

    .invoice-info {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }

    .invoice-to,
    .invoice-from {
        width: 45%;
    }

    .invoice-to h3,
    .invoice-from h3 {
        margin-bottom: 5px;
        font-size: 16px;
        color: #1E3AA3;
    }

    .invoice-to p,
    .invoice-from p {
        margin: 2px 0;
        font-size: 14px;
    }

    .invoice-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .invoice-table th,
    .invoice-table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    .invoice-table th {
        background-color: #f2f2f2;
        color: #333;
    }

    .invoice-table td {
        font-size: 14px;
    }

    .invoice-total {
        text-align: right;
        margin-top: 20px;
    }

    .invoice-total p {
        margin: 5px 0;
        font-size: 14px;
    }

    .invoice-total .grand-total {
        font-size: 16px;
        font-weight: bold;
    }

    .invoice-total span {
        margin-left: 10px;
    }

    .footer {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }

    .footer p {
        margin: 0;
        font-size: 14px;
        color: #1E3AA3;
    }

    .btn {
        display: inline-block;
        padding: 10px 20px;
        font-size: 14px;
        font-weight: bold;
        color: #fff;
        background-color: #007bff;
        border: none;
        border-radius: 4px;
        text-decoration: none;
        text-align: center;
        cursor: pointer;
    }

    .btn-primary {
        background-color: #007bff;
    }

    .btn-secondary {
        background-color: #6c757d;
    }

    .btn-m {
        font-size: 16px;
        padding: 10px 15px;
    }

    .mr-2 {
        margin-right: 8px;
    }
</style>

<section class="mt-3">
    <div class="mb-4 mt-3">
        <a href="{{ route('purchase.index') }}" class="btn btn-primary btn-m mr-2">Back</a>
        <a href="{{ route('invoice.download', $purchaseOrder->id) }}" class="btn btn-primary">Download</a>
    </div>
    <div class="invoice-container mt-5">
        @foreach ($purchaseDetails as $detail)
            @if ($purchaseOrder->order_id == $detail->id)
                <div class="header">
                    <div class="logo">
                        <h1>HMM Inventory</h1>
                    </div>
                    <div class="invoice-details">
                        <h1>Invoice</h1>
                        <p>Order Code: {{ $purchaseOrder->order_no }}</p>
                        <p>Date: {{ $purchaseOrder->purchaseorder_date->format('d M Y') }}</p>
                    </div>
                </div>
                <div class="invoice-info">
                    <div class="invoice-to">
                        <h3>Product</h3>
                        <p>{{ $products->firstWhere('id', $detail->product_id)->name ?? 'Unknown Product' }}</p>
                    </div>
                    <div class="invoice-from">
                        <h3>Provider</h3>
                        <p>{{ $providers->firstWhere('id', $detail->provider_id)->name ?? 'Unknown Provider' }}</p>
                    </div>
                </div>
                <table class="invoice-table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Item Description</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>{{ $products->firstWhere('id', $detail->product_id)->name ?? 'Unknown Product' }}</td>
                            <td>${{ number_format($detail->price, 2) }}</td>
                            <td>{{ $detail->qty }}</td>
                            <td>${{ number_format($detail->qty * $detail->price, 2) }}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="invoice-total">
                    @php
                        $subTotal = $purchaseDetails->where('purchase_order_id', $purchaseOrder->id)
                                        ->sum(fn($detail) => $detail->qty * $detail->price);
                    @endphp
                    <p>SubTotal: <span>${{ number_format($detail->qty * $detail->price, 2) }}</span></p>
                    <p>Tax: <span>$0.00</span></p>
                    <p class="grand-total">Grand Total: <span>${{ number_format($subTotal, 2) }}</span></p>
                </div>
                <div class="footer">
                    <p>Thank you for your business!</p>
                </div>
            @endif
        @endforeach
    </div>
</section>
@endsection
