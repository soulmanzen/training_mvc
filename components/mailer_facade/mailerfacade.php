<?php

class MailerFacade
{
    private $mailer;

    public function __construct(PHPMailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendConfirmation($to, $subject, $body)
    {
        $this->mailer->isSMTP();                                      // Set mailer to use SMTP
        $this->mailer->Host = Config::get('smtp_server');  // Specify main and backup SMTP servers
        $this->mailer->SMTPAuth = true;                               // Enable SMTP authentication
        $this->mailer->Username = Config::get('email_login');                 // SMTP username
        $this->mailer->Password = Config::get('email_pass');                           // SMTP password
        $this->mailer->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $this->mailer->Port = 587;                                    // TCP port to connect to

        $this->mailer->setFrom(Config::get('email_from'), Config::get('email_from_name'));
        $this->mailer->addAddress($to, Session::get('user'));     // Add a recipient

        $this->mailer->isHTML(true);                                  // Set email format to HTML
        $this->mailer->Subject = "$subject";
        $this->mailer->Body    = "<b>$body</b>";
        $this->mailer->AltBody = "$body";

        $this->mailer->send();
    }
}