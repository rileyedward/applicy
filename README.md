# Applicy

Streamline your job application journey.

## Overview

### What is Applicy?

Applicy is a comprehensive online platform that simplifies your job application process. Create a personalized profile to seamlessly track all your job applications and monitor their progress in real time. With Applicy, you can easily organize your job search efforts, making it simpler to stay on top of your applications and secure your next opportunity.

### Why Use Applicy?

Job hunting is often overwhelming. Keeping track of applications, customizing resumes, and writing countless cover letters takes time and effort. Let Applicy handle the details, so you can focus on preparing for interviews and securing your dream job.

### Key Features

- **Application Tracker**: Keep track of the different job applications you have submitted as well as the status of each of them.
- **Resumes**: Upload and store your resumes and have the AI assistant for recommendations on your Resume based on the job you're applying for.
- **Cover Letters**: Upload and store your cover letters to have the AI assistant make different versions for the various jobs you're applying for.

## Getting Started

### Prerequisites

Ensure you have the following prerequisites installed on your system. You can verify each installation by running the provided commands in your terminal.

1. **PHP** is required for the application. Check if PHP is installed by running:

   ```bash
   php --version
   ```

2. **Composer** is necessary for managing PHP dependencies. Verify its installation with:

   ```bash
   composer --version
   ```

3. **Docker** is used for containerization. Confirm Docker is installed by running:

   ```bash
   docker --version
   ```

4. **Node** and **NPM** (Node Package Manager) are needed for managing frontend dependencies. Check their installations with:

   ```bash
   node --version
   npm --version
   ```

### Installation

1. Duplicate the example environment file and configure it with your settings:

   ```bash
   cp .env.example .env
   ```

2. Install PHP and JavaScript dependencies:

   ```bash
   composer install
   npm install
   ```

3. Generate a new PHP application key:

   ```bash
   php artisan key:generate
   ```

4. Use Sail to build and start the application:

   ```bash
   ./vendor/bin/sail up -d
   ```

5. Apply database migrations:

   ```bash
   sail artisan migrate
   ```

6. Seed the database with test data:

   ```bash
    sail artisan db:seed
   ```

7. Compile assets and run the Vue frontend:

   ```bash
   npm run dev
   ```
