<?php

namespace estar\rda\RdaBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class estarRdaBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
