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

1. **PHP** (8.2+) is required for the application. Check it by running:

    ```bash
    php --version
    ```

2. **Composer** manages PHP dependencies. Check it by running:

    ```bash
    composer --version
    ```

3. **Docker** runs the application and its MySQL database through Laravel Sail. Check it by running:

    ```bash
    docker --version
    ```

4. **Node** and **NPM** manage frontend dependencies. Check them by running:

    ```bash
    node --version
    npm --version
    ```

### Installation

1. Duplicate the example environment file and configure it with your settings (see [Configuration](#configuration)):

    ```bash
    cp .env.example .env
    ```

2. Install PHP and JavaScript dependencies:

    ```bash
    composer install
    npm install
    ```

3. Generate a new application key:

    ```bash
    php artisan key:generate
    ```

4. Build and start the application with Sail:

    ```bash
    ./vendor/bin/sail up -d
    ```

5. Apply database migrations:

    ```bash
    ./vendor/bin/sail artisan migrate
    ```

6. Seed the database with test data:

    ```bash
    ./vendor/bin/sail artisan db:seed
    ```

7. Compile assets and run the Vue frontend:

    ```bash
    npm run dev
    ```

### Configuration

Set these in `.env` for the features that use them:

| Variable | What it's for | Needed for |
|---|---|---|
| `OPEN_AI_API_KEY` | OpenAI API key | The AI assistant for resumes and cover letters |
| `STRIPE_KEY`, `STRIPE_SECRET`, `STRIPE_WEBHOOK_SECRET` | Stripe keys, used through Laravel Cashier | Billing |

## Contributing

This project isn't in active development, so I'm not reviewing issues or pull requests. You're welcome to fork it and take it in your own direction under the license below.

## License

Released under the [MIT License](LICENSE).
