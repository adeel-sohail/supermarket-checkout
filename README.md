# Supermarket Checkout Kata

A Laravel implementation of Dave Thomas' [Kata09: Back to the Checkout](http://codekata.com/kata/kata09-back-to-the-checkout/).

The kata implements a supermarket checkout that calculates the total price of scanned items while supporting both standard unit pricing and quantity-based special offers.

## Pricing Rules

| Item | Unit Price | Special Price |
|------|-----------:|--------------:|
| A | 50 | 3 for 130 |
| B | 30 | 2 for 45 |
| C | 20 | - |
| D | 15 | - |

Pricing rules are configured separately from the checkout logic in `config/pricing_rules.php`.

## Design

The implementation keeps the checkout independent of specific products and pricing strategies.

It uses:

- **Strategy Pattern** to encapsulate different pricing calculations.
- **Factory Pattern** to create the appropriate pricing strategy from the configured pricing rules.
- **PricingRules** to manage the available pricing strategies and item lookup.
- **Checkout** to track scanned items and calculate the total.

This separation allows pricing behavior to evolve without placing product-specific pricing logic inside the checkout.

## API

### Checkout

`POST /api/checkout`

Example request:

```json
{
    "items": ["A", "A", "A", "B"]
}
```

Example response:

```json
{
    "total": 160
}
```

An empty `items` array is supported and returns a total of `0`.

## Requirements
- PHP >= 8.3.9
- GIT
- Composer
- Laravel artisan cli
- Apache or Nginx (for this project simple laravel server is good to go)
- Postman client (optional but better to have)
- MySQL client (optional but highly recommended)

---

## Installation:
### 1. Clone the project into your server folder through

```shell
git clone https://github.com/adeel-sohail/supermarket-checkout.git
cd yourrepo
```
> **Hint:**
> - if GIT is not installed. Install it according to your OS from here. https://github.com/git-guides/install-git


## Installation

Install dependencies:

```bash
composer install
```

Create the environment file and application key:

```bash
cp .env.example .env
php artisan key:generate
```

Start the application:

```bash
php artisan serve
```

## Tests

Run all tests:

```bash
php artisan test
```

The project contains:

- **Unit tests** for checkout and pricing behavior.
- **Feature tests** for the checkout API.
