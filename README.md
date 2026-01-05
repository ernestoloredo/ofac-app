# OFAC Screening Application

A modern web application for screening individuals and entities against the Office of Foreign Assets Control (OFAC) sanctions lists. Built with Laravel and Vue.js, this tool helps organizations ensure compliance with U.S. Treasury Department sanctions regulations.

![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=flat&logo=laravel&logoColor=white)
![Vue.js](https://img.shields.io/badge/Vue.js-3.x-4FC08D?style=flat&logo=vue.js&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=flat&logo=php&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-green.svg)

## 🎯 Overview

The OFAC Screening Application provides a streamlined interface for conducting sanctions list searches against the U.S. Department of the Treasury's Office of Foreign Assets Control (OFAC) database. This tool is essential for:

- **Financial Institutions**: Comply with AML (Anti-Money Laundering) regulations
- **Payment Processors**: Screen transactions and parties
- **CDFIs**: Community Development Financial Institutions compliance
- **International Trade**: Due diligence for cross-border transactions
- **Legal & Compliance Teams**: Risk assessment and KYC (Know Your Customer) processes

## ✨ Features

- **Real-time Sanctions Screening**: Search against OFAC's Specially Designated Nationals (SDN) list
- **Comprehensive Search**: Query by name, date of birth, country, and other identifiers
- **Modern UI**: Intuitive interface built with Vue.js and Tailwind CSS
- **Fast Results**: Efficient search algorithms with detailed match information
- **Match Status Indicators**: Clear "Hit" or "Clear" status for each search
- **Detailed Records**: View complete information including aliases, addresses, and sanction details
- **Responsive Design**: Works seamlessly on desktop and mobile devices
- **RESTful API**: Backend API for integration with other systems

## 🚀 Technology Stack

- **Backend**: Laravel 11.x (PHP 8.2+)
- **Frontend**: Vue.js 3.x with Composition API
- **Styling**: Tailwind CSS
- **Build Tool**: Vite
- **Database**: MySQL/PostgreSQL compatible
- **Testing**: PHPUnit for backend, Vitest for frontend

## 📋 Requirements

- PHP 8.2 or higher
- Composer
- Node.js 18+ and npm
- MySQL 8.0+ or PostgreSQL 13+
- Git

## 🔧 Installation

### 1. Clone the Repository

```bash
git clone https://github.com/ernestoloredo/ofac-app.git
cd ofac-app
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install JavaScript Dependencies

```bash
npm install
```

### 4. Environment Configuration

```bash
cp .env.example .env
php artisan key:generate
```

Edit the `.env` file with your database credentials and other configurations:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ofac_app
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 5. Database Setup

```bash
php artisan migrate
php artisan db:seed  # Optional: seed with sample data
```

### 6. Build Frontend Assets

For development:
```bash
npm run dev
```

For production:
```bash
npm run build
```

### 7. Start the Development Server

```bash
php artisan serve
```

Visit `http://localhost:8000` in your browser.

## 🎮 Usage

### Basic Search

1. Navigate to the search page
2. Enter the required information:
   - Name (required)
   - Date of birth (optional)
   - Country (optional)
3. Click "Search" to initiate the screening
4. Review results:
   - **Hit**: Match found in OFAC sanctions list
   - **Clear**: No match found

### Search Parameters

- **Name**: Full name or partial name of the individual/entity
- **DOB**: Date of birth in YYYY-MM-DD format
- **Country**: ISO country code or full country name
- **ID Number**: Passport or national ID (if applicable)

## 🛠️ Development

### Running Tests

```bash
# Backend tests
php artisan test

# Frontend tests
npm run test
```

### Code Style

```bash
# PHP CS Fixer
./vendor/bin/php-cs-fixer fix

# ESLint
npm run lint
```

### Building for Production

```bash
composer install --optimize-autoloader --no-dev
npm run build
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## 📚 API Documentation

The application provides a RESTful API for programmatic access:

### Search Endpoint

```http
POST /api/search
Content-Type: application/json

{
  "name": "John Doe",
  "dob": "1980-01-01",
  "country": "US"
}
```

Response:
```json
{
  "status": "Hit" | "Clear",
  "matches": [
    {
      "name": "John Doe",
      "dob": "1980-01-01",
      "country": "United States",
      "aliases": [],
      "sanctions_program": "SDGT",
      "remarks": "..."
    }
  ]
}
```

## 🔒 Security & Compliance

- All searches are logged for audit purposes
- Implements secure authentication and authorization
- Regular updates from OFAC data sources
- Data encryption in transit and at rest
- GDPR and privacy-compliant data handling

**Important**: This tool is designed to assist with compliance screening. Organizations should:
- Implement additional due diligence procedures
- Consult with legal counsel regarding sanctions compliance
- Report positive hits to appropriate authorities as required
- Maintain comprehensive audit trails

## 📊 Data Sources

This application integrates with official OFAC data sources:
- Specially Designated Nationals (SDN) List
- Consolidated Sanctions List (CSL)
- Sectoral Sanctions Identifications List (SSI)

Data is refreshed regularly to ensure accuracy and compliance.

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

Please ensure your code follows the project's coding standards and includes appropriate tests.

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🙏 Acknowledgments

- [Laravel](https://laravel.com) - The PHP framework used
- [Vue.js](https://vuejs.org) - The progressive JavaScript framework
- [U.S. Department of the Treasury](https://www.treasury.gov/ofac) - OFAC data provider
- [Tailwind CSS](https://tailwindcss.com) - Utility-first CSS framework

## 📧 Contact

**Ernesto Loredo**
- GitHub: [@ernestoloredo](https://github.com/ernestoloredo)
- Project Link: [https://github.com/ernestoloredo/ofac-app](https://github.com/ernestoloredo/ofac-app)

## ⚠️ Disclaimer

This software is provided for informational and compliance assistance purposes only. It is not a substitute for professional legal or compliance advice. Users are responsible for ensuring their own compliance with applicable sanctions laws and regulations. The developers and contributors make no warranties regarding the accuracy or completeness of the data or functionality.

---

**Made with ❤️ for compliance professionals**
