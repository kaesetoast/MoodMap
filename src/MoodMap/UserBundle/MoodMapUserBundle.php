<?php

namespace MoodMap\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class MoodMapUserBundle extends Bundle {

    public function getParent() {
        return 'FOSUserBundle';
    }

}
