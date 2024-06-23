@include('layout.nav')
@include('layout.sidebar')
<!DOCTYPE html>
<html>
<head>
    <title>Edit Provider</title>
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Edit Provider</h1>
    <form action="{{ route('providers.update', $provider->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $provider->name }}" required>
        </div>
        <div class="form-group">
            <label for="address">Address:</label>
            <textarea id="address" name="address" class="form-control" rows="3" required>{{ $provider->address }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
</body>
</html>
@include('layout.footer')
