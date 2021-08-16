<?php

namespace Fayouz\Laminas\Mailer\Core\Options;

use Laminas\Stdlib\AbstractOptions;

/**
 * ModuleOptions
 */
class ModuleOptions extends AbstractOptions
{
    protected mixed $options;
    
    /**
     * @var
     */
    protected mixed $adapter;
    
    /**
     * @return mixed
     */
    public function getOptions(): mixed
    {
        return $this->options;
    }
    
    /**
     * @param mixed $options
     * @return ModuleOptions
     */
    public function setOptions(mixed $options): self
    {
        $this->options = $options;
        
        return $this;
    }
    
    /**
     * @return mixed
     */
    public function getAdapter(): mixed
    {
        return $this->adapter;
    }
    
    /**
     * @param mixed $adapter
     */
    public function setAdapter(mixed $adapter): void
    {
        $this->adapter = $adapter;
    }
    
    
    
}
