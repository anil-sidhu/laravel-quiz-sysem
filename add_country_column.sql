-- SQL to add country column to users table
-- Run this in your MySQL database

ALTER TABLE `users` 
ADD COLUMN `country` VARCHAR(255) NULL DEFAULT 'India' AFTER `mobile`;
