CREATE DATABASE IF NOT EXISTS `urbano_db`;

USE `urbano_db`;

CREATE TABLE IF NOT EXISTS `users` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(50) NOT NULL,
    `surname` VARCHAR(50) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE (email)
);

INSERT INTO `users` (`id`, `name`, `surname`, `password`, `email`) VALUES (null, 'Admin', 'Admin', '$2y$10$fEtWv97EOEe9kA5cc4GBiuoPIZ4HQN7Dnso1lGOXMjg/xWC8lAVIa', 'admin@admin.com');
