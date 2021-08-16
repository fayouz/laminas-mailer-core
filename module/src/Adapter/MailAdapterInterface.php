<?php

namespace Fayouz\Laminas\Mailer\Core\Adapter;

use Fayouz\Laminas\Mailer\Core\Model\Message;

/**
 *
 */
interface MailAdapterInterface
{
    public function send(Message $message);
}
