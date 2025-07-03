# Website-Wide Search Application (Laravel + Meilisearch)

A Laravel 12 application demonstrating full-text search across multiple content types using Laravel Scout with Meilisearch.

## 🔍 Features

- Full-text search across:
  - Blog Posts
  - Products
  - Pages
  - FAQs
- Typeahead-style suggestions
- Admin API to rebuild search index
- Dockerized environment (Laravel + MySQL + Meilisearch)
- Laravel Queue support for async syncing
- Optional: Search analytics (top terms)

## 📦 Technologies Used

- Laravel 12
- Laravel Scout
- Meilisearch
- MySQL
- Docker / Docker Compose
- Laravel Queues (Database)
- Postman for API testing

## 🚀 API Endpoints

| Method | Endpoint                         | Description                       |
|--------|----------------------------------|-----------------------------------|
| GET    | `/api/search?q=term`             | Search across all content types   |
| GET    | `/api/search/suggestions?q=term` | Typeahead-style suggestions       |
| GET    | `/api/search/logs`               | View recent queries / top terms   |
| POST   | `/api/search/rebuild-index`      | Rebuild the Meilisearch index     |

## 🐳 Run with Docker

```bash
docker-compose up --build
