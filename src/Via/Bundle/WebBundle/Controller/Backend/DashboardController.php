<?php

/*
 * This file is part of the Via package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Via\Bundle\WebBundle\Controller\Backend;

#use Via\Bundle\OrderBundle\Model\OrderStates;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Backend dashboard controller.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class DashboardController extends Controller
{
    /**
     * Backend dashboard display action.
     */
    public function mainAction()
    {
        #$orderRepository = $this->get('via.repository.order');
        #$userRepository  = $this->get('via.repository.user');

        return $this->render('ViaWebBundle:Backend/Dashboard:main.html.twig', array(
            #'orders_count'        => $orderRepository->countBetweenDates(new \DateTime('1 month ago'), new \DateTime()),
            #'orders'              => $orderRepository->findBy(array(), array('updatedAt' => 'desc'), 5),
            #'users'               => $userRepository->findBy(array(), array('id' => 'desc'), 5),
            #'registrations_count' => $userRepository->countBetweenDates(new \DateTime('1 month ago'), new \DateTime()),
            #'sales'               => $orderRepository->revenueBetweenDates(new \DateTime('1 month ago'), new \DateTime()),
            #'sales_confirmed'     => $orderRepository->revenueBetweenDates(new \DateTime('1 month ago'), new \DateTime(), OrderStates::ORDER_CONFIRMED),
        ));
    }
}
