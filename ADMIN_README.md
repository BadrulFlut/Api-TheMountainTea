# Admin Dashboard

A comprehensive admin dashboard built with Laravel and modern frontend technologies for managing users, products, and shipments.

## Features

### 🎯 Dashboard Overview
- **Statistics Cards**: View total users, products, and shipments at a glance
- **Recent Activity**: See latest users, products, and shipments
- **Quick Actions**: Quick access to common admin tasks
- **Responsive Design**: Works on desktop and mobile devices

### 👥 User Management
- **User List**: View all registered users with pagination
- **Create Users**: Add new user accounts with validation
- **Edit Users**: Update existing user information
- **Delete Users**: Remove user accounts with confirmation
- **Search & Filter**: Find users by name, email, or status

### 📦 Product Management
- **Product Inventory**: Manage product catalog with pagination
- **Add Products**: Create new products with categories and pricing
- **Edit Products**: Update product details and information
- **Delete Products**: Remove products from inventory
- **Advanced Filtering**: Filter by category, price range, and search terms

### 🚚 Shipment Management
- **Track Shipments**: Monitor delivery status and progress
- **Create Shipments**: Add new delivery orders
- **Update Status**: Change shipment status (pending, in transit, delivered, failed)
- **Priority Management**: Set and manage delivery priorities
- **Customer Information**: Track customer details and destinations

## Technology Stack

- **Backend**: Laravel 10+ with PHP 8+
- **Frontend**: Tailwind CSS, Alpine.js, Font Awesome
- **JavaScript**: Vanilla JS with modern ES6+ features
- **UI Components**: Responsive design with mobile-first approach
- **Icons**: Font Awesome 6.4.0 for consistent iconography

## Installation & Setup

### Prerequisites
- PHP 8.1 or higher
- Composer
- Laravel 10+
- Database (MySQL/PostgreSQL/SQLite)

### Setup Steps

1. **Clone/Setup Project**
   ```bash
   # If starting fresh
   composer create-project laravel/laravel your-project
   cd your-project
   
   # Or if adding to existing project
   # Ensure you have the required dependencies
   ```

2. **Install Dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment Configuration**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database Setup**
   ```bash
   php artisan migrate
   php artisan db:seed  # If you have seeders
   ```

5. **Start Development Server**
   ```bash
   php artisan serve
   npm run dev
   ```

## Usage

### Accessing the Admin Dashboard

1. **Navigate to Admin Panel**
   ```
   http://your-domain.com/admin
   ```

2. **Available Routes**
   - `/admin` - Main dashboard
   - `/admin/users` - User management
   - `/admin/products` - Product management
   - `/admin/shipments` - Shipment management

### Navigation

The admin panel features a responsive sidebar navigation:
- **Dashboard**: Overview and statistics
- **Users**: Manage user accounts
- **Products**: Manage product inventory
- **Shipments**: Track delivery orders

### Key Features

#### User Management
- Click "Add New User" to create accounts
- Use search bar to find specific users
- Click edit/delete icons for user actions
- All forms include validation and error handling

#### Product Management
- Add products with categories, pricing, and descriptions
- Filter products by category and price range
- Search across product names and descriptions
- Image URL support for product visuals

#### Shipment Tracking
- Create shipments with customer details
- Set delivery priorities (low, medium, high, urgent)
- Track status changes throughout delivery process
- Filter by status and priority levels

## Security Features

### Authentication
- Admin middleware protection for all admin routes
- CSRF token protection on all forms
- Session-based authentication

### Data Validation
- Server-side validation for all form inputs
- Client-side validation for better UX
- SQL injection protection through Laravel's Eloquent ORM

### Access Control
- Middleware-based route protection
- Extensible for role-based permissions
- Easy to customize for different admin levels

## Customization

### Adding New Features
1. **Create Controller Methods** in `AdminController`
2. **Add Routes** in `routes/web.php`
3. **Create Views** in `resources/views/admin/`
4. **Update Navigation** in `resources/views/admin/layouts/app.blade.php`

### Styling
- Uses Tailwind CSS for consistent design
- Color schemes can be customized in the CSS classes
- Responsive breakpoints follow Tailwind's mobile-first approach

### Database Models
- Extend existing models (`User`, `Barang`, `Pengiriman`)
- Add new models as needed
- Use Laravel migrations for database changes

## Troubleshooting

### Common Issues

1. **Routes Not Working**
   - Check if admin middleware is registered in `Kernel.php`
   - Verify route definitions in `web.php`
   - Clear route cache: `php artisan route:clear`

2. **Views Not Loading**
   - Ensure view files are in correct directories
   - Check for syntax errors in Blade templates
   - Clear view cache: `php artisan view:clear`

3. **Database Issues**
   - Run migrations: `php artisan migrate`
   - Check database connection in `.env`
   - Verify model relationships

### Performance Tips

- Use pagination for large datasets
- Implement caching for frequently accessed data
- Optimize database queries in controllers
- Use eager loading for related data

## Contributing

1. Follow Laravel coding standards
2. Add proper validation and error handling
3. Test all CRUD operations
4. Ensure responsive design works on all devices
5. Add appropriate documentation for new features

## License

This admin dashboard is part of your Laravel application and follows the same license terms.

## Support

For issues or questions:
1. Check Laravel documentation
2. Review error logs in `storage/logs/`
3. Verify database connections and migrations
4. Test with fresh installation if needed

---

**Note**: This admin dashboard is designed to be extensible and can be easily modified to fit specific business requirements. The modular structure allows for easy addition of new features and customization of existing ones.