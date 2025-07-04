<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Website-Wide Search</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { padding: 2rem; }
        .result { margin-bottom: 1rem; padding: 1rem; border: 1px solid #ddd; border-radius: 6px; }
    </style>
</head>
<body>

    <div class="container">
        <h2 class="mb-4">🔍 Website-Wide Search</h2>

        <form id="search-form" class="input-group mb-3">
            <input type="text" id="search-input" class="form-control" placeholder="Search for blog posts, products, pages, FAQs..." required>
            <button class="btn btn-primary" type="submit">Search</button>
        </form>

        <div id="results" class="mt-4"></div>
    </div>

    <script>
        const form = document.getElementById('search-form');
        const resultsDiv = document.getElementById('results');

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const query = document.getElementById('search-input').value;
            resultsDiv.innerHTML = 'Searching...';

            fetch(`/api/search?q=${encodeURIComponent(query)}`)
                .then(res => res.json())
                .then(data => {
                    if (!data.results.length) {
                        resultsDiv.innerHTML = `<div class="alert alert-warning">No results found.</div>`;
                        return;
                    }

                    const grouped = data.results.reduce((acc, item) => {
                        (acc[item.type] = acc[item.type] || []).push(item);
                        return acc;
                    }, {});

                    resultsDiv.innerHTML = '';
                    for (const [type, items] of Object.entries(grouped)) {
                        resultsDiv.innerHTML += `<h5 class="mt-4">${type}</h5>`;
                        items.forEach(item => {
                            resultsDiv.innerHTML += `
                                <div class="result">
                                    <h6>${item.title}</h6>
                                    <p>${item.snippet}</p>
                                    <a href="${item.link}" class="btn btn-sm btn-outline-secondary">View</a>
                                </div>`;
                        });
                    }
                })
                .catch(() => {
                    resultsDiv.innerHTML = `<div class="alert alert-danger">Error fetching results.</div>`;
                });
        });
    </script>

</body>
</html>
