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
    ```

2.  **Environment Setup**

    You will need to set up the environment files for each service.

3.  **Install Dependencies**

    **Auth Service:**

    ```bash
    docker-compose run --rm auth_service cp .env.example .env
    docker-compose run --rm auth_service composer install
    docker-compose run --rm auth_service php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
    docker-compose run --rm auth_service php artisan key:generate
    docker-compose run --rm auth_service php artisan migrate --seed
    ```

    **IP Service:**

    ```bash
    docker-compose run --rm ip_service cp .env.example .env
    docker-compose run --rm ip_service composer install
    docker-compose run --rm ip_service php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
    docker-compose run --rm ip_service php artisan key:generate
    docker-compose run --rm ip_service php artisan migrate --seed
    ```

    **Gateway Service:**

    ```bash
    docker-compose run --rm gateway cp .env.example .env
    docker-compose run --rm gateway composer install
    docker-compose run --rm gateway php artisan key:generate
    ```

4.  **Start the Application**

    Now that dependencies are installed, start the services:

    ```bash
    docker-compose up -d --build
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
