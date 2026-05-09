# Personal Diet Planner & Health Ecosystem

A comprehensive, full-stack Laravel web application designed to help users track their nutrition, monitor biometric progress, consult with verified dieticians, and receive AI-powered health insights.

## ✨ Core Features

*   **Intelligent Dashboard:** Real-time visual tracking of daily caloric intake, macronutrient breakdowns (Chart.js), and weight progression over time.
*   **Meal & Weight Tracking:** Comprehensive daily logging system that automatically calculates proteins, carbs, fats, and overall calories based on a curated food database.
*   **AI Health Assistant:** An integrated, context-aware AI chat interface that provides personalized dietary advice based on the user's specific biometric goals.
*   **Expert Marketplace:** A directory of verified nutritionists and dieticians.
*   **Appointment Booking Engine:** Users can seamlessly schedule 1-on-1 consultations, and experts can manage, confirm, or decline their incoming requests.
*   **Secure Direct Messaging:** A real-time, private chat inbox for communication between clients and nutritionists.
*   **Smart Global Notifications:** Context-aware alerts (via a navigation bell icon) that remind users to log meals, notify experts of pending bookings, and alert users of unread messages.
*   **Role-Based Access Control (RBAC):** Distinct dashboards and permissions for Standard Users, Nutritionists, and Administrators.

## 🛠 Tech Stack

*   **Backend:** Laravel (PHP 8+)
*   **Frontend:** Blade Templates, Tailwind CSS, Alpine.js
*   **Database:** MySQL
*   **Data Visualization:** Chart.js

## 🚀 Installation & Setup

1. **Clone the repository:**
   ```bash
   git clone [https://github.com/YOUR_USERNAME/diet-planner.git](https://github.com/mah-mudulhasan-jim/diet-planner.git)
   cd diet-planner


2. Install PHP and Node dependencies:
```bash
composer install
npm install
```

3. Environment Setup:
```bash
Copy the .env.example file to .env.

Generate an app encryption key: php artisan key:generate

Update the .env database credentials to point to your local MySQL instance.
```
4. Database Migration & Seeding:
```bash
php artisan migrate
php artisan db:seed --class=FoodSeeder
```
5. Run the Application:
```bash
php artisan serve
npm run dev
```