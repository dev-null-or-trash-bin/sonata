<?php
namespace Via\Bundle\ApiUserBundle\Block;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;

use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\BlockBundle\Block\BaseBlockService;
use Sonata\BlockBundle\Block\BlockContextInterface;

class UserBlock extends BaseBlockService
{
    protected $container;
    
    public function setContainer($container)
    {
        $this->container = $container;
    }
    
    function setDefaultSettings(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'url'      => false,
            'title'    => 'via.api_user.block.title.user',
            'template' => 'ViaApiUserBundle:Block:block_user.html.twig',
        ));
    }


    public function validateBlock(ErrorElement $errorElement, BlockInterface $block)
    {
    }

    public function buildEditForm(FormMapper $formMapper, BlockInterface $block)
    {
    }

    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        // merge settings
        $settings = $blockContext->getSettings();
        
        $apiUserRepository = $this->container->get('via.api_user.repository.user');
        $user = $apiUserRepository->findOneBy(array('enabled' => '1'));

        return $this->renderResponse($blockContext->getTemplate(), array(
            'user'      => $user,
            'block'     => $blockContext->getBlock(),
            'settings'  => $settings
            ), $response);
    }
}