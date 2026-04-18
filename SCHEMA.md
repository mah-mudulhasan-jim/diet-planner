```markdown
# Database Architecture

The application relies on a relational database structure featuring four primary tables.

### 1. `users`
Handles authentication, role management, and core biometrics.
* `id` (PK)
* `name`, `email`, `password`
* `is_admin` (Boolean)
* `height_cm` (Integer)
* `current_weight_kg` (Decimal)
* `goal_type` (Enum: lose, maintain, gain)

### 2. `weight_logs`
Tracks the user's weight history over time.
* `id` (PK)
* `user_id` (FK -> users.id)
* `weight_kg` (Decimal)
* `date` (Date)

### 3. `foods`
The global directory of searchable food items.
* `id` (PK)
* `name` (String, Unique)
* `calories_per_100g` (Integer)
* `protein_g`, `carbs_g`, `fat_g` (Decimal)

### 4. `meal_logs`
Records what a user ate, connecting users to the global food directory.
* `id` (PK)
* `user_id` (FK -> users.id)
* `food_id` (FK -> foods.id)
* `date` (Date)
* `meal_type` (Enum: breakfast, lunch, dinner, snack)
* `quantity_g` (Integer)

**Relationships:**
* A `User` has many `WeightLogs` and `MealLogs`.
* A `Food` belongs to many `MealLogs`.