<?php

namespace WEB\LoveLetterBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class WEBLoveLetterBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
