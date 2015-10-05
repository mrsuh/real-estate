<?php namespace Mrsuh\RealEstateBundle\Model;


class MailModel
{
    private $mailer;
    private $mailerUser;

    public function __construct($mailer, $mailerUser)
    {
        $this->mailer = $mailer;
        $this->mailerUser = $mailerUser;
    }

    public function sendMail($params)
    {
        $mailer = $this->mailer;

        $message = $mailer->createMessage()
            ->setSubject($params['subject'])
            ->setTo($params['to'])
            ->setFrom($this->mailerUser)
            ->setBody($params['body'], 'text/html');

        if(isset($params['attach'])){
            $message->attach(\Swift_Attachment::fromPath($params['attach']));
        }

        $mailer->send($message);
    }
}