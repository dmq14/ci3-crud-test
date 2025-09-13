# CI3 CRUD + REST API

## Overview
This project is a simple **CRUD application** built with:

- [CodeIgniter 3](https://codeigniter.com/userguide3/) (PHP Framework)
- MySQL (Database)
- Bootstrap 4 (UI)
- jQuery + Ajax (Frontend requests)
- REST API integration
- Environment configuration via **.env** (using vlucas/phpdotenv)

1. MySQL database schema.
2. RESTful API (CodeIgniter Controller).
3. UI with Bootstrap + Ajax consuming API.
4. Local environment management via `.env`.

---

## Requirements

- PHP 7.4+
- MySQL 5.7+
- Composer

---

## Installation (Local)

1. Clone repo:

```bash
git clone https://github.com/dmq14/ci3-crud-test.git
cd ci3-crud-test
```

2. Copy `.env.example` to `.env` and configure your local DB:

```bash
cp .env.example .env
```

Example `.env` for local:

```
CI_ENV=local
BASE_URL=http://localhost/ci3-crud-test/
DB_HOST=127.0.0.1
DB_USER=root
DB_PASS=
DB_NAME=ci3_crud
```

3. Install composer dependencies:

```bash
composer install
```

4. Import database:

```sql
# From application/model/sql/ci3_crud_schema.sql
```

5. `.htaccess` for local:

```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteBase /ci3-crud-test/

    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.*)$ index.php/$1 [L]
</IfModule>
```

6. Open in browser:

```
http://localhost/ci3-crud-test/
```

---

## API Endpoints
| Method | Endpoint            | Description       | Body Params                           |
|--------|---------------------|-------------------|---------------------------------------|
| GET    | /api/v1/items       | Get all items     | -                                     |
| GET    | /api/v1/items/{id}  | Get item by ID    | -                                     |
| POST   | /api/v1/items       | Create new item   | `{ "title": "", "description": "" }`  |         
| PUT    | /api/v1/items/{id}  | Update an item    | `{ "title": "", "description": "" }`  |
| DELETE | /api/v1/items/{id}  | Delete an item    | -                                     |

> For full API documentation including request/response examples and error messages, please see [API_DOCUMENTATION.md](API_DOCUMENTATION.md)
---

## Authentication (Optional)
Currently, API is open (no authentication) for demo purposes. In production, you can secure endpoints using:
- API key
- JWT (JSON Web Token)
- OAuth2

---

## Notes
- Use `.env` to configure environment variables locally.
- Composer dependencies are managed via `composer install`.

