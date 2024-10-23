<h1> <b> Result Checker Website </b> </h1>

<h2> <b> Project Overview </b> </h2>

The Result Checker Website allows students to check their academic results for a specific semester in a session by purchasing a unique pin. The website interacts with a database to verify the pin and retrieve the student's results if available.

<h2> <b> Features </b> </h2>


1. Pin Purchase: Users can buy a pin to check their results.
2. Result Retrieval: After entering the purchased pin, users can view their academic results for a particular semester.
3. Database Integration: Results are stored in a database and retrieved securely using the provided pin.
4. Session and Semester Selection: Allows users to select the specific session and semester for their results.

<h2> <b> Technologies Used </b> </h2>


1. <b> HTML5 </b> for structure
2. <b> CSS3 </b> for styling
3. <b> PHP </b> for server-side logic and database handling
4. <b> MySQL </b> (via <b> XAMPP </b> for the local database)

<h2> <b> Project Structure </b> </h2>

- <b> index.php: </b> The homepage where users can input necessary information to purchase pin.
- <b> pin.php: </b> The page where users will see the purchased pin after successful payment.
- <b> login.php: </b> The page where users can enter the purchased pin to check their result.
- <b> result.php: </b> The page where the users result will be displayed.
- <b> ResultChecker.php: </b> This file contains the necessary php functions and also database connection.
- <b> Auth.php: </b> This file contains the codes for authentication like creating database, tables.
- <b> styles.css: </b> Contains the styling files for the home page.
- <b> result.css: </b> Contains the styling files for the result page.
- <b> Dockerfile: </b> This file contains the instructions to create a Docker image for the project

<h2> <b> Screenshots </b> </h2>


1. Homepage
- ![Homepage Screenshot](screenshots/1..jpg)

2. Pin page
- ![Pinpage Screenshot](screenshots/2..jpg)

3. Login Page
- ![Loginpage Screenshot](screenshots/3..jpg)

4. Result Page
- ![Resultpage Screenshot](screenshots/4..jpg)

<h2> <b> Setup Instructions </b> </h2>


1. Clone the repository to your laptop, system or computer by running this:
```bash
   git clone https://github.com/Temitope1606/ResultChecker.git
  ```
2. Set up the database:
  - Make sure you have XAMPP or WAMP running.
  - Place the cloned repository in the htdocs folder (for XAMPP) or the www folder (for WAMP).
  - Open your browser and run localhost/foldername/Auth.php to create the necessary database and tables.
  - Update the database connection settings (like database name and table name) in the Auth.php file.
3. Access the website
  - Run this on your browser:
  - localhost/foldername/index.php

<h2> <b> Future Improvements </b> </h2>

- Email Notifications: Automatically send results to students via email after checking.
