<?php

namespace Core;

use PHPMailer;

class Mail extends PHPMailer
{

    public function __construct()
    {
        $config = config('mail');

        $this->isSMTP();
        $this->isHTML();

        $this->Host = $config['host'];
        $this->Username = $config['username'];
        $this->Password = $config['password'];
        $this->SMTPSecure = $config['smtp_secure'];
        $this->Port = $config['port'];
        $this->CharSet = $config['charset'];
        $this->SMTPAuth = true;
    }

}
