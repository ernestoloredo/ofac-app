OFAC Screening Application
A modern web application for screening individuals and entities against the Office of Foreign Assets Control (OFAC) sanctions lists. Built with Laravel and Vue.js, this tool helps organizations ensure compliance with U.S. Treasury Department sanctions regulations.
Show Image
Show Image
Show Image
Show Image
🎯 Overview
The OFAC Screening Application provides a streamlined interface for conducting sanctions list searches against the U.S. Department of the Treasury's Office of Foreign Assets Control (OFAC) database. This tool is essential for:

Financial Institutions: Comply with AML (Anti-Money Laundering) regulations
Payment Processors: Screen transactions and parties
CDFIs: Community Development Financial Institutions compliance
International Trade: Due diligence for cross-border transactions
Legal & Compliance Teams: Risk assessment and KYC (Know Your Customer) processes

✨ Features

Real-time Sanctions Screening: Search against OFAC's Specially Designated Nationals (SDN) list
Comprehensive Search: Query by name, date of birth, country, and other identifiers
Modern UI: Intuitive interface built with Vue.js and Tailwind CSS
Fast Results: Efficient search algorithms with detailed match information
Match Status Indicators: Clear "Hit" or "Clear" status for each search
Detailed Records: View complete information including aliases, addresses, and sanction details
Responsive Design: Works seamlessly on desktop and mobile devices
RESTful API: Backend API for integration with other systems

🚀 Technology Stack

Backend: Laravel 11.x (PHP 8.2+)
Frontend: Vue.js 3.x with Composition API
Styling: Tailwind CSS
Build Tool: Vite
Database: MySQL/PostgreSQL compatible
Testing: PHPUnit for backend, Vitest for frontend

📋 Requirements

PHP 8.2 or higher
Composer
Node.js 18+ and npm
MySQL 8.0+ or PostgreSQL 13+
Git

🔧 Installation
1. Clone the Repository
bashgit clone https://github.com/ernestoloredo/ofac-app.git
cd ofac-app
2. Install PHP Dependencies
bashcomposer install
3. Install JavaScript Dependencies
bashnpm install
4. Environment Configuration
bashcp .env.example .env
php artisan key:generate
Edit the .env file with your database credentials and other configurations:
envDB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ofac_app
DB_USERNAME=your_username
DB_PASSWORD=your_password
5. Database Setup
bashphp artisan migrate
php artisan db:seed  # Optional: seed with sample data
6. Build Frontend Assets
For development:
bashnpm run dev
For production:
bashnpm run build
7. Start the Development Server
bashphp artisan serve
Visit http://localhost:8000 in your browser.
🎮 Usage
Basic Search

Navigate to the search page
Enter the required information:

Name (required)
Date of birth (optional)
Country (optional)


Click "Search" to initiate the screening
Review results:

Hit: Match found in OFAC sanctions list
Clear: No match found



Search Parameters

Name: Full name or partial name of the individual/entity
DOB: Date of birth in YYYY-MM-DD format
Country: ISO country code or full country name
ID Number: Passport or national ID (if applicable)

🛠️ Development
Running Tests
bash# Backend tests
php artisan test

# Frontend tests
npm run test
Code Style
bash# PHP CS Fixer
./vendor/bin/php-cs-fixer fix

# ESLint
npm run lint
Building for Production
bashcomposer install --optimize-autoloader --no-dev
npm run build
php artisan config:cache
php artisan route:cache
php artisan view:cache
📚 API Documentation
The application provides a RESTful API for programmatic access:
Search Endpoint
httpPOST /api/search
Content-Type: application/json

{
  "name": "John Doe",
  "dob": "1980-01-01",
  "country": "US"
}
Response:
json{
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
🔒 Security & Compliance

All searches are logged for audit purposes
Implements secure authentication and authorization
Regular updates from OFAC data sources
Data encryption in transit and at rest
GDPR and privacy-compliant data handling

Important: This tool is designed to assist with compliance screening. Organizations should:

Implement additional due diligence procedures
Consult with legal counsel regarding sanctions compliance
Report positive hits to appropriate authorities as required
Maintain comprehensive audit trails

📊 Data Sources
This application integrates with official OFAC data sources:

Specially Designated Nationals (SDN) List
Consolidated Sanctions List (CSL)
Sectoral Sanctions Identifications List (SSI)

Data is refreshed regularly to ensure accuracy and compliance.
🤝 Contributing
Contributions are welcome! Please follow these steps:

Fork the repository
Create a feature branch (git checkout -b feature/amazing-feature)
Commit your changes (git commit -m 'Add amazing feature')
Push to the branch (git push origin feature/amazing-feature)
Open a Pull Request

Please ensure your code follows the project's coding standards and includes appropriate tests.
📝 License
This project is licensed under the MIT License - see the LICENSE file for details.
🙏 Acknowledgments

Laravel - The PHP framework used
Vue.js - The progressive JavaScript framework
U.S. Department of the Treasury - OFAC data provider
Tailwind CSS - Utility-first CSS framework

📧 Contact
Ernesto Loredo

GitHub: @ernestoloredo
Project Link: https://github.com/ernestoloredo/ofac-app

⚠️ Disclaimer
This software is provided for informational and compliance assistance purposes only. It is not a substitute for professional legal or compliance advice. Users are responsible for ensuring their own compliance with applicable sanctions laws and regulations. The developers and contributors make no warranties regarding the accuracy or completeness of the data or functionality.

Made with ❤️ for compliance professionals
