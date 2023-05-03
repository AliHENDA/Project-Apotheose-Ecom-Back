<?php

namespace App\Service;

use Symfony\Component\Mime\Email;
use App\Repository\UserRepository;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;


class MailService {

    private $mailer;
    private $userRepository;

    public function __construct(MailerInterface $mailer, UserRepository $userRepository)
    {
        $this->mailer = $mailer;
        $this->userRepository = $userRepository;

    }

    public function sendEmail(): void
    {
        
        $users = $this->userRepository->followers();

        foreach($users as $user) {
            $mail = $user["email"];

            $email = (new Email())
            ->from('alihenda4@gmail.com')
            ->to($mail)
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html('<p>See Twig integration for better HTML integration!</p>');

        $this->mailer->send($email);

        }
        

        // ...
    }
}