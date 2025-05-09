# TeamRoom - Meeting Rooms Booking Platform

<p align="center">
  <img src="public/assets/dashboard/images/team-room-dashboard.svg" alt="TeamRoom Logo" width="300">
</p>

<p align="center">
  <strong>Connect, Book, Collaborate</strong>
</p>

## 🚀 Overview

TeamRoom is a comprehensive peer-to-peer platform designed to revolutionize the way professionals book and manage meeting spaces. Our platform connects space owners with individuals and teams seeking the perfect environment for their meetings, presentations, and collaborative sessions.

With an intuitive interface and powerful features, TeamRoom streamlines the entire process from listing to booking, making it effortless for hosts to monetize their unused spaces and for renters to find exactly what they need.

## ✨ Key Features

### For Renters
- **Smart Search & Filtering**: Find spaces by location, capacity, amenities, and availability
- **Real-Time Availability**: View up-to-date calendars for all spaces
- **Instant Booking**: Secure your ideal space in just a few clicks
- **Detailed Space Profiles**: View high-quality photos, amenities, and reviews
- **Booking Management**: Track, modify, or cancel bookings from your dashboard
- **Review System**: Share your experience with the community

### For Hosts
- **Easy Space Listing**: Create detailed listings with our multi-step form
- **Flexible Scheduling**: Set custom availability and pricing
- **Booking Control**: Review and approve booking requests
- **Host Dashboard**: Track earnings, bookings, and space performance
- **Secure Payments**: Receive payouts securely and on time
- **Analytics**: Gain insights into your space's performance

### For Companies
- **Team Management**: Add and manage team members
- **Centralized Booking**: Coordinate meeting spaces for your entire team
- **Billing Management**: Streamline payment processes
- **Usage Reports**: Track space utilization and spending

## 🛠️ Technology Stack

- **Backend**: PHP 8.2+, Laravel 11
- **Frontend**: Blade templates, JavaScript, Alpine.js
- **UI Frameworks**: Tailwind CSS, Bootstrap 5.3
- **Database**: MySQL (configurable with other Laravel-supported databases)
- **Authentication**: Laravel Breeze
- **Rich Text Editing**: TinyMCE
- **Deployment**: Compatible with Vercel, Heroku, or traditional servers

## 📋 Prerequisites

- PHP >= 8.2
- Composer
- Node.js >= 18.x
- MySQL or any Laravel-supported database
- Git

## 🔧 Installation

```bash
# Clone the repository
git clone https://github.com/yourusername/TeamRoom.git

# Navigate to the project directory
cd TeamRoom

# Install PHP dependencies
composer install

# Install NPM dependencies
npm install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Configure your database in .env file
# Then run migrations and seeders
php artisan migrate --seed

# Compile assets
npm run dev

# Start the server
php artisan serve
```

## 🚦 Getting Started

### As a Host
1. Register an account and select "Host" as your role
2. Complete your profile information
3. Add your space(s) with detailed information, photos, and availability
4. Set your pricing and booking preferences
5. Start receiving booking requests

### As a Renter
1. Create an account and select "Renter" as your role
2. Browse available spaces using filters to match your needs
3. Select a space and check availability on the calendar
4. Book your desired time slot and complete payment
5. Receive confirmation and access details

### As an Administrator
Access the admin dashboard at `/admin` with admin credentials to:
- Manage users, spaces, and bookings
- Review and moderate content
- Access system analytics and reports
- Configure system settings

## 📱 Responsive Design

TeamRoom is fully responsive and optimized for:
- Desktop computers
- Tablets
- Mobile devices

## 📄 License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

---

<p align="center">
  <strong>TeamRoom</strong> - Where great meetings begin
</p>
```

This enhanced README provides a more professional and comprehensive overview of your TeamRoom project. It includes:

1. A centered logo and tagline
2. A detailed overview section
3. Expanded feature lists organized by user type
4. A more detailed technology stack section
5. Clear installation instructions with code blocks
6. Getting started guides for different user roles
7. Responsive design information
8. Professional formatting with emojis for section headers
9. A branded footer

The structure is more visually appealing and provides better information organization, making it easier for users to understand what your project offers and how to use it.