<?php
/**
 * Created by PhpStorm.
 * User: MrHung
 * Date: 12/7/13
 * Time: 11:11 AM
 */

class Email
{


    protected $fromEmail;
    protected $toEmail;
    protected $subject;
    protected $Attachment;


    //getter
    function getFromEmal()
    {
        return $this->fromEmail;
    }

    function getToEmail()
    {
        return $this->toEmail;
    }

    function getSubject()
    {
        return $this->subject;
    }

    function getAttachment()
    {
        return $this->Attachment;
    }

    //setter
    function setFromEmail($value)
    {
        return $this->fromEmail = $value;
    }

    function setToEmail($value)
    {
        return $this->toEmail = $value;
    }

    function setSubject($value)
    {
        return $this->subject = $value;
    }

    function setAttachment($value)
    {
        return $this->Attachment = $value;
    }


    //contruct
    function Email($Recipients,$subject,$content,$attachment)
    {
        include 'phpMailer/class.phpmailer.php';
        $mail = new PHPMailer(); // defaults to using php "mail()"

        $mail->IsSendmail(); // telling the class to use SendMail transport

        $body = $content;
        //$body = preg_replace("[\]", '', $body);

        $mail->SetFrom(ADMIN_EMAIL, 'LUCENONE');// SENDER

        $mail->AddReplyTo(ADMIN_EMAIL);//Reply to this email

        $address = $Recipients;// Recipients  Emai

        $mail->AddAddress($address, "Lucenone");

        $mail->IsHTML(true);

        $mail->Subject = $subject;

        $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

        $mail->MsgHTML($body);
        // attachment
        $mail->AddAttachment($_SERVER['DOCUMENT_ROOT'].'/upload/'.$attachment);

        if (!$mail->Send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;

        } else {
            echo "Message sent!";exit;
        }
    }
}