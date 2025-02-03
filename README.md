# E-Commerce System

## Overview

This project is a full-fledged **E-Commerce System** designed to simulate the workflow of a typical online store. It includes essential functionalities such as user authentication, product management. The system allows customers to browse and purchase products, while administrators have full control over product management, order tracking, and user data. The application supports multiple languages, enhancing accessibility for a diverse user base.

## Features

- **Security Measures**: Protect against SQL injection and ensure data integrity throughout the application.
- **Multi-Language Support**: Offers a seamless experience across multiple languages.
- **User Registration & Login**: Secure user authentication using session-based management.
- **Product Listing**: Display products with details like price, description, and images.
- **Admin Dashboard**: Admin users can manage products, orders, and users through a dedicated interface.
- **Responsive Design**: The application is designed to be responsive and accessible across all device sizes.

## Technologies Used

### Frontend:
- **HTML5**: Structuring the web pages.
- **CSS3**: Styling the user interface.
- **JavaScript**: Adding interactivity and client-side logic.
- **Bootstrap**: Ensuring responsive design and layout consistency across different screen sizes.

### Backend:
- **PHP**: Server-side scripting for handling business logic, form submission, and database interactions.
- **MySQL**: A database management system for storing and managing product, user, and order information.

## Installation

Follow the steps below to set up the project locally:

### Prerequisites
- PHP 7.4 or higher
- MySQL 5.7 or higher
- A web server like Apache or Nginx
- Composer (for dependency management)

### Step-by-Step Guide

1. **Clone the Repository:**
   ```bash
   git clone https://github.com/Mos3aB696/eCommerce.git
   cd eCommerce
   ```

2. **Database Setup:**
   - Create a MySQL database for the project.
   - Import the SQL dump provided in the `db` folder (`ecommerce.sql`) to initialize the database schema and seed data.
   - Configure the database connection in `config.php`:
     ```php
     define('DB_SERVER', 'localhost');
     define('DB_USERNAME', 'your_username');
     define('DB_PASSWORD', 'your_password');
     define('DB_NAME', 'your_database_name');
     ```

3. **Language Configuration:**
   - Update the language settings in the application to support your preferred languages. The configuration can typically be found in a language-specific configuration file.

4. **Start the Web Server:**
   - Ensure your PHP server is running (Apache or Nginx).
   - Point your server’s root to the project folder.

5. **Access the Application:**
   - Open your browser and navigate to `http://localhost/eCommerce` to view the front-end.
   - Admin functionalities are accessible at `http://localhost/eCommerce/admin`.

## Admin Dashboard

To access the admin dashboard for managing products and orders, use the following credentials:

- **Email**: `admin@example.com`
- **Password**: `admin123`

## Folder Structure

```
eCommerce/
│
├── admin/                   # Admin dashboard files
├── assets/                  # Static assets like images, styles, and scripts
├── includes/                # Reusable PHP code (database connections, utilities)
├── public/                  # Publicly accessible files (e.g., index.php)
├── db/                      # SQL database dump
├── config.php               # Application configuration and environment variables
├── languages/               # Language files for multi-language support
└── README.md                # Project documentation
```

## Contribution

We welcome contributions from the community! To contribute:

1. Fork the project.
2. Create a new branch with a descriptive name: `git checkout -b feature-xyz`.
3. Make your changes and test them.
4. Commit your changes: `git commit -m 'Add new feature'`.
5. Push to your branch: `git push origin feature-xyz`.
6. Submit a pull request.

Please make sure that your code is clean, follows coding standards, and includes relevant documentation.

## Contact

If you have any questions or need further assistance:

**Mosaab Abdelkawy**
- [LinkedIn](https://www.linkedin.com/in/mosaab-abdelkawy/)
- [YouTube](https://youtube.com/@tapseta696?si=7q1LRJdUoOW2Yamk)
