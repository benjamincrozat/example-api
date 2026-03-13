# Example API

Small Laravel API project for a `Product` CRUD. It runs with Laravel Sail on PHP 8.5 and PostgreSQL 18.

## Setup

Requirements:

- Docker Desktop
- Composer

From the project root, run:

```bash
cp .env.example .env
composer install
./vendor/bin/sail up -d
./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate --force
```

Once the application is running, open the API documentation at [http://localhost:8000/docs/api](http://localhost:8000/docs/api).

## URLs

- API base URL: [http://localhost:8000/api](http://localhost:8000/api)
- OpenAPI UI: [http://localhost:8000/docs/api](http://localhost:8000/docs/api)
- OpenAPI JSON: [http://localhost:8000/docs/api.json](http://localhost:8000/docs/api.json)

## Product Endpoints

```text
GET    /api/products
GET    /api/products/{id}
POST   /api/products
PUT    /api/products/{id}
DELETE /api/products/{id}
```

## Optional Checks

```bash
./vendor/bin/sail test
./vendor/bin/sail composer run analyse
./vendor/bin/sail pint
```

## Stop

```bash
./vendor/bin/sail down
```
