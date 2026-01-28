# IP Management Application

## Stacks

- **Backend**: Laravel 9 (PHP 8.0+)
- **Frontend**: Vue 3, Vite, Pinia, TypeScript
- **Database**: MySQL 8.0
- **Containerization**: Docker & Docker Compose

## Prerequisites

- [Docker](https://www.docker.com/products/docker-desktop)
- [Docker Compose](https://docs.docker.com/compose/install/)

## Installation & Setup

1.  **Clone the repository**

    ```bash
    git clone <repository-url>
    cd ipmanagement_techlint
    docker-compose up -d --build
    ```

2.  **Install Dependencies**

    **Auth Service:**
    cd auth-service

    ```bash
    docker exec -it ip-address-auth-service sh
    composer install
    php artisan key:generate
    php artisan migrate --seed
    php artisan config:clear
    php artisan config:cache
    ```

    **IP Service:**
    cd ip-service

    ```bash
    docker exec -it ip-address-management-service sh
    composer install
    php artisan key:generate
    php artisan migrate --seed
    php artisan config:clear
    php artisan config:cache
    ```

    **Gateway Service:**
    cd gateway-service

    ```bash
    docker exec -it ip-address-gateway sh
    composer install
    php artisan key:generate
    php artisan config:clear
    php artisan config:cache
    ```

## Default Users

**Admin User**

- **Email**: `admin@example.com`
- **Password**: `password`

**Regular User**

- **Email**: `user@example.com`
- **Password**: `password`

## Usage

Access the application at:

- **Frontend**: [http://localhost:3000](http://localhost:3000)
