# Applicy

Streamline your job application journey.

> **Status:** Inactive — not in active development. Kept for reference and to run locally.

## Overview

### What is Applicy?

Applicy is a web application for managing a job search. Create a profile, track every application you've submitted and where it stands, and keep your resumes and cover letters in one place, with an AI assistant that tailors them to each job. It was built to take the busywork out of job hunting (tracking applications, customizing resumes, rewriting cover letters) so more time goes into preparing for interviews.

It's a Laravel 11 application with an Inertia and Vue frontend, run locally through Laravel Sail.

### Key Features

- **Application Tracker**: Keep track of the job applications you've submitted and the status of each one.
- **Resumes**: Upload and store your resumes, and get recommendations from the AI assistant based on the job you're applying for.
- **Cover Letters**: Upload and store your cover letters, and have the AI assistant write versions for the different jobs you're applying for.

## Getting Started

### Prerequisites

Ensure you have the following installed. You can verify each one by running the provided command in your terminal.

1. **Laravel Herd** serves the site at `applicy.test` and provides PHP and Composer. Check it by running:

    ```bash
    herd --version
    ```

2. **PHP** (8.2+) is required for the application. Herd installs it, and `herd.yml` pins the site to PHP 8.3. Check it by running:

    ```bash
    php --version
    ```

3. **Composer** manages PHP dependencies. Herd installs it too. Check it by running:

    ```bash
    composer --version
    ```

4. **Node** and **NPM** manage frontend dependencies. Check them by running:

    ```bash
    node --version
    npm --version
    ```

### Installation

1. Set the site up from `herd.yml`. This links it as `applicy.test`, isolates PHP 8.3, and offers to copy `.env.example` to `.env` (say yes):

    ```bash
    herd init
    ```

2. Configure `.env` with your settings (see [Configuration](#configuration)).

3. Install PHP and JavaScript dependencies:

    ```bash
    composer install
    npm install
    ```

4. Generate a new application key:

    ```bash
    php artisan key:generate
    ```

5. Apply database migrations and seed the database with test data. The app uses SQLite, and Laravel offers to create `database/database.sqlite` if it's missing:

    ```bash
    php artisan migrate --seed
    ```

6. Compile assets and run the Vue frontend:

    ```bash
    npm run dev
    ```

7. Open the site in your browser:

    ```text
    http://applicy.test
    ```

### Configuration

Set these in `.env` for the features that use them:

| Variable | What it's for | Needed for |
|---|---|---|
| `OPEN_AI_API_KEY` | OpenAI API key | The AI assistant for resumes and cover letters |
| `STRIPE_KEY`, `STRIPE_SECRET`, `STRIPE_WEBHOOK_SECRET` | Stripe keys, used through Laravel Cashier | Billing |

### Running with Sail

The repository still includes Laravel Sail's `docker-compose.yml` if you'd rather run the app in Docker. You'll need **Docker** (check it with `docker --version`), and `.env` needs these values in place of the Herd defaults:

```dotenv
APP_URL=http://localhost
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=sail
DB_PASSWORD=password
```

1. Duplicate the example environment file, apply the values above, then install dependencies and generate a key:

    ```bash
    cp .env.example .env
    composer install
    npm install
    php artisan key:generate
    ```

2. Build and start the application with Sail:

    ```bash
    ./vendor/bin/sail up -d
    ```

3. Apply database migrations:

    ```bash
    ./vendor/bin/sail artisan migrate
    ```

4. Seed the database with test data:

    ```bash
    ./vendor/bin/sail artisan db:seed
    ```

5. Compile assets and run the Vue frontend:

    ```bash
    npm run dev
    ```

The app is then served at `http://localhost`.

## Contributing

This project isn't in active development, so I'm not reviewing issues or pull requests. You're welcome to fork it and take it in your own direction under the license below.

## License

Released under the [MIT License](LICENSE).
