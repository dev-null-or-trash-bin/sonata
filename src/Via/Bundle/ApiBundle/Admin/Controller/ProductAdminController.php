<?php
namespace Via\Bundle\ApiBundle\Admin\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;

class ProductAdminController extends Controller
{
    public function batchActionSendToViaEbay ()
    {
        $confirmation = $this->get('request')->get('confirmation', false);
        
        \Doctrine\Common\Util\Debug::dump($this->get('request')->get('data'));
	}
}