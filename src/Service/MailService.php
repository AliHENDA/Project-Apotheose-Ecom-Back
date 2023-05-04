<?php

namespace App\Service;

use Symfony\Component\Mime\Email;
use App\Repository\UserRepository;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;


class MailService {

    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendEmail($to): void
    {

            $email = (new Email())
            ->from('alihenda4@gmail.com')
            ->to($to)
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Commande ok')
            ->text('Merci!')
            ->html('<p>Merci!</p>');

        $this->mailer->send($email);
        

        // ...
    }
}