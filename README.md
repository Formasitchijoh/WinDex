# Windex Toplist Application

A CRUD application to manage a toplist of brands, built with **Laravel**, **PostgreSQL**, and **Docker**, with a mobile-friendly frontend.  
Supports geolocation-based toplists using the **CF-IPCountry** header.

---

## Features
- CRUD API for brands (`brand_id`, `brand_name`, `brand_image`, `rating`, `country_code`).
- Geolocation-based toplists using `CF-IPCountry` header.
- Default toplist for users without a valid country.
- Mobile-friendly frontend.
- Dockerized backend for easy setup.

---

## Tech Stack
- **Backend**: Laravel 10, PHP 8.3
- **Database**: PostgreSQL
- **Frontend**: HTML, CSS, JS
- **Containerization**: Docker, Docker Compose

---

## Prerequisites
- [Docker](https://docs.docker.com/get-docker/) & [Docker Compose](https://docs.docker.com/compose/) installed.
- [Python 3](https://www.python.org/downloads/) (to serve frontend locally).

---

## Project Setup

###  Clone Project
```bash
git clone https://github.com/Formasitchijoh/WinDex.git
cd WinDex
```
### Local Development
For local development, edit WinDex/server/start.sh:
- **Comment out**: `exec php artisan serve --host=0.0.0.0 --port=$PORT`.
- **Uncomment**: `exec php-fpm`

### Start Backend
```bash
docker-compose build
docker-compose up -d
docker-compose up
```
**Verify Seeding** (should create 10 brands):
```bash
docker exec -it <db-container-id> psql -U postgres -d windex -c "SELECT * FROM brands;"
```
### API Endpoints
| Method | Endpoint            | Description                  |
|--------|---------------------|------------------------------|
| GET    | `/api/brands`       | All brands (geolocation-aware) |
| POST   | `/api/brands`       | Create brand                 |
| GET    | `/api/brands/{id}`  | Get brand by ID              |
| PUT    | `/api/brands/{id}`  | Update brand                 |
| DELETE | `/api/brands/{id}`  | Delete brand                 |

**Geolocation Logic**: Uses `CF-IPCountry` header. Returns country-specific brands first, then others. Default list if header missing.

### Testing API

Use PostMan or ThunderClient to access the endpoint, For POST/PUT requests, set the header `Content-Type: application/json`
And access the backend at 
```bash
http://localhost:8000/api/brands
```

### Start Frontend
Navigate to the the `WinDex/web` directory in your file explorer and open the `index.html` file in your browser OR
```bash
cd web
python3 -m http.server 8080
```

Access the UI at: [http://[::]:8080/](http://[::]:8080/)

### Test Geolocation
Use the Select Dropdown to select your location `OR` run  
```bash
curl -H "CF-IPCountry: CA" http://localhost:8000/api/brands
```


###  Troubleshoot Seeding
- **Manual Seed**:
  ```bash
  docker exec -it <backend-container-id> php artisan db:seed --force --class=BrandSeeder
  ```
- **Rebuild**:
  ```bash
  docker-compose build --no-cache
  ```
- **Clean Restart**:
  ```bash
  docker-compose down -v --remove-orphans && docker-compose build --no-cache && docker-compose up -d
  ```

### Deployment URLs
- **Backend**: [https://windex.onrender.com](https://windex.onrender.com)
- **Frontend**: [https://win-dex.vercel.app/](https://win-dex.vercel.app/)

---
