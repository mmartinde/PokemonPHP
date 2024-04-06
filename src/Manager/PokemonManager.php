<?php

namespace App\Manager;

use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class PokemonManager
{
    protected $imageManager;
    protected $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->imageManager = new ImageManager(new Driver());
        $this->mailer = $mailer;
    }

    public function upload(UploadedFile $file, $targetPath)
    {
        $fileName = uniqid().".".$file->guessExtension();

        try{
            $file->move($targetPath, $fileName);
        }catch (\Exception $e){

        }

        $originalImage = $this->imageManager->read($targetPath."/".$fileName);
        $originalImage->greyscale();
        $originalImage->place("$targetPath/upgrade.png");
        $originalImage->save();

        return $fileName;
    }

    public function sendMail()
    {
        $email = (new Email())
            ->from('moycarretero@gmail.com')
            ->to('hola@franciscoarteaga.com')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Esto es un correo de prueba!')
            ->text('Se ha insertado un Pokemon')
            ->html('<p>Se ha insertado un Pokemon</p>');

        $this->mailer->send($email);
    }
}
