<?php
namespace Via\Bundle\ApiBundle\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Via\Bundle\ApiUserBundle\Entity\User as ApiUser;
use Via\Bundle\ApiBundle\Event\ProductBatchEvent;

use Sonata\AdminBundle\Admin\BaseFieldDescription;

class ProductAdminController extends Controller
{
    public function batchAction()
    {
        $apiUserRepository = $this->get('via.api_user.repository.user');
        $user = $apiUserRepository->findOneBy(array('enabled' => '1'));
        
        #\Doctrine\Common\Util\Debug::dump($this->admin->getFormBuilder());
        
        if (!$user instanceof ApiUser)
        {
            $this->addFlash('sonata_flash_error', 'via.api_user.no_active_user_found');
            return new RedirectResponse($this->admin->generateUrl('list', array('filter' => $this->admin->getFilterParameters())));
        }
        
        return parent::batchAction();
    }
    
    public function batchActionSendToViaEbay ()
    {
//         $confirmation = $this->get('request')->get('confirmation', false);
//         if ($data = json_decode($this->get('request')->get('data'), true)) {
//             $action       = $data['action'];
//             $idx          = $data['idx'];
//             $allElements  = $data['all_elements'];
//             $this->get('request')->request->replace($data);
//         } else {
//             $this->get('request')->request->set('idx', $this->get('request')->get('idx', array()));
//             $this->get('request')->request->set('all_elements', $this->get('request')->get('all_elements', false));

//             $action       = $this->get('request')->get('action');
//             $idx          = $this->get('request')->get('idx');
//             $allElements  = $this->get('request')->get('all_elements');
//             $data         = $this->get('request')->request->all();

//             unset($data['_sonata_csrf_token']);
//         }
        
        $this->get('event_dispatcher')->dispatch('via.product.batch.confirmation', new ProductBatchEvent($this->get('request')));
        
        return new RedirectResponse($this->admin->generateUrl('list', array('filter' => $this->admin->getFilterParameters())));
        
        die(__METHOD__);
    }
}