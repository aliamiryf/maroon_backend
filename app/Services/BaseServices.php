<?php

namespace App\Services;

use App\traits\PreparePaginationData;
use App\traits\responseToJson;
use App\traits\validatorDate;

class BaseServices
{
    use responseToJson,validatorDate , PreparePaginationData;
}
