<!DOCTYPE html>
<html>
<head><title>{{ $blog->title }}</title></head>
<body>
    <h1>{{ $blog->title }}</h1>
    <p><strong>Published At:</strong> {{ $blog->published_at }}</p>
    <div>{{ $blog->body }}</div>
    <div>tags: {{ $blog->tags }}</div>
</body>
</html>
