# BurgerRiza

BurgerRiza is a web-based application designed to manage a burger restaurant's menu, customer orders, and user authentication. It supports two types of users: restaurant owners (R) and customers (C). The project is built using PHP, MySQL, and TailwindCSS for styling.

## Features

### For Restaurant Owners (Role: R)
- **Add Burgers**: Add new burgers to the menu with details like name, price, extras, and quantity.
- **View Menu**: View all burgers added by the restaurant.
- **Edit/Delete Burgers**: Update or remove burgers from the menu.
- **Authentication**: Secure login and logout functionality.

### For Customers (Role: C)
- **View Restaurants**: Browse a list of restaurants.
- **View Menu**: View the menu of a selected restaurant.
- **Add to Cart**: Add burgers to the cart for checkout.
- **Authentication**: Secure login and logout functionality.

## Project Structure

### Folder and File Hierarchy
```
# BurgerRiza
|-- add.php
|-- cart.php
|-- config
|   |-- connection.php
|-- db
|   |-- burgerriza.sql
|   |-- users.sql
|-- details.php
|-- index.php
|-- orders.php
|-- restaurantMenu.php
|-- sign-in.php
|-- sign-up.php
|-- template
|   |-- footer.php
|   |-- header.php
|   |-- index
|       |-- customer.php
|       |-- restaurant.php
```

### Files and Directories
- **`add.php`**: Handles adding burgers to the menu for restaurant owners.
- **`details.php`**: Displays burger details and allows editing or deleting for authorized users.
- **`cart.php`**: Displays the customer's cart and allows item removal or checkout.
- **`index.php`**: The main entry point that displays either the restaurant's menu or the list of restaurants based on the user's role.
- **`restaurantMenu.php`**: Displays the menu of a specific restaurant for customers.
- **`sign-in.php`**: Handles user login.
- **`sign-up.php`**: Handles user registration.
- **`orders.php`**: Placeholder for future order management functionality.
- **`config/connection.php`**: Contains database connection logic.
- **`template/header.php`**: Contains the common header and navigation bar.
- **`template/footer.php`**: Contains the common footer.
- **`template/index/restaurant.php`**: Displays the restaurant's menu.
- **`template/index/customer.php`**: Displays the list of restaurants for customers.
- **`db/burgerriza.sql`**: SQL dump of the database schema and sample data.
- **`db/users.sql`**: SQL dump for user privileges.

## Database Schema

### Tables
1. **`burgers`**: Stores burger details (name, price, extras, quantity, etc.).
2. **`cart`**: Stores cart details for customers.
3. **`orders`**: Stores order details (future functionality).
4. **`user`**: Stores user details (email, password, role, etc.).

### Relationships
- `burgers.user_added_id` references `user.user_id`.

## Code Style

### PHP
- **Prepared Statements**: Used for database queries to prevent SQL injection.
- **Session Management**: Sessions are used for user authentication and role-based access control.
- **Error Handling**: Errors are displayed for debugging purposes but should be replaced with proper logging in production.

### HTML
- **Separation of Concerns**: Common components like the header and footer are included using `require`.
- **Dynamic Content**: PHP is used to dynamically generate content based on user roles and database queries.

### CSS
- **TailwindCSS**: Used for styling with utility-first classes.

### JavaScript
- **Dynamic Forms**: JavaScript is used to dynamically generate form fields (e.g., in `add.php`).
- **Interactive Elements**: Functions like `toggle()` and `collectExtras()` enhance interactivity.

## How It Works

### User Authentication
1. Users can sign up via `sign-up.php` and log in via `sign-in.php`.
2. Sessions store user details like role, email, and ID.
3. Role-based access control ensures users can only access authorized pages.

### Restaurant Owner Workflow
1. Log in as a restaurant owner.
2. Add burgers via `add.php`.
3. View and manage the menu via `index.php` and `details.php`.

### Customer Workflow
1. Log in as a customer.
2. Browse restaurants via `index.php`.
3. View a restaurant's menu via `restaurantMenu.php`.
4. Add items to the cart and proceed to checkout (future functionality).

## Setup Instructions

1. **Clone the Repository**:
   ```bash
   git clone <repository-url>
   ```
2. **Set Up the Database**:
   - Import `db/burgerriza.sql` into your MySQL server.
   - Ensure the database credentials in `config/connection.php` match your setup.
3. **Run the Application**:
   - Place the project in your XAMPP `htdocs` directory.
   - Start Apache and MySQL from the XAMPP control panel.
   - Access the application at `http://localhost/BurgerRiza`.

## Future Enhancements
- Implement order management in `orders.php`.
- Add a checkout process for customers.
- Improve error handling and logging.
- Enhance security (e.g., password hashing with `password_hash`).

## License
This project is for educational purposes and is not licensed for commercial use.

## Author
BurgerRiza Development Team
