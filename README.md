# Lietuva

## Overview
A modern web application built with Laravel, Tailwind CSS v3, JavaScript, Livewire v3.

## Features
- User profiles with profile pictures
- Category-based landing pages
- Similar to [Scobo.lt](https://scobo.lt/) in functionality

## Tech Stack
- **Backend:** Laravel 11
- **Frontend:** Tailwind CSS v3, JavaScript, Livewire v3
- **Database:** MySQL
- **Hosting:** Hostinger Web Hosting

## Requirements
- PHP >= 8.1
- Composer
- Node.js >= 14.x
- NPM

## Local Installation



### Install Dependencies
```bash
# Using standard composer
composer install

# OR if using composer.phar
php composer.phar install

# Install Node.js dependencies
npm install
```

### Environment Setup
```bash
# Create environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Configure your database in .env file
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```

### Create storage link for profile pictures
```bash
php artisan storage:link
```

### Run Migrations
```bash
php artisan migrate
```


## Development Workflow

### Working with Tailwind CSS
This project uses Tailwind CSS v3 for styling. The configuration file is located at `tailwind.config.js`.

```bash
# Watch for changes during development
npm run watch
# Or run the build
npm run build
```


### Deployment Steps
```bash
# Navigate to project directory
cd /home/u641435575/domains/{domain_name}

# Pull latest changes
git pull origin main

# Install dependencies if needed
# Using composer.phar for Hostinger environment
php composer.phar install

# Install or update Node modules
npm install

# Build assets for production
npm run build

# Create storage link for profile pictures (if not already done)
cd /home/domains/{domain name}
php artisan storage:link
```

## License
All Rights Reserved
This project and its source code are proprietary and confidential. No part of this project may be reproduced, distributed, or transmitted in any form or by any means, without the prior written permission of the copyright holder.
@Netas Neverauskas 2025

## Contact
Name: Netas Neverauskas
Email: netas369@gmail.com

