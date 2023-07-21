<?php
// Message Vars
$msg = '';
$msgClass = '';

// Check for the submit
if (isset($_POST['submit'])) {
    // Get form Data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Check Required Fields
    if (!empty($email) && !empty($name) && !empty($message)) {
        // Check email
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            // Failed
            $msg = 'Email format is incorrect';
            $msgClass = 'alert-danger';
        } else {
            // Passed
            // Send to Recipient email (you'll need a valid email host for this)
            $toEmail = 'dovetec.org@gmail.com';

            // Email Subject
            $subject = 'Contact request from ' . $name;

            // Create body of the email
            $body = "<h2>Contact Request</h2>
                     <h4>Name</h4><p>" . $name . "</p>
                     <h4>Email</h4><p>" . $email . "</p>
                     <h4>Message</h4><p>" . $message . "</p>";

            // Email Headers
            $headers = "MIME-VERSION: 1.0" . "\r\n";
            $headers .= "Content-Type: text/html;charset=UTF-8" . "\r\n";
            $headers .= "From: " . $name . " <" . $email . ">" . "\r\n";

            // Attempt to send the email
            if (mail($toEmail, $subject, $body, $headers)) {
                // Email sent successfully
                $msg = 'Email sent';
                $msgClass = 'alert-success';
            } else {
                // Email sending failed
                $msg = 'Email has not been sent';
                $msgClass = 'alert-danger';
            }
        }
    } else {
        // Failed: Some required fields are empty
        $msg = 'Please fill in all fields completely';
        $msgClass = 'alert-danger';
    }
}
?>
