<?php

declare(strict_types=1);

namespace EnvLoader\Enums;

enum File : string
{
    case DEFAULTNAME = '.env';
    case DEFAULTCONFIGFILE = 'env';
}
