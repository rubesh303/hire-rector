# Website Uptime Monitoring Application

This is a Laravel application for monitoring website uptime. It allows clients to have their websites checked every 15 minutes, and sends email notifications when a site goes down.

## Features

- Client management with email addresses
- Website monitoring with 10-second timeout
- Email notifications when websites go down
- Vue.js SPA frontend for selecting clients and viewing websites
- Scheduled job for periodic checks
- Unit and feature tests

## Requirements

- PHP 8.1+
- MySQL/MariaDB
- Node.js and npm
- Composer

## Installation

1. Clone the repository
2. Run `composer install`
3. Run `npm install`
4. Copy `.env.example` to `.env` and configure database and mail settings
5. Run `php artisan migrate`
6. Run `php artisan db:seed`
7. Run `npm run build`
8. Run `php artisan serve`

## Usage

- Visit the home page to select a client and view their websites
- Click on a website link to confirm visiting it in a new tab
- The monitoring job runs every 15 minutes via Laravel's scheduler

## Testing

Run `php artisan test` to execute the test suite.

## Deployment

- Set up a LAMP stack with Redis
- Configure mail driver (e.g., SES)
- Set up cron job for `php artisan schedule:run` every minute
- Ensure queue worker is running if using async queues

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
