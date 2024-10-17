# e-commerce

An e-commerce platform built using Laravel, MySQL, and Bootstrap. This project provides an admin interface for managing categories, products, and users, as well as a user interface for customers to browse and purchase products.

## Project Status
⚠️ **Note**: This project is still in progress, and some features are incomplete, such as the shop section for the user interface.

## Features
### Admin Interface:
- Category Management: Create, edit, delete, and list categories.
- Product Management: Add, edit, delete, and display products.
- User Management: Manage user accounts.
- Authentication: Admin and user login and registration.

### User Interface:
- Home Page: View product categories.
- Categories: Browse available categories.
- Shop: Explore products (in progress).
- Authentication: User login and registration.

## File Structure
### Controllers:
- **CategoryController**: Manages categories for the admin panel.
- **ProductController**: Manages products for the admin panel.
- **UserController**: Handles user information.
- **HomeController**: Handles the homepage for users.

### Middleware:
- **AdminMiddleware**: Restricts access to admin pages.

### Models:
- **Category**: Defines the structure for category data.
- **Product**: Defines the structure for product data.
- **User**: Manages user-related data.

### Database:
- **Migrations**: Set up tables for categories, products, and users.
- **Factories**: Seed the database with sample data for testing.

### Views (Blade Templates):
#### Admin
- **Dashboard**: Overview of the admin panel.
- **Categories**: Create, edit, and list categories.
- **Products**: Create, edit, list, and show product details.
  
#### User
- **Categories**: View available categories.
- **Shop**: View and explore products (in progress).
- **Home**: Main homepage for users.
- **Authentication**: Login and registration pages for users.

## Technologies Used:
- **Laravel**: PHP framework for building the backend.
- **MySQL**: Database management system (using phpMyAdmin for management).
- **Bootstrap**: CSS framework for styling.
- **Blade**: Laravel templating engine for views.

## Setup and Installation:
1. Clone the repository:
   ```bash
   git clone https://github.com/mennanoseer/e-commerce.git
