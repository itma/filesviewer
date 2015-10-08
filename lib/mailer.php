<?php

require_once('PHPMailer/PHPMailerAutoload.php');

/**
 * The Mailer responses for messages sent via email 
 * @author andrew@itma.pl
 **/
class Mailer {

    public $mailer;
    public $config;

    /**
    * Prepares the object
    **/
    public function __construct($config) {
        $this->config = $config;
        $this->mailer = new PHPMailer();
        $this->mailer->isSMTP();
        $this->mailer->Host = $this->config['smtp_host'];
        $this->mailer->SMTPDebug = 3;
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = $this->config['smtp_user'];
        $this->mailer->Password = $this->config['smtp_password'];
        $this->mailer->SMTPSecure = 'tls';
        $this->mailer->Port = $this->config['smtp_port']; 
        $this->mailer->setFrom($this->config['smtp_email'], $this->config['smtp_from']);
        $this->mailer->isHTML(false);
    }
    
    /**
    * Sends confirmation message to a new user
    * @param $data array
    * @return boolean
    **/
    public function confirmAccountMessage(array $data) {

        print_r($data);

        $this->mailer->Subject = $data['name'] . ' confirm your account.';
        $this->mailer->Body    = "Hi " . $data['name'] . ",\n\n";
        $this->mailer->Body    .= "Thank you for creating an account. Now you have to confirm it by clicking the link below. After the confirmation has been done properly, you will be able to login into and get the hidden assets.\n\n";
        $this->mailer->Body    .= $this->config['site_url'] . "/confirm.php?hash=" . $data['hash'] . "\n\n";
        $this->mailer->Body    .= "Remember your credentials to login to the account:\n\n";
        $this->mailer->Body    .= "Login page: " . $this->config['site_url'] . "\n";
        $this->mailer->Body    .= "Login: " . $data['email'] . "\n";
        $this->mailer->Body    .= "Password: " . $data['password'] . "\n\n";
        $this->mailer->Body    .= "Best regards,\nAdmin";        
        $this->mailer->addAddress($data['email']);
        return $this->mailer->send();
    }
}


                

