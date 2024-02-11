# XML-Parser

This project is an example of processing XML data and using it in a Laravel application. It performs an operation to fetch product data from an XML url and save it to the database.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites

To run this project, you'll need the following software and tools:

-   PHP 7.x
-   Composer
-   MySQL or another database management system

### Installation

1. Clone the project to your computer:
2. Install the project dependencies by running the following command in the project's root directory:
    ```
    composer install
    ```
3. Setup your .env file with your database credentials and other settings:
    ```
    cp .env.example .env
    ```
4. If you don't have any xml url you can use projects own endpoints to test the application:
    ```
    http://localhost:8000/mock1.xml or http://localhost:8000/mock2.xml
    ```
5. Run the migrations and seeders to create the database tables:
    ```
    php artisan migrate
    php artisan db:seed
    ```
6. Run test cases:
    ```
    php artisan test
    ```
7. Start the Laravel development server:

```
php artisan serve
```

8. You can fetch xml data using the following command:
    ```
    php artisan ParseXml
    ```
9. Or you can run php artisan schedule to fetch data every hour:
    ```
    php artisan schedule:work
    ```
10. You can use the following endpoint with Get Request to fetch the data from the database:
    ```
    http://localhost:8000/products
    ```
11. You can also send a GET request to the following endpoint to fetch the specific data from the database:
    ```
    http://localhost:8000/products/{id}
    ```
