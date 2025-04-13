# Event Booking API (Laravel)

A RESTful API built using Laravel for managing events, attendees, and bookings.

---

## Features

-   **Event Management**: Create, update, delete, and list events
-   **Attendee Registration**: Register and manage attendees
-   **Event Booking**: Book attendees to events (with capacity check & duplicate prevention)
-   Meaningful validation & error handling
-   Unit tests for core booking logic
-   Postman collection included for easy testing
-   Clear database schema with proper relationships

---

## Getting Started

### Requirements

-   PHP 8.1+
-   Composer
-   MySQL
-   Laravel 10+

---

### Setup Instructions

```bash
# 1. Clone the repo
git clone https://github.com/yourusername/event-booking-api.git
cd event-booking-api

# 2. Install dependencies
composer install

# 3. Copy .env and set DB credentials
cp .env.example .env

# 4. Generate app key
php artisan key:generate

# 5. Update .env with your DB config
DB_DATABASE=event_booking
DB_USERNAME=root
DB_PASSWORD=your_password

# 6. Run migrations and seed data
php artisan migrate --seed

# 7. Serve the app
php artisan serve
```

---

## Key API Endpoints

| Method | Endpoint            | Description               |
| ------ | ------------------- | ------------------------- |
| GET    | /api/events         | List all events           |
| POST   | /api/events         | Create a new event        |
| GET    | /api/events/{id}    | View a specific event     |
| PUT    | /api/events/{id}    | Update an event           |
| DELETE | /api/events/{id}    | Delete an event           |
| GET    | /api/attendees      | List all attendees        |
| POST   | /api/attendees      | Register a new attendee   |
| GET    | /api/attendees/{id} | View attendee details     |
| PUT    | /api/attendees/{id} | Update attendee           |
| DELETE | /api/attendees/{id} | Delete attendee           |
| POST   | /api/bookings       | Book an attendee to event |

---

## Running Tests

```bash
php artisan test
```

Includes tests for:

-   Successful booking
-   Preventing duplicate bookings
-   Handling overbooked events
-   Booking with non-existent attendee

---

## Postman Collection

A Postman collection is included to test all endpoints.

> File: `docs/event booking.postman_collection.json`

Import it in Postman to test:

-   Event creation/listing
-   Attendee registration
-   Booking scenarios

---

## Authentication (Not Implemented)

Authentication is out of scope but recommended in production.

-   **Event and Booking APIs**: should require authenticated users
-   **Attendee registration**: can remain public
-   Suggested Auth options: [Laravel Sanctum](https://laravel.com/docs/sanctum) or [Passport](https://laravel.com/docs/passport)

---

## Database Schema Overview

-   **events**: `id`, `name`, `description`, `location`, `capacity`
-   **attendees**: `id`, `name`, `email`
-   **bookings**: `id`, `event_id`, `attendee_id` (unique pair)

Relationships:

-   `Event` has many `Bookings`
-   `Attendee` has many `Bookings`
-   Each `Booking` belongs to an `Event` and an `Attendee`

---

## Optional: Serverless Notification Service (Bonus)

**Designed using AWS Serverless tools** (architecture diagram included):

-   **EventBridge** → receives events
-   **Lambda** → enriches and routes notifications
-   **SNS / SES** → sends push & email
-   **WebSocket (API Gateway)** → real-time browser notifications
-   **DynamoDB** → manages connected sessions

> Architecture diagram included in `/docs/architecture diagram.png`

---

## Author

**Your Name**  
📫 [GitHub](https://github.com/yourusername) | ✉️ your.email@example.com

---

## License

This project is open-sourced for educational and evaluation purposes only.
