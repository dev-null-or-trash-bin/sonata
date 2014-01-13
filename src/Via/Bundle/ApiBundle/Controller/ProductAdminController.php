<?php
namespace Via\Bundle\ApiBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;

class ProductAdminController extends Controller
{
    public function batchActionSendToViaEbay ()
    {
        $confirmation = $this->get('request')->get('confirmation', false);
    if ($data = json_decode($this->get('request')->get('data'), true)) {
            $action       = $data['action'];
            $idx          = $data['idx'];
            $allElements  = $data['all_elements'];
            $this->get('request')->request->replace($data);
        } else {
            $this->get('request')->request->set('idx', $this->get('request')->get('idx', array()));
            $this->get('request')->request->set('all_elements', $this->get('request')->get('all_elements', false));

            $action       = $this->get('request')->get('action');
            $idx          = $this->get('request')->get('idx');
            $allElements  = $this->get('request')->get('all_elements');
            $data         = $this->get('request')->request->all();

            unset($data['_sonata_csrf_token']);
        }
        #\Doctrine\Common\Util\Debug::dump($data);
        die(__METHOD__);
    }
}