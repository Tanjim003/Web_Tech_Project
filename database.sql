-- E-Welfare Bangladesh Database Schema
-- Create database
CREATE DATABASE IF NOT EXISTS ewelfare_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE ewelfare_db;

-- Users table for registration and login
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    role ENUM('volunteer', 'doctor', 'farmer', 'supporter') NOT NULL,
    district VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_username (username),
    INDEX idx_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Service applications table
CREATE TABLE IF NOT EXISTS service_applications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NULL,
    service_type ENUM('doctor', 'donation', 'tree_plantation', 'animal_welfare', 'food_support', 'farmer') NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    phone VARCHAR(20),
    application_data TEXT,
    status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL,
    INDEX idx_service_type (service_type),
    INDEX idx_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Doctor applications details
CREATE TABLE IF NOT EXISTS doctor_applications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    application_id INT NOT NULL,
    specialization VARCHAR(100),
    medical_license VARCHAR(255),
    availability TEXT,
    FOREIGN KEY (application_id) REFERENCES service_applications(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Donation applications
CREATE TABLE IF NOT EXISTS donation_applications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    application_id INT NOT NULL,
    donation_type ENUM('Financial', 'Material Goods', 'Both') NOT NULL,
    amount_items TEXT,
    FOREIGN KEY (application_id) REFERENCES service_applications(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Farmer applications
CREATE TABLE IF NOT EXISTS farmer_applications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    application_id INT NOT NULL,
    crops_animals TEXT,
    help_needed TEXT,
    area_village VARCHAR(200),
    FOREIGN KEY (application_id) REFERENCES service_applications(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Animal welfare applications
CREATE TABLE IF NOT EXISTS animal_welfare_applications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    application_id INT NOT NULL,
    interest_area VARCHAR(100),
    availability TEXT,
    FOREIGN KEY (application_id) REFERENCES service_applications(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Food support applications
CREATE TABLE IF NOT EXISTS food_support_applications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    application_id INT NOT NULL,
    participation_type VARCHAR(100),
    preferred_location VARCHAR(200),
    FOREIGN KEY (application_id) REFERENCES service_applications(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Password reset tokens
CREATE TABLE IF NOT EXISTS password_resets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL,
    token VARCHAR(255) NOT NULL,
    expires_at TIMESTAMP NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_email (email),
    INDEX idx_token (token)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Sessions table (optional, for custom session management)
CREATE TABLE IF NOT EXISTS user_sessions (
    id VARCHAR(128) PRIMARY KEY,
    user_id INT NOT NULL,
    ip_address VARCHAR(45),
    user_agent TEXT,
    last_activity TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
