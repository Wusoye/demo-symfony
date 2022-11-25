<?php

namespace App\Notification;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class Sender
{

    protected $entityManager;
    protected $mailer;

    public function __construct(EntityManagerInterface $entityManager, MailerInterface $mailer)
    {
        $this->entityManager = $entityManager;
        $this->mailer = $mailer;
    }

    public function sendNewUserNotificationAdmin(User $user) {
        //file_put_contents('debug.txt', ((new \DateTime())->format('Y-m-d H:i:s'). ' - '. $user->getEmail()) );
        $email = (new Email())
            ->from('accounts@series.fr')
            ->to('admin@series.fr')
            ->subject('New account created')
            //->text('')
            ->html('<h1>New Account</h1><br>email: ' . $user->getEmail());

        $this->mailer->send($email);
    }

}