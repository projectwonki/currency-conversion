# 💱 Laravel Currency Conversion API

This is a simple Laravel-based REST API for converting Singaporean Dollars (SGD) to Polish Zloty (PLN). The exchange rate is stored in a database instead of using an external API.

---

## 🚀 Features

- Convert SGD to PLN using a fixed exchange rate from the database
- REST API implementation following Laravel best practices
- Proper request validation and error handling
- Unit and functional tests for reliability

---

## 🛠 Installation

### 1️⃣ Clone the Repository
```bash
git clone https://github.com/projectwonki/currency-conversion.git
cd currency-conversion
```

### 2️⃣ Install Dependencies
```bash
composer install
```

### 3️⃣ Set Up Environment
Copy the `.env.example` file to `.env` and configure your database settings:
```bash
cp .env.example .env
php artisan key:generate
```

### 4️⃣ Migrate the Database
```bash
php artisan migrate --seed
```
This will create the necessary tables and seed the exchange rate.

### 5️⃣ Start the Application
```bash
php artisan serve
```
Now, your API should be running at `http://127.0.0.1:8000`.

---

## 📡 API Endpoints

### 🔹 Convert Currency
**Request:**
```http
POST /api/convert
```
**Body (JSON):**
```json
{
    "amount": 100
}
```
**Response:**
```json
{
    "success": true,
    "message": "Currency converted successfully",
    "data": {
        "amount": 100,
        "from": "SGD",
        "to": "PLN",
        "exchange_rate": "2.9700",
        "converted_amount": 297
    }
}
```

### 🔹 Error Handling Example
If `amount` is missing:
```json
{
    "success": false,
    "message": "An error occurred while converting currency.",
    "error": "The amount field is required."
}
```

---

## 🧪 Running Tests
Run all tests using:
```bash
php artisan test
```
or
```bash
vendor/bin/phpunit
```

---

## 🏗 Project Structure
```
/app
    /Http
        /Controllers
            CurrencyConvertController.php
    /Models
        ExchangeRate.php
/database
    /migrations
    /seeders
/routes
    api.php
/tests
```
- `CurrencyConvertController.php` → Handles conversion logic
- `ExchangeRate.php` → Model for storing exchange rates
- `api.php` → Defines API routes

---

## 📌 Notes
- The exchange rate is stored in the database and can be updated manually.
- The project follows PSR coding standards and Laravel best practices.
- Validation and error handling ensure a smooth user experience.
