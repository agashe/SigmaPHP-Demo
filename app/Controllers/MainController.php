<?php

namespace App\Controllers;

use SigmaPHP\Core\Controllers\BaseController;
use SigmaPHP\Core\Http\Request;
use SigmaPHP\Core\Http\Response;

class MainController extends BaseController
{
    /**
     * Welcome page.
     * 
     * @return Response
     */
    public function index(Request $request)
    {
        return $this->render('app', ['version' => version()]);
    }
}