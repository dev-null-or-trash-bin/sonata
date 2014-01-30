<?php
namespace Via\Bundle\GuzzleBundle\Plugin\Blackbox;

use Guzzle\Common\Event;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Adds headers to request
 */
class HeaderPlugin implements EventSubscriberInterface {

    /**
     * @var array $headers
     */
    private $headers;

    /**
     * Constructor
     *
     * @param   array $headers
     */
    public function __construct(array $headers) {
        
        $this->setHeaders($headers);
    }

    /**
     * Retrieve headers that have been set
     *
     * @return  array $headers
     */
    public function getHeaders() {

        return $this->headers;
    }

    /**
     * Set headers
     *
     * @param   array $value
     * @return  void
     */
    public function setHeaders(array $value) {

        $this->headers = $value;
    }

    /**
     * Add header
     *
     * @param   string $key
     * @param   string $value
     *
     * @return  void
     */
    public function addHeader($key, $value) {

        $this->headers[$key] = $value;
    }
    
    /**
     * Get specified header
     *
     * @param   string $key
     * @return  string
     */
    public function getHeader($key) {

        if(isset($this->headers[$key])) {

            return $this->headers[$key];
        }

        return null;
    }

    /**
     * {@inheritdoc}
     *
     */
    public static function getSubscribedEvents() {

        return array('client.create_request' => 'onRequestCreate');
    }

    /**
     * Add given headers to request
     *
     * @param   Event $event
     *
     * @return  void
     */
    public function onRequestCreate(Event $event) {

        $request = $event['request'];
        
        // make sure to keep headers that have been already set
        foreach($this->headers as $key => $value) {

            $request->addHeader($key, $value);
        }
        #\Doctrine\Common\Util\Debug::dump($this->headers, 3);
    }
}