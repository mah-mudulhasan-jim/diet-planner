# 🥗 Smart Diet Planner & Macro Tracker

A full-stack web application designed to help users track their weight, log daily meals, and visualize their progress toward specific fitness goals (lose, maintain, or gain). Built with a focus on a clean, minimalist UI and dynamic data visualization.

## ✨ Core Features
* **Custom Biometric Authentication:** Secure user registration with custom fields for height, weight, and fitness goals.
* **Dynamic Algorithmic Goals:** Automatically calculates daily caloric targets based on real-time body weight and chosen goals.
* **Meal & Macro Tracking:** Log breakfast, lunch, dinner, and snacks with automatic calculations for calories, protein, carbs, and fats.
* **Data Visualization:** Interactive Chart.js integration featuring a Line Chart for weight history and a Doughnut Chart for daily macro breakdown.
* **Historical Data Export:** A dedicated history module with a date-picker to review past dietary logs and daily totals.
* **Secure Admin Panel:** Role-Based Access Control (RBAC) allowing administrators to CRUD items in the global food directory.
* **Responsive UI/UX:** Built with Tailwind CSS, ensuring a seamless experience across desktop and mobile devices, complete with custom 404 error handling.

## 🛠 Tech Stack
* **Backend:** PHP 8, Laravel 11
* **Frontend:** Blade Templating, Tailwind CSS, Alpine.js
* **Database:** MySQL
* **Visualizations:** Chart.js

## 🚀 Local Setup Instructions

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