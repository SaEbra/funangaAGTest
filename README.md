# Funanga AG Test

## Project Description
Funanga AG Test is a PHP-based web application that allows users to register and log in to access a dashboard. The application includes a simple user management system, where users can create accounts and log in using their credentials.

## Table of Contents
- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Running the Application](#running-the-application)


## Prerequisites
- PHP (>= 7.4)
- MySQL (or compatible database)

## Installation
1. **Clone the repository**:
    ```bash
        git clone https://github.com/SaEbra/funangaAGTest.git 
    ```
    ```bash
        cd funangaAGTest
    ```
2. **Create mysql database**:
   create Mysql Data base name "ag_test"
    ```bash
        CREATE DATABASE ag_test;
   ```
   create table "users"
   ```bash
        CREATE TABLE users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) NOT NULL,
            email VARCHAR(100) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL
        );
    ```

3. **Run the Server**:
    ```bash
        php -S localhost:8000
   ```