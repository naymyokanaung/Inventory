@include('layout.nav')
@include('layout.sidebar')
<!DOCTYPE html>
<html>
<head>
    <title>Show Provider</title>
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Show Provider</h1>
    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <strong>Name:</strong>
                <p class="form-control-plaintext">{{ $provider->name }}</p>
            </div>
            <div class="mb-3">
                <strong>Address:</strong>
                <p class="form-control-plaintext">{{ $provider->address }}</p>
            </div>
            <a href="{{ route('providers.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
</div>

</body>
</html>
@include('layout.footer')
