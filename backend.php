<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $recaptchaSecret = "6Ld4VBQrAAAAAEfkYmVdqtT74XNIiPlEfuE4i-FU"; // Replace this
    $recaptchaResponse = $_POST['g-recaptcha-response'];

    // Step 1: Verify CAPTCHA with Google
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = [
        'secret' => $recaptchaSecret,
        'response' => $recaptchaResponse
    ];

    $options = [
        'http' => [
            'method' => 'POST',
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'content' => http_build_query($data)
        ]
    ];

    $context = stream_context_create($options);
    $verify = file_get_contents($url, false, $context);
    $captchaSuccess = json_decode($verify);

    // Step 2: If CAPTCHA success, send email
    if ($captchaSuccess->success) {
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $messageContent = htmlspecialchars($_POST['message']);

        $to = "onlineinterviewcoach@gmail.com";
        $subject = "New Form Submission";
        $message = "Name: $name\nEmail: $email\nMessage: $messageContent";
        $headers = "From: $email";

        if (mail($to, $subject, $message, $headers)) {
            echo json_encode(["success" => true, "message" => "Captcha verified. Email sent successfully."]);
        } else {
            echo json_encode(["success" => false, "message" => "Captcha verified, but the email could not be sent."]);
        }
        } else {
            echo json_encode(["success" => false, "message" => "reCAPTCHA verification failed."]);
        }
}
?>
