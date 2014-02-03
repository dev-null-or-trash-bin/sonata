<?php
namespace Via\Bundle\ProductBundle\Form\Type;

use Doctrine\Common\Persistence\ObjectRepository;
use Via\Bundle\ProductBundle\Form\DataTransformer\ProductToIdentifierTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Product to identifier type.
 *
 */
class ProductToIdentifierType extends AbstractType
{
    /**
     * Product manager.
     *
     * @var ObjectRepository
     */
    private $productRepository;

    /**
     * See ProductType description for information about data class.
     *
     * @param ObjectRepository $productRepository
     */
    public function __construct(ObjectRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addModelTransformer(new ProductToIdentifierTransformer($this->productRepository, $options['identifier']));
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setDefaults(array(
                'data_class' => null
            ))
            ->setRequired(array(
                'identifier'
            ))
            ->setAllowedTypes(array(
                'identifier' => array('string')
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'text';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'via_product_to_identifier';
    }
}
