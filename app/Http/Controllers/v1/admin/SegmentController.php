<?php

namespace App\Http\Controllers\v1\admin;

use App\Http\Controllers\Controller;
use App\Services\v1\admin\segmentServices;

class segmentController extends Controller
{
    public function __construct(segmentServices $segmentServices)
    {
        $this->ServicesHandler = $segmentServices;
    }

    public function getListSegments()
    {
        return $this->ServicesHandler->getAllSegment();
    }
}
