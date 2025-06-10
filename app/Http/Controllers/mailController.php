<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class mailController extends Controller
{
    //
function mailFun($user_name,$stemail,$course,$password){
    $courses='' ;
    foreach($course as $course){
        $courses.=$course.(',');
    }
    $courses = rtrim($courses,', ');    
    $mail = new PHPMailer(true); // Create instance with exceptions enabled

    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Set your SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'wilson.pulivelugula@gmail.com';
        $mail->Password = 'lydm grct chxd wkee';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // or PHPMailer::ENCRYPTION_SMTPS
        $mail->Port = 587; // or 465 for SMTPS

        //Recipients
        $mail->setFrom('wilson.pulivelugula@gmail.com', 'Bravery');
        $mail->addAddress($stemail);

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'Admission';
        $mail->Body    = "
        <h2>congratulations $user_name </h2>
        <h2>Your email : $stemail </h2>
        <h2>Your email : $password </h2>
         <p>Your Admission is successfully processed  
        Your course details <b>$courses</b></p>
    

        ";

        $mail->send();
         return true;

    } catch (Exception $e) {
           return false;
        // return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
        }
}
