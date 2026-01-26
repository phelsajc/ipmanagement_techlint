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

3.  **Build and Start Containers**

    Run the following command in the root directory to build and start the entire application:

    ```bash
    docker-compose up -d --build
    ```

4.  **Install Dependencies and Run Migrations**

    **Auth Service:**

    ```bash
    docker exec -it ip-address-auth-service cp .env.example .env
    docker exec -it ip-address-auth-service composer install
    docker exec -it ip-address-auth-service php artisan migrate --seed
    docker exec -it ip-address-auth-service php artisan key:generate
    ```

    **IP Service:**

    ```bash
    docker exec -it ip-address-management-service cp .env.example .env
    docker exec -it ip-address-management-service composer install
    docker exec -it ip-address-management-service php artisan migrate --seed
    docker exec -it ip-address-management-service php artisan key:generate
    ```

    **Gateway Service:**

    ```bash
    docker exec -it ip-address-gateway cp .env.example .env
    docker exec -it ip-address-gateway composer install
    docker exec -it ip-address-gateway php artisan key:generate
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
