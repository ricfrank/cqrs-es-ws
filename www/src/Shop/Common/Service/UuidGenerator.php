<?php

namespace Shop\Common\Service;

use Rhumsaa\Uuid\Uuid;

class UuidGenerator
{
    public function generate()
    {
        return Uuid::uuid4()->toString();
    }
}
