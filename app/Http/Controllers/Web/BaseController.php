<?php


namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;


class BaseController extends Controller
{

   
    public function __construct(Request $request)
    {
        $this->_view = 'pages.web.';
    }

}
