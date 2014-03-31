<?php

namespace GS\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class GSUserBundle extends Bundle
{
      public function getParent()
    {
	return 'FOSUserBundle';
    }
}
