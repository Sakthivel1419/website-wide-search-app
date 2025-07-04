<!DOCTYPE html>
<html>
<head><title>{{ $product->name }}</title></head>
<body>
    <h1>{{ $product->name }}</h1>
    <p><strong>Description:</strong> {{ $product->description }}</p>
    <p><strong>Price:</strong> ₹{{ $product->price }}</p>
</body>
</html>