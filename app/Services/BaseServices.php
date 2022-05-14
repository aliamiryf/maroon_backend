<?php

namespace App\Services;

use App\traits\PreparePaginationData;
use App\traits\responseToJson;
use App\traits\validatorData;

class BaseServices
{
    use responseToJson,validatorData , PreparePaginationData;
}
