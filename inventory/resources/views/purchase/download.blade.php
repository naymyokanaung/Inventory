<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        .invoice-box {
            width: 70%;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .invoice-header {
            margin-bottom: 20px;
            border-bottom: 2px solid #eee;
            padding-bottom: 10px;
            text-align: center;
        }
        .invoice-header h1 {
            margin: 0;
            color: #4b70f9;
            font-size: 36px;
        }
        .invoice-header h6 {
            margin: 5px 0;
            color: #555;
            font-size: 16px;
        }
        .invoice-details {
            margin-bottom: 20px;
        }
        .invoice-details h3 {
            margin: 0;
            color: #333;
            font-size: 20px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
            margin-bottom: 10px;
        }
        .invoice-details table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .invoice-details th, .invoice-details td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .invoice-details th {
            background-color: #f2f2f2;
            color: #333;
        }
        .invoice-details td {
            color: #555;
        }
        .invoice-footer {
            margin-top: 30px;
            text-align: center;
        }
        .invoice-footer h6 {
            margin: 0;
            color: #333;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="invoice-box">
        <div class="invoice-header">
            <h1>Invoice</h1>
            <h6>Order Code - {{ $purchaseOrder->order_no }}</h6>
            <h6>Date: {{ \Carbon\Carbon::parse($purchaseOrder->purchaseorder_date)->format('d M Y') }}</h6>
        </div>
        <div class="invoice-details">
            <h3>Details:</h3>
            @foreach ($purchaseDetails as $detail)
                @if ($purchaseOrder->order_id == $detail->id)
                    <table>
                        <tr>
                            <th>Product Name</th>
                            <td>
                                @foreach ($products as $product)
                                    @if ($detail->product_id == $product->id)
                                        {{ $product->name }}
                                    @endif
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>Provider Name</th>
                            <td>
                                @foreach ($providers as $provider)
                                    @if ($detail->provider_id == $provider->id)
                                        {{ $provider->name }}
                                    @endif
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>Quantity</th>
                            <td>{{ $detail->qty }}</td>
                        </tr>
                        <tr>
                            <th>Price</th>
                            <td>${{ number_format($detail->price, 2) }}</td>
                        </tr>
                        <tr>
                            <th>Total</th>
                            <td>${{ number_format($detail->qty * $detail->price, 2) }}</td>
                        </tr>
                    </table>
                @endif
            @endforeach
        </div>
        <div class="invoice-footer">
            <h6>Thank you for your business!</h6>
        </div>
    </div>
</body>
</html>
