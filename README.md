# Single Page Application

A modern single-page application built with Laravel and Vue.js.

## Requirements

- PHP >= 8.1    
- Composer
- Node.js & NPM
- MySQL or compatible database

## Installation

1. Clone the repository:
```bash
git clone <your-repository-url>
cd single-page
```

2. Install PHP dependencies:
```bash
composer install
```

3. Install JavaScript dependencies:
```bash
npm install
```

4. Set up environment variables:
```bash
cp .env.example .env
php artisan key:generate
```

5. Configure your database in the `.env` file:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

6. Run database migrations:
```bash
php artisan migrate
```

## Development

1. Start the Laravel development server:
```bash
php artisan serve
```

2. Start the Vite development server:
```bash
npm run dev
```

Your application will be available at `http://localhost:8000`

## Building for Production

1. Compile and minify assets:
```bash
npm run build
```

2. Configure your production environment variables in `.env`

3. Deploy to your production server

## Testing

Run the test suite:
```bash
php artisan test
```

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).