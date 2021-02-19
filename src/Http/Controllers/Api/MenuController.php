<?php

namespace TCG\Voyager\Http\Controllers\Api;

use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\Controller;

class MenuController extends Controller
{
    public function index()
    {
        return Voyager::model('Menu')->display('admin', '_json');
    }
}
