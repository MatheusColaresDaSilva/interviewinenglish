<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    
   
    $to_gmail = 'contact@interviewinenglish.com';  // Your Gmail address

    // Subject
    $subject = 'New Form Query From Our Website';

    // Message content
    $body = "Hi! Anyone is Interested in Your Session Plans.\n\n";
    $body .= "Name: $name\n";
    
    $body .= "Email: $email\n";
    
    $body .= "Message: $message\n";
    
    // Check if emails were sent successfully
    if (mail($to_gmail, $subject, $body)){
        header('location: bra.php?msg=Obrigado por entrar em contato.');
    } else {
        echo 'Desculpe, tente novamente mais tarde';
    }
}
?>
