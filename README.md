# EUA Task

## Installation

Clone the repository

```bash
git clone https://github.com/macroactive-io/plugin-period-tracker.git
```

Switch to the repo folder

```bash
cd plugin-period-tracker
```

Install all the dependencies using composer

```bash
composer install
```

Copy the example env file and make the required configuration changes in the .env file
```bash
cp .env.example .env
```

Generate a new application key
```bash
php artisan key:generate
```
Run the database migrations 

**Set the database connection in .env before migrating

```bash
php artisan migrate
```

Install Node dependencies

```bash
npm install
```

Run the dev

```bash
npm run dev
```

OR
Start the local development server

```bash
php artisan serve
```

You can now access the server at http://localhost:8000

## Known Issues
- Sometimes when we tap enter button instead of clicking the Get weather info 
button in the dashboard it will throw and error.(Error identified)
- Tests are not there
- Email template needs attention.
- Button should be implemented to subscribe for weather updates notifications.

Please review [our security policy](https://github.com/pasanks/managely/security/policy) on how to report security vulnerabilities.


## Security Vulnerabilities

Please review [our security policy](https://github.com/pasanks/managely/security/policy) on how to report security vulnerabilities.

## License

This project is not open-sourced and is the intellectual property of **MacroActive**.
