<?php
namespace Fayouz\Laminas\Mailer\Core\Service;

use Interop\Container\ContainerInterface;
use Laminas\Mail;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

/**
 *
 */
class MailerService implements MailerServiceInterface
{
    /**
     *
     */
    public function __construct(){
    
    }
    
    /**
     * @return string
     * @throws Exception
     */
    public function send(): string
    {
        $mailer = new PHPMailer();
        $mailer->isSMTP();
        $mailer->Host= 'mailhog';
        $mailer->SMTPAuth=true;
        $mailer->Username = '';
        $mailer->Password = '';
        $mailer->Port = '1025';
    
        $mailer->Body = ('This is the text of the email.');
        $mailer->setFrom('elfayouz@gmail.com', "Nom du connard");
        $mailer->addAddress('elfayouz@gmail.com', 'Name of recipient');
        $mailer->Subject = ('TestSubject');
    
        $mailer->send();
    
        if( $mailer->isError()){
            throw new Exception('Erreur d envoi de mail');
        }
      
        return true;
    }
}
