<?php
namespace Fayouz\Laminas\Mailer\Core\Service;

use Fayouz\Laminas\Mailer\Core\Adapter\MailAdapterInterface;


/**
 *
 */
class MailerService implements MailerServiceInterface
{
    /**
     * @var MailAdapterInterface
     */
    private MailAdapterInterface $adapter;
    
    /**
     * @param $adapter
     */
    public function __construct($adapter){
        
        $this->adapter = $adapter;
    }
    
    /**
     * @param $data
     * @return mixed
     */
    public function parse($data): mixed
    {
        return $this->adapter->parse($data);
    }
    
    /**
     * @param $data
     * @return string
     */
    public function send($data): string
    {
        $message = $this->parse($data);
        return $this->adapter->send($message);
    }
    
}
