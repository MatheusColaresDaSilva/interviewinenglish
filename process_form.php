<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if reCAPTCHA response is received
    if (isset($_POST['g-recaptcha-response'])) {
        $secretKey = "6LfpkvQqAAAAAHjrNi564UBL-2QQXH0PHRWIFTA3";  // Replace with your reCAPTCHA secret key
        $responseKey = $_POST['g-recaptcha-response'];
        $userIP = $_SERVER['REMOTE_ADDR'];

        // Google reCAPTCHA verification
        $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";
        $response = file_get_contents($url);
        $responseKeys = json_decode($response, true);

        // Check if the reCAPTCHA verification was successful
        if (intval($responseKeys["success"]) === 1) {
            // reCAPTCHA passed, process form data
            $name = $_POST['name'];
            $email = $_POST['email'];
            $message = $_POST['message'];

            // Send email
            $to = "your-email@example.com";  // Replace with your actual email
            $subject = "New Contact Form Submission";
            $emailBody = "Name: $name\nEmail: $email\nMessage: $message";
            $headers = "From: $email\r\n";

            if (mail($to, $subject, $emailBody, $headers)) {
                echo "Form submitted successfully! Your message has been sent.";
            } else {
                echo "Failed to send the email. Please try again later.";
            }
        } else {
            // reCAPTCHA failed
            echo "reCAPTCHA verification failed. Please try again.";
        }
    } else {
        // reCAPTCHA was not completed
        echo "Please complete the reCAPTCHA.";
    }
} else {
    echo "Invalid request.";
}
?>
