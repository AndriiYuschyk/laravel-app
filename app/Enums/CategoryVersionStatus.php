<?php

namespace App\Enums;

enum CategoryVersionStatus: string
{
    case CREATED = 'created';
    case UPDATED = 'updated';
    case DUPLICATE = 'duplicate';
}
