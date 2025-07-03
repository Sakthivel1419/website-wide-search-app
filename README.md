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
- Laravel Scheduler (Optional)
- Postman for API Testing

---

## 🚀 Setup Instructions

### 1️⃣ Clone the Repository

```bash
git clone https://github.com/Sakthivel1419/website-wide-search-app.git
cd website-wide-search-app

2️⃣ Copy .env File

```bash
cp .env.example .env

Ensure the following values are set:

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

🐳 Run with Docker

```bash
docker-compose up --build

This will start:

Laravel app at → http://localhost:8000
Meilisearch at → http://localhost:7701
MySQL at port → 3307 (host), mapped to 3306 (container)

⚙️ Install Dependencies & Run Migrations

In a new terminal, enter the container:

```bash
docker exec -it laravel_app bash

Then Run:

```bash
composer install
php artisan migrate --seed

This seeds BlogPosts, Products, Pages, and FAQs with demo data.

📡 API Endpoints

| Method | Endpoint                        | Description                       |
| ------ | ------------------------------- | --------------------------------- |
| GET    | `/api/search?q=laravel`         | Unified search across all models  |
| GET    | `/api/search/suggestions?q=lar` | Typeahead-style suggestions       |
| GET    | `/api/search/logs`              | (Admin) Recent search terms       |
| POST   | `/api/search/rebuild-index`     | (Admin) Rebuild Meilisearch index |

✅ Seed Admin User

```bash
php artisan tinker
>>> \App\Models\User::create([
    'name' => 'Admin',
    'email' => 'admin@admin.com',
    'password' => bcrypt('password')
]);

### 🔐 Authentication for Admin Endpoints

Some endpoints like `/search/logs` and `/search/rebuild-index` are **protected** using **Basic Authentication**.
Use these credentials in Postman:
Username: admin@admin.com
Password: password

🧪 Sample API Outputs

/api/search?q=laravel
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

/api/search/suggestions?q=lar
[
  "Laravel Basics",
  "What is Laravel?",
  "Introduction to Web Development"
]

📬 Postman Collection with Sample Responses

This collection includes:
- Unified search, suggestions, admin logs, and rebuild endpoints
- ✅ Sample responses for each API

[⬇ Download Postman Collection](website-wide-search-api.postman_collection.json)

🔁 Queues

Laravel Scout queues index updates.
Set in .env:
QUEUE_CONNECTION=database
SCOUT_QUEUE=true

Start the queue worker:

```bash
php artisan queue:work

When models are created or updated, you’ll see jobs like:
Laravel\Scout\Jobs\MakeSearchable


