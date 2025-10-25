# AI Coding Agent Instructions for Laravel-Stripe Project

Welcome! This document provides essential knowledge to help AI agents be productive in this Laravel-Stripe integration project.

## Project Overview

This project integrates Stripe payment processing into a Laravel application. It includes:
- **Controllers**: Handle HTTP requests and coordinate with services.
- **Services**: Encapsulate business logic, including Stripe API interactions.
- **Models**: Represent database entities and relationships.
- **Views**: Blade templates for rendering the frontend.

### Key Components
- **Stripe Integration**: Located in `app/Services/StripeService.php`. This service handles API calls to Stripe for creating charges, managing subscriptions, etc.
- **Payment Flows**: Controllers in `app/Http/Controllers` manage payment-related endpoints.
- **Database Migrations**: Found in `database/migrations`, these define the schema for storing Stripe-related data (e.g., customer IDs, payment intents).

## Developer Workflows

### Build and Test
- **Install Dependencies**: Run `composer install` for PHP dependencies and `npm install` for frontend assets.
- **Run Tests**: Use `php artisan test` for running PHPUnit tests.
- **Serve Locally**: Start the development server with `php artisan serve`.

### Debugging
- Use Laravel's built-in debugging tools like `dd()` and `Log::debug()`.
- Check Stripe API logs in the Stripe Dashboard for issues with API requests.

## Project-Specific Conventions

### Stripe API Usage
- All Stripe API interactions are centralized in `StripeService.php`. Avoid calling Stripe APIs directly in controllers or other parts of the codebase.
- Use environment variables (`.env`) for sensitive Stripe keys:
  ```
  STRIPE_SECRET_KEY=your_secret_key
  STRIPE_PUBLIC_KEY=your_public_key
  ```

### Error Handling
- Wrap Stripe API calls in try-catch blocks to handle exceptions gracefully.
- Log errors using Laravel's logging system (`Log::error()`).

### Blade Templates
- Use Blade templates in `resources/views` for rendering payment-related pages.
- Follow the naming convention: `payment.blade.php`, `subscription.blade.php`, etc.

## Integration Points

### External Dependencies
- **Stripe PHP SDK**: Installed via Composer (`stripe/stripe-php`).
- **Frontend Assets**: Managed with Laravel Mix (`webpack.mix.js`).

### Cross-Component Communication
- Controllers call services (e.g., `StripeService`) for business logic.
- Models interact with the database and are used in services and controllers.

## Examples

### StripeService Example
```php
// filepath: app/Services/StripeService.php
public function createCharge(array $data)
{
    try {
        return \Stripe\Charge::create($data);
    } catch (\Stripe\Exception\ApiErrorException $e) {
        Log::error('Stripe API Error: ' . $e->getMessage());
        throw $e;
    }
}
```

### Controller Example
```php
// filepath: app/Http/Controllers/PaymentController.php
public function charge(Request $request)
{
    $data = $request->validate([
        'amount' => 'required|numeric',
        'currency' => 'required|string',
        'source' => 'required|string',
    ]);

    $charge = $this->stripeService->createCharge($data);

    return response()->json($charge);
}
```

## Notes
- Always keep Stripe keys secure and avoid hardcoding them.
- Follow Laravel's conventions for organizing code and naming files.

Let us know if any section is unclear or needs more detail!
