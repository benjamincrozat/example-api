# Example API

Small Laravel API project for a `Product` CRUD. It runs with Laravel Sail on PHP 8.5 and PostgreSQL 18.

## Setup

Requirements:

- Docker Desktop

From the project root, run:

```bash
cp .env.example .env
docker run --rm \
  -u "$(id -u):$(id -g)" \
  -v "$(pwd):/var/www/html" \
  -w /var/www/html \
  laravelsail/php84-composer:latest \
  composer install --ignore-platform-reqs
./vendor/bin/sail up -d
./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate --seed --force
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
./vendor/bin/sail test
./vendor/bin/sail composer run analyse
./vendor/bin/sail pint
```

## Stop

```bash
./vendor/bin/sail down
```
