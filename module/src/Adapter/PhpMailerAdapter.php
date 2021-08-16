<?php
namespace Fayouz\Laminas\Mailer\Core\Adapter;

use Fayouz\Laminas\Mailer\Core\Model\Message;
use Laminas\Mime\Mime;
use Laminas\Mime\Part;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

/**
 *
 */
class PhpMailerAdapter implements MailAdapterInterface
{
    
    /**
     * @var PHPMailer
     */
    private PHPMailer $mailer;
    
    /**
     * @var
     */
    private $message;
    
    /**
     *
     */
    public function __construct($options){
        
        $this->mailer = new PHPMailer(true);
        $this->mailer->isSMTP();
        $this->mailer->CharSet = 'utf-8';
      
        foreach ($options as $key => $value){
            $this->mailer->{$key}= $value;
        }
    }
    
    /**
     * @param $params
     * @return Message
     */
    public function parse($params): Message
    {
        $parts = [];
        if( isset($params['AltBody'])){
            $part           = new Part($params['AltBody']);
            $part->type     = Mime::TYPE_TEXT;
            $part->charset  = 'utf-8';
            $part->encoding = Mime::ENCODING_QUOTEDPRINTABLE;
            $parts[] = $part;
        }
    
    
        if( isset($params['Body'])){
            $part           = new Part($params['Body']);
            $part->type     = Mime::TYPE_HTML;
            $part->charset  = 'utf-8';
            $part->encoding = Mime::ENCODING_QUOTEDPRINTABLE;
            $parts[] = $part;
        }
    
    
        foreach($params['attachments'] as $attachment){
            $part              = new Part(file_get_contents($attachment['tmp_name']));
            $part->type        = $attachment['type'];
            $part->filename    = $attachment['name'];
            $part->disposition = Mime::DISPOSITION_ATTACHMENT;
            $part->encoding    = Mime::ENCODING_BASE64;
            $parts[] = $part;
        }
    
    
        $content = new \Laminas\Mime\Message();
        // This order is important for email clients to properly display the correct version of the content
        $content->setParts($parts);
    
        $body = new \Laminas\Mime\Message();
        $body->setParts($content->getParts());
    
        $message = new Message();
        //Recipients
        $message->addFrom($params['from']);
        $message->addTo($params['to']);
        $message->addReplyTo($params['replyTo']);
        $message->addCc($params['cc']);
        $message->addBcc($params['bcc']);
    
        //Content
        $message->setIsHtml($params['isHtml']);
        $message->setBody($body);
        $message->setSubject($params['Subject']);
    
        return $message;
    }
    
    /**
     * @throws Exception
     */
    public function send(Message $message): bool
    {
        $this->convertMessageToPhpMailer($message);
    
        $this->mailer->send();
    
        if( $this->mailer->isError()){
            throw new Exception('Erreur d envoi de mail');
        }
    
        return true;
    }
    
    /**
     * @param Message $message
     * @throws Exception
     */
    private function convertMessageToPhpMailer(Message $message){
        foreach ($message->getFrom() as $from){
            $this->mailer->setFrom($from->getEmail(), $from->getName());
        }
        
        foreach ($message->getTo() as $recipient){
            $this->mailer->addAddress($recipient->getEmail(), $recipient->getName());
        }
        
        foreach ($message->getReplyTo() as $replyTo){
            $this->mailer->addReplyTo($replyTo->getEmail(), $replyTo->getName());
        }
        
        foreach ($message->getCc() as $cc){
            $this->mailer->addReplyTo($cc->getEmail(), $cc->getName());
        }
        
        foreach ($message->getBcc() as $bcc){
            $this->mailer->addReplyTo($bcc->getEmail(), $bcc->getName());
        }
        
        
        $this->mailer->Subject = $message->getSubject();
        
        $this->mailer->Body = '';
        $this->mailer->AltBody  = '';
        foreach ($message->getBody()->getParts() as $key => $p){
            if( $p->disposition == Mime::DISPOSITION_ATTACHMENT){
                
                $this->mailer->addStringAttachment(
                    $p->getContent(),
                    $p->getFileName()
                );
                continue;
            }
            
            if($p->type == Mime::TYPE_HTML){
                $this->mailer->Body .=$p->getContent();
            }
            
            if($p->type == Mime::TYPE_TEXT){
                $this->mailer->AltBody .=$p->getContent();
            }
        }
        
        
        $this->mailer->isHTML($message->isHtml());
        
        //Attachments
        //   $this->mailer->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $this->mailer->addAttachment('/tmp/image.jpg', 'new.jpg');
        
    }
    
    
}
