<?php

    // Only process POST reqeusts.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form fields and remove whitespace.
        $personName = strip_tags($_POST['personName']);
        $personEmail = strip_tags($_POST['personEmail']);
        $personPhone = strip_tags($_POST['personPhone']);
        $personMessage = strip_tags($_POST['personMessage']);
        $personDet = strip_tags($_POST['personDet']);
        $personqueryReason = strip_tags($_POST['personqueryReason']);
    

        // Check that data was sent to the mailer.
        if ( empty($personName) OR empty($personEmail) OR empty($personPhone) OR empty($personMessage) OR empty($personDet) OR empty($personqueryReason) OR !filter_var($personEmail, FILTER_VALIDATE_EMAIL)) {
            // Set a 400 (bad request) response code and exit.
            http_response_code(400);
            //echo $personName.' '.$serviceName.' '.$phoneNumber.' '.$emailAddress;
            echo "Oops! There was a problem with your submission. Please complete the form and try again.";
            exit;
        }

        // Set the recipient email address.
        // FIXME: Update this to your desired email address.
        $recipient = "aryan.mayor@gmail.com";

        // Set the email subject.
        $subject = "New Message from ".$personName.' through your website';

        // Build the email content.
        $email_content = "Name: $personName\n";
        $email_content .= "Email Address of Person: $personEmail\n";
        $email_content .= "Phone Number: $personPhone\n";
        $email_content .= "Person Profession: $personDet\n";
        $email_content .= "Query Reason: $personqueryReason\n";
        $email_content .= "Message: $personMessage\n";

        // Build the email headers.
        $email_headers = "From: $personName <$personEmail>";

        // Send the email.
        if (mail($recipient, $subject, $email_content, $email_headers)) {
            // Set a 200 (okay) response code.
            http_response_code(200);
            echo "Thank You! Your message has been sent.";
        } else {
            // Set a 500 (internal server error) response code.
            http_response_code(500);
            echo "Oops! Something went wrong and we couldn't send your message.";
        }

    } else {
        // Not a POST request, set a 403 (forbidden) response code.
        http_response_code(403);
        echo "There was a problem with your submission, please try again.";
    }
