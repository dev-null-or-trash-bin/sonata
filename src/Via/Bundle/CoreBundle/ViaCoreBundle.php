<?php

namespace Via\Bundle\CoreBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ViaCoreBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        #return 'SonataUserBundle';
    }
}
