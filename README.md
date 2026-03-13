# Example API

Small Laravel API project for a `Product` CRUD. It runs with Laravel Sail on PHP 8.5 and PostgreSQL 18.

## Setup

Requirements:

- Docker Desktop

This repository already includes Sail's published `compose.yaml`, `sail`, and Docker files.

From the project root, run these commands in order:

```bash
cp .env.example .env
./sail up -d
./sail composer install
./sail artisan key:generate
./sail artisan migrate --seed
```

Once the application is running, open the API documentation at [http://localhost:8000/docs/api](http://localhost:8000/docs/api).
The database seeder creates a default user and 10 sample products so the API is not empty after setup.

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
./sail test
./sail composer run analyse
./sail pint
```

## Stop

```bash
./sail down
```
