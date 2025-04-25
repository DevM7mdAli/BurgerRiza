# BurgerRiza

A web-based restaurant management system built with PHP, MySQL, and TailwindCSS. The system supports two types of users: restaurant owners and customers.

## 🚀 Features

### Restaurant Owners (Role: owner)
- Add, edit and delete burgers from their menu
- View their restaurant's menu
- Manage burger details (name, price, extras, quantity)
- Upload burger images
- Secure authentication system

### Customers (Role: customer)
- Browse list of restaurants
- View restaurant menus
- Add items to cart
- Manage shopping cart
- Place orders (future feature)
- Secure authentication system

## 🏗 Project Structure

```
BurgerRiza/
├── assets/            # Static assets like logos
├── config/           # Configuration files
├── CSS/             # Stylesheets
├── db/              # Database schemas
├── JS/              # JavaScript files
├── template/        # PHP template files
├── uploads/         # User uploaded files
└── utils/           # Utility functions
```

## 📦 Database Schema

### Core Tables
1. `user` - Stores user information and authentication
2. `restaurant` - Restaurant details
3. `product` - Menu items/burgers
4. `cart` - Shopping cart information
5. `cart_item` - Individual items in carts
6. `order_table` - Customer orders
7. `invoice` - Order invoices and details

## 🛠 Setup Instructions

1. **Clone the Repository**:
   ```bash
   git clone <repository-url>
   cd BurgerRiza
   ```

2. **Set Upload Permissions**:
   ```bash
   chmod 777 uploads
   ```
   > ⚠️ The uploads directory must have 777 permissions to allow file uploads

3. **Database Setup**:
   - Create a MySQL database named 'riza'
   - Import `db/final databse of riza.sql`
   - Configure database connection in `config/connection.php`

4. **Frontend Setup**:
   ```bash
   npm install
   npm run tailwind
   ```

5. **XAMPP Configuration**:
   - Place project in XAMPP's htdocs directory
   - Start Apache and MySQL services
   - Access at http://localhost/BurgerRiza

## 🔒 Security Features

- Prepared SQL statements to prevent SQL injection
- Password hashing using MD5 (Note: Future upgrade to stronger hashing planned)
- Session-based authentication
- Role-based access control
- File upload validation and sanitization
- Input sanitization and validation

## 💻 Development Guidelines

### Branch Protection
- Direct pushes to main branch are prohibited
- All changes must be made through Pull Requests
- Pull Requests require review and approval

### Code Style
- Use prepared statements for all database queries
- Validate and sanitize all user inputs
- Follow PSR coding standards
- Use TailwindCSS utility classes for styling

## 🎯 Future Enhancements

1. Order Management System
2. Payment Gateway Integration
3. Restaurant Rating System
4. Advanced Search and Filtering
5. Real-time Order Tracking
6. Email Notifications
7. Upgrade Password Hashing to bcrypt

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Commit your changes
4. Push to your branch
5. Create a Pull Request

> ⚠️ Remember: No direct pushes to main branch allowed. All changes must go through PR review.

## 📄 License

This project is for educational purposes and is not licensed for commercial use.

## 👥 Authors

BurgerRiza Development Team

## 📞 Support

For support or issues, please file an issue in the repository's issue tracker.
