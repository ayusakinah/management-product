
# Product Management

A system designed to simplify product data management for administrators through a web-based interface. The system includes basic CRUD functionality, complemented by additional features such as product image uploads, admin session management, and form validation to ensure the accuracy of the input data.


## Usage

- PHP
- MySQL (phpmyadmin)
- Bootstrap
- VSCode


## Features

-Add new products with various details, including product name, prices, stock, and an optional image.

-View the list of existing products along with their details.

-Edit product information, including updating prices, stock, and images.

-Delete unwanted product records without losing all the data from the database.


## Files

The project consists of the following main files and functionalities:

- service.php: This file handles with database connection, and handle insert, update, and deletion the data according the id

- index.php: This file contains the HTML form to add new products, displays the list of the products and provides options to edit and delete each product. It fetches product data from the database.

- supply.php: This file is responsible for updating product data, including recording details such as product ID, quantity, and the date of receipt, which are added to the product database.

- send.php: This file handles updating product data by recording details such as product ID, quantity, and the shipping date. The product data is decreased accordingly in the database.

- 500.html: A page that users are redirected to in case of a server error.

