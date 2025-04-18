<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form with reCAPTCHA</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script> <!-- reCAPTCHA script -->
</head>
<body>

    <h2>Contact Us</h2>
    <form action="process_form.php" method="POST">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="message">Message:</label><br>
        <textarea id="message" name="message" required></textarea><br><br>

        <!-- Google reCAPTCHA -->
        <div class="g-recaptcha" data-sitekey="6LfpkvQqAAAAAHjrNi564UBL-2QQXH0PHRWIFTA3"></div><br>

        <input type="submit" value="Submit">
    </form>

</body>
</html>
