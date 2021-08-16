<?php
namespace Fayouz\Laminas\Mailer\Core\Model;

class Message extends \Laminas\Mail\Message {
    
    /**
     * Content of the message
     *
     * @var boolean
     */
    protected $isHtml;
    
    protected $altBody;
    
    /**
     * @return mixed
     */
    public function getAltBody()
    {
        return $this->altBody;
    }
    
    /**
     * @param mixed $altBody
     */
    public function setAltBody($altBody): void
    {
        $this->altBody = $altBody;
    }
    
    /**
     * @return bool
     */
    public function isHtml(): bool
    {
        return $this->isHtml;
    }
    
    /**
     * @param bool $isHtml
     */
    public function setIsHtml(bool $isHtml): void
    {
        $this->isHtml = $isHtml;
    }
    
  
}
