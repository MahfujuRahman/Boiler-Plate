# Moduler based admin panel boilerplate

This project is built with Laravel, Vue.js, and Inertia.js, providing a streamlined single-page application experience with support for image manipulation, Excel imports, job queue processing, and authentication.

---

## Table of Contents

- [Moduler based admin panel boilerplate](#moduler-based-admin-panel-boilerplate)
  - [Table of Contents](#table-of-contents)
  - [Requirements](#requirements)
  - [Installation](#installation)
  - [Frontend Setup (Vue.js)](#frontend-setup-vuejs)
  - [Inertia.js Setup](#inertiajs-setup)
  - [Packages and Dependencies](#packages-and-dependencies)
  - [Queue Job Setup](#queue-job-setup)
  - [Usage](#usage)

---

## Requirements

- PHP >= 7.3
- Composer
- Node.js & npm
- MySQL (or other supported database)
- Redis (optional, for enhanced queue management)

---

## Installation

1. **Clone the Repository**:

   ```bash
   git clone <repository-url>
   cd <project-directory>
   ```

2. **Install PHP Dependencies**:

   ```bash
   composer install
   ```

3. **Environment Setup**:
   Copy the example environment file and configure database and other environment variables:

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database Migration**:
   Run migrations to set up the database tables:
   ```bash
   php artisan migrate
   ```

---

## Frontend Setup (Vue.js)

1. **Install Laravel UI**:

   ```bash
   composer require laravel/ui
   ```

2. **Generate Vue Scaffolding**:

   ```bash
   php artisan ui vue
   ```

3. **Install JavaScript Dependencies**:
   ```bash
   npm install
   npm run dev
   ```

---

## Inertia.js Setup

1. **Install Inertia Laravel Adapter**:

   ```bash
   composer require inertiajs/inertia-laravel
   ```

2. **Install Inertia Middleware**:

   ```bash
   php artisan inertia:middleware
   ```

3. **Configure Inertia in `resources/views/app.blade.php`**:

   ```html
   <head>
     @vite('resources/js/app.js') @inertiaHead
   </head>
   <body>
     @inertia
   </body>
   ```

4. **Middleware Registration**:
   Register `HandleInertiaRequests` in `app/Http/Kernel.php` under `web` middleware group.

---

## Packages and Dependencies

Install additional packages required for this project:

```bash
composer require maatwebsite/excel:^3.1
composer require intervention/image
composer require inertiajs/inertia-laravel
composer require laravel/passport
```

---

## Queue Job Setup

1. **Create Jobs Table**:

   ```bash
   php artisan queue:table
   ```

2. **Set Queue Connection**:
   Set `QUEUE_CONNECTION=database` in your `.env` file.

3. **Run Migrations**:

   ```bash
   php artisan migrate
   ```

4. **Start Queue Worker**:
   To start processing jobs, use the following command:
   ```bash
   php artisan queue:work
   ```

---

## Usage

- **Excel Import**: Use `maatwebsite/excel` for importing Excel files.
- **Image Manipulation**: Use `Intervention Image` for resizing, cropping, and other image transformations.
- **Authentication**: Use Laravel Passport for API authentication.

# Project Deployment & File Tracking Documentation

This project uses custom deployment scripts and file tracking for efficient and safe updates to your server. Below are step-by-step instructions for setup, usage, and troubleshooting.

---

## 1. Folder Structure

- `.deploy_tools/` — Contains all deployment scripts, ignore files, and tracking utilities.
  - `.zip_ignore` — Patterns for files/folders to exclude from deployment zip.
  - `deploy_to_vps.sh` — Main deployment script (uploads the whole project as a zip).
  - `deploy_to_vps_via_file_tracking.sh` — Deploys only modified files using file tracking.
  - `deploy_setup_commands.sh` — Runs on the server after deployment (for cache clear, optimization, etc.).
  - `.modify_tracking/` — Stores file tracking data (e.g., `modified.json`).

---

## 2. How to Add/Update Files for Deployment

- Place new or updated files in your project as usual.
- If using file tracking, ensure your tracker (e.g., `tracker.js`) is running to update `.modify_tracking/modified.json`.
- If deploying the whole project, no extra steps are needed.

---

## 3. How to Ignore Files/Folders from Deployment

- Edit `.deploy_tools/.zip_ignore` and add patterns (one per line) for files/folders to exclude.
  - Example:
    ```
    node_modules/*
    node_modules/**/*
    .env
    .git/*
    *.log
    ```
- These patterns are relative to the project root.

---

## 4. How to Deploy (Full Project)

1. **Make the script executable (first time only):**
   ```bash
   chmod +x .deploy_tools/deploy_to_vps.sh
   ```
2. **Run the deployment script from the project root:**
   ```bash
   ./.deploy_tools/deploy_to_vps.sh
   ```
3. The script will:
   - Create a zip archive, excluding files in `.zip_ignore`.
   - Upload the zip to your VPS.
   - SSH into your VPS, unzip, run setup commands, and clean up.

---

## 5. How to Deploy Only Modified Files (File Tracking)

1. **Ensure `jq` is installed:**
   - Ubuntu/Debian: `sudo apt-get install jq`
   - CentOS/RHEL: `sudo yum install jq`
   - macOS: `brew install jq`
2. **Make the script executable (first time only):**
   ```bash
   chmod +x .deploy_tools/deploy_to_vps_via_file_tracking.sh
   ```
3. **Run the script from the project root:**
   ```bash
   ./.deploy_tools/deploy_to_vps_via_file_tracking.sh
   ```
4. The script will:
   - Read `.modify_tracking/modified.json` for changed files.
   - Upload only those files via `rsync`.
   - Run setup commands on the server.

---

## 6. How to Add/Update Server Setup Commands

- Edit `.deploy_tools/deploy_setup_commands.sh` to add any post-deployment steps (e.g., Laravel cache clear, migrations, npm build, etc.).
- Example for Laravel:
  ```bash
  #!/bin/bash
  php artisan o:clear
  php artisan config:cache
  php artisan route:cache
  php artisan view:cache
  ```
- Make sure the script is executable:
  ```bash
  chmod +x .deploy_tools/deploy_setup_commands.sh
  ```

---

## 7. Troubleshooting

- **File/folder is not ignored:**
  - Check your `.zip_ignore` patterns and make sure you run the script from the project root.
- **`deploy_setup_commands.sh` not found:**
  - Ensure it exists in `.deploy_tools/` and is not excluded by `.zip_ignore`.
- **`jq: command not found`:**
  - Install `jq` as shown above.
- **Permission denied:**
  - Make sure all scripts are executable (`chmod +x ...`).

---

## 8. Best Practices

- Keep all deployment and tracking tools in `.deploy_tools/` for organization.
- Regularly update `.zip_ignore` as your project grows.
- Test deployment on a staging server before production.

---

## 9. NPM Deployment Commands

You can use npm scripts to run your deployment easily:

- To deploy the whole project:
  ```bash
  npm run deploy:project
  ```
- To deploy only modified files (via file tracking):
  ```bash
  npm run deploy:files
  ```
