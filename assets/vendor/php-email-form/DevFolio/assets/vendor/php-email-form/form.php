#Contact form

NOTE:  NEEDS An SMTP service on the website server.

<?php
    //Message Vars
    $msg = '';
    $msgClass = '';
    //check for the submit
    if(filter_has_var(INPUT_POST,'submit')){
    //Get form Data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    }
    //Check Required Fields
    if(!empty($email) && !empty($name) && !empty($message)){
        //passed
        //check enail
        if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
            //Failed
            $msg = 'email format is incorrect';
            $msgClass='alert-danger';
        }else{
            //Passed
            //send to Recipient email needs an email host to send it
            $toEmail = 'owuordove@gmail.com';

        }
        
    }else{
        //failed
        $msg = 'Please Fill in all fields completely';
        $msgClass='alert-danger';
        //Email Subject
        $subject = 'contact request from '.$name;
        //creat body of the email
        $body = "<h2>Contact Request</h2>
        <h4>Name</h4><p>'.$name.'</p>
        <h4>Email</h4><p>'.$email.'</p>
        <h4>Message</h4><p>'.$message.'</p>";

        //Email Header
        $headers = "MIME-VERSION: 1.0" . "\r\n";
        $headers .= "Content-Type:text/html;charset=UTF-8" . "/r/n";

        //Additional Headers
        $headers.= "From: ".$name."<" .$email. ">". "\r\n";

        if(mail($toEmail, $subject, $body, $headers)){
            //Email sent
            $msg = 'Email sent';
            $msgClass = 'alert-success';

        }else{
            $msg = 'Email has not been sent';
            $msgClass = 'alert-danger';
    }
    }
?>