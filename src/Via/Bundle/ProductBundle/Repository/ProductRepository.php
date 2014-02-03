<?php
namespace Via\Bundle\ProductBundle\Repository;

use Via\Bundle\ResourceBundle\Model\EntityRepository;

class ProductRepository extends EntityRepository
{
    /**
     * {@inheritdoc}
     */
    protected function getAlias()
    {
        return 'product';
    }
}
