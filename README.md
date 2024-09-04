# TURF-BOOKING-WEBSITE
Web site made with PHP,HTML,CSS,JAVASCRIPT,MYSQL DATABASE

### 1. `login_interface.php`

- **Purpose**: Handles login for both turf owners and customers.
- **Functionality**:
  - Checks if the form submission is for an owner or customer.
  - Validates the email and password.
  - For owners: verifies credentials against the `owners` table.
  - For customers: verifies credentials against the `users` table, and uses `password_verify` for password validation.
  - On successful login, sets session variables and redirects to the appropriate page.
  - Displays error messages if login fails or if the email/password format is incorrect.

### 2. `turf_list.php`

- **Purpose**: Displays a list of turfs with weather information.
- **Functionality**:
  - Fetches turfs from the `owners` table.
  - Retrieves current weather information for each turf’s address using the Weather API.
  - Displays each turf’s image, name, email, location, and current weather.
  - Provides a button to book each turf, passing the turf ID via a form.

### 3. `book_turf.php`

- **Purpose**: Allows users to book time slots for a selected turf.
- **Functionality**:
  - Retrieves turf details and available slots from the database.
  - Displays time slots for booking, considering current time and availability.
  - Allows users to book available slots if the time is before the slot’s start time.
  - Shows user details using cookies.

### 4. `confirmation.php`

- **Purpose**: Displays booking confirmation details.
- **Functionality**:
  - Fetches turf and user details from the database using session variables.
  - Sends a booking confirmation email to the turf owner.
  - Updates the slot status to "unavailable" and logs the booking in the database.
  - Displays booking details and status on the page.
  - Provides an option for users to make an enquiry about the turf.

### 5. `database.php`

- **Purpose**: Manages database connection.
- **Functionality**:
  - Establishes a connection to the MySQL database using the `mysqli_connect` function.
  - Handles connection errors using a try-catch block.
  - If the connection fails, it prints an error message.

