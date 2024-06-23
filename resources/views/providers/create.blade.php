@include('layout.nav')
@include('layout.sidebar')
<!DOCTYPE html>
<html>
<head>
    <title>Create Provider</title>

</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Create Provider</h1>
    <form action="{{ route('providers.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="address">Address:</label>
            <textarea id="address" name="address" class="form-control" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>

</body>
</html>
@include('layout.footer')
