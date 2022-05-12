<?php

namespace App\Http\Controllers;

use App\traits\PreparePaginationData;
use App\traits\responseToJson;
use App\traits\validatorDate;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests , responseToJson , PreparePaginationData , validatorDate;

    public $ServicesHandler;
}
