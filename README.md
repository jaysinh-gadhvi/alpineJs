# Alpine.js CRUD Projects with MySQL and Pure Frontend

This repository features three Alpine.js CRUD (Create, Read, Update, Delete) implementations to help developers explore different backend and frontend configurations. Whether you're working with PHP, CodeIgniter 3, or a pure frontend, these projects demonstrate effective CRUD operations with Alpine.js. 📊✨

## Projects Included

### 1. **Alpine-Crud-OOP**: PHP with Object-Oriented Programming 🐘

This project uses PHP OOP principles for CRUD operations with Alpine.js. MySQL database connectivity is configured to store and retrieve user data.

- **Project Directory**: `alpine-php/Alpine-Crud-OOP`
- **Database Config**: `includes/db-config.php`

### 2. **Alpine-Crud-Ci3**: CodeIgniter 3 Framework 🛠️

This project is developed with CodeIgniter 3 (CI3), showcasing CRUD operations with the MVC structure and Alpine.js for frontend interactivity.

- **Project Directory**: `alpine-php/Alpine-Crud-Ci3`
- **Database Config**: `application/config/database.php`

### 3. **Alpine-CRUD-NODB**: Pure Frontend CRUD without Database 🚀

The **Alpine-CRUD-NODB** project is a fully frontend-based implementation that doesn’t rely on a backend database. It demonstrates how to create, read, update, and delete data dynamically using Alpine.js alone. Ideal for learning CRUD basics and building lightweight, offline-ready applications.

- **Project Directory**: `alpine-php/Alpine-CRUD-NODB`
- **Database Config**: Not Required (Data is stored in the browser temporarily)

## MySQL Database Setup

For the **Alpine-Crud-OOP** and **Alpine-Crud-Ci3** projects, configure your MySQL database by running the following SQL commands to set up the necessary tables:

### Database Tables

#### 1. **Customers Table** (For Alpine-Crud-OOP) 📝

```sql
CREATE TABLE IF NOT EXISTS `customers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
```

#### 2. **Users Table** (For Alpine-Crud-Ci3) 👤

```sql
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `age` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `gender` varchar(255) NOT NULL,
  `skills` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
```

## Project Setup Instructions

1. Clone or download this repository to your local environment.
2. Ensure MySQL and Apache (or equivalent web server) are running.

### Database Configuration

- **Alpine-Crud-OOP**: Update database settings in `alpine-php/Alpine-Crud-OOP/includes/db-config.php`.
- **Alpine-Crud-Ci3**: Update database settings in `alpine-php/Alpine-Crud-Ci3/application/config/database.php`.

### Running Each Project

After configuring the database, navigate to the respective project folder and open the project URL in your browser:

- **Alpine-Crud-OOP**: PHP OOP CRUD
- **Alpine-Crud-Ci3**: CodeIgniter 3 CRUD
- **Alpine-CRUD-NODB**: Pure frontend CRUD, no backend needed

---

Enjoy exploring Alpine.js CRUD with both MySQL-backed and database-free implementations! 🚀
