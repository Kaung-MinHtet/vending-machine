# Vending Machine System - Project Setup Guide

## **1. System Requirements**
Before starting, ensure you have the following installed:
- PHP `>= 8.1`
- Composer `>= 2.0`
- MySQL `>= 5.7`
- Node.js `>= 16`
- NPM or Yarn
- Laravel `11`

## **2. Clone the Repository**
```bash
git clone https://github.com/Kaung-MinHtet/vending-machine.git
cd vending-machine
```

## **3. Install Dependencies**
### **Backend (Laravel)**
```bash
composer install
```

### **Frontend (Tailwind CSS & Assets)**
```bash
npm install && npm run build
```

## **4. Configure Environment**
Create a `.env` file by copying the example:
```bash
cp .env.example .env
```
Edit `.env` and set up your database details:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=vending_machine
DB_USERNAME=root
DB_PASSWORD=yourpassword
```

## **5. Generate Application Key**
```bash
php artisan key:generate
```

## **6. Set Up the Database**
```bash
php artisan migrate --seed
```
This will create the required tables and seed the admin/user data.

## **7. Run the Application**
```bash
php artisan serve
```
Visit: `http://127.0.0.1:8000`

## **8. Running Tests**
To execute PHPUnit tests:
```bash
php artisan test
```

## **9. API Setup (Sanctum Authentication)**
If using the API, ensure you have Laravel Sanctum installed:
```bash
php artisan migrate
```

## **10. Deployment Notes**
- **Set up a web server (Apache/Nginx)** with Laravel configurations.
- **Run database migrations** on the production database.

For further details, refer to the project documentation. 🚀

