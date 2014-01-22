<?php
namespace Via\Bundle\ApiUserBundle\Event;

use Symfony\Component\EventDispatcher\GenericEvent;

class ApiUserEvent extends GenericEvent
{
    const TYPE_ERROR    = 'error';
    const TYPE_WARNING  = 'warning';
    const TYPE_INFO     = 'info';
    const TYPE_SUCCESS  = 'success';

    public function stop($message, $type = self::TYPE_ERROR, $params = array())
    {
        $this->error = true;
        $this->messageType = $type;
        $this->message = $message;
        $this->messageParams = $params;
        $this->stopPropagation();
    }

    /**
     * Indicate if an error has been detected
     *
     * @var boolean
     */
    protected $error = false;

    /**
     * Message type
     *
     * @var string
     */
    protected $messageType = '';

    /**
     * Message
     *
     * @var string
     */
    protected $message = '';

    /**
     * Message parameters
     *
     * @var array
     */
    protected $messageParams = array();

    /**
     * Get error property
     *
     * @return boolean $error
     */
    public function isStopped()
    {
        return $this->error === true;
    }

    /**
     * Get messageType property
     *
     * @return string $messageType
     */
    public function getMessageType()
    {
        return $this->messageType;
    }

    /**
     * Get message property
     *
     * @return string $message
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Get messageParams property
     *
     * @return string $messageParams
     */
    public function getMessageParams()
    {
        return $this->messageParams;
    }
}