<?php
namespace Via\Bundle\UserBundle\Block\Service;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\BlockBundle\Block\BaseBlockService;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\UserBundle\Menu\ProfileMenuBuilder;
use Sonata\UserBundle\Model\UserInterface;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Security\Core\SecurityContextInterface;

class AccountBlockService extends BaseBlockService
{
    /**
     * @var SecurityContextInterface
     */
    protected $container;
    
    /**
     * @var SecurityContextInterface
     */
    private $securityContext;
    
    /**
     * Constructor
     *
     * @param string                   $name
     * @param EngineInterface          $templating
     * @param SecurityContextInterface $securityContext
     */
    public function __construct($name, EngineInterface $templating, SecurityContextInterface $securityContext)
    {
        parent::__construct($name, $templating);
    
        $this->securityContext = $securityContext;
    }
    
    /**
     * {@inheritdoc}
     */
    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        $user = false;
        if ($this->securityContext->getToken()) {
            $user = $this->securityContext->getToken()->getUser();
        }
    
        if (!$user instanceof UserInterface) {
            $user = false;
        }
    
        return $this->renderPrivateResponse($blockContext->getTemplate(), array(
            'user'    => $user,
            'block'   => $blockContext->getBlock(),
            'context' => $blockContext,
            'settings'  => $blockContext->getSettings(),
        ));
    }
    
    public function setContainer($container)
    {
        $this->container = $container;
    }
    
    public function getName()
    {
        return 'Via User Block';
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultSettings(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'template' => 'ViaUserBundle:Block:account.html.twig',
            'ttl'      => 0,
            'title'      => $this->getName(),
        ));
    }

    public function validateBlock(ErrorElement $errorElement, BlockInterface $block)
    {
    }

    public function buildEditForm(FormMapper $formMapper, BlockInterface $block)
    {
    }

    
}