<?php

namespace Via\Bundle\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ViaUserBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'SonataUserBundle';
    }
}
