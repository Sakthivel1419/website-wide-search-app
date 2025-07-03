
# 🔍 Website-Wide Search Application (Laravel + Meilisearch)

A Laravel 12 application demonstrating full-text search across multiple content types using Laravel Scout and Meilisearch.

---

## 📦 Technologies Used

- Laravel 12
- Laravel Scout
- Meilisearch
- MySQL
- Docker & Docker Compose
- Laravel Queues (Database)
- Postman for API Testing

---

## 🚀 Setup Instructions

### 1️⃣ Clone the Repository

```bash
git clone https://github.com/Sakthivel1419/website-wide-search-app.git
cd website-wide-search-app
```

---

### 2️⃣ Copy .env File

```bash
cp .env.example .env
```

Ensure the following values are set in `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=website_wide_search_app
DB_USERNAME=laravel
DB_PASSWORD=secret

SCOUT_DRIVER=meilisearch
MEILISEARCH_HOST=http://meilisearch:7700
MEILISEARCH_KEY=masterKey

QUEUE_CONNECTION=database
SCOUT_QUEUE=true
```

---

### 🐳 Run with Docker

```bash
docker-compose up --build
```

This will start:

- Laravel app → http://localhost:8000  
- Meilisearch → http://localhost:7701  
- MySQL on port 3307 (host) → mapped to 3306 (container)

---

### ⚙️ Install Dependencies & Run Migrations

Once Docker is running, enter the container:

```bash
docker exec -it laravel_app bash
```

Then run:

```bash
composer install
php artisan migrate --seed
```

This seeds the app with demo **BlogPosts, Products, Pages, and FAQs**.

---

## 📡 API Endpoints

| Method | Endpoint                            | Description                              |
|--------|-------------------------------------|------------------------------------------|
| GET    | `/api/search?q=laravel`             | Unified search across all models         |
| GET    | `/api/search/suggestions?q=lar`     | Typeahead-style suggestions              |
| GET    | `/api/search/logs`                  | 🔒 Admin: Recent search terms             |
| POST   | `/api/search/rebuild-index`         | 🔒 Admin: Rebuild Meilisearch index       |

---

### ✅ Seed Admin User

```bash
php artisan tinker
```

```php
\App\Models\User::create([
  'name' => 'Admin',
  'email' => 'admin@admin.com',
  'password' => bcrypt('password')
]);
```

---

### 🔐 Authentication for Admin Endpoints

Use **Basic Auth** in Postman for admin-protected routes:

- Username: `admin@admin.com`  
- Password: `password`  

---

## 🧪 Sample API Responses

### `/api/search?q=laravel`

```json
{
  "results": [
    {
      "type": "BlogPost",
      "title": "Laravel Basics",
      "snippet": "This is a blog post used for testing...",
      "link": "/blog/1"
    },
    {
      "type": "Faq",
      "title": "What is Laravel?",
      "snippet": "This is a short answer...",
      "link": "/faq/1"
    }
  ]
}
```

### `/api/search/suggestions?q=lar`

```json
[
  "Laravel Basics",
  "What is Laravel?",
  "Introduction to Web Development"
]
```

---

## 📬 Postman Collection

Includes:
- Unified Search
- Suggestions
- Admin Logs
- Rebuild Index  
✅ All with sample requests and Basic Auth

📁 File: `website-wide-search-api.postman_collection.json`  
📥 [Download the collection](WebsiteWideSearchApp.postman_collection.json)

---

## 🔁 Queues

Index updates are queued using Laravel Scout + Database driver.

Make sure `.env` has:

```env
QUEUE_CONNECTION=database
SCOUT_QUEUE=true
```

Then run the worker:

```bash
php artisan queue:work
```

When you update a searchable model (e.g., BlogPost), the queue will dispatch:

```
Laravel\Scout\Jobs\MakeSearchable
```

---

Now you have a fully working **Website-Wide Search App** using Laravel + Meilisearch, ready for demo or deployment 🎉
