<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class Controller extends BaseController
{
   use AuthorizesRequests, ValidatesRequests;

    protected $_route;
    protected $_directRoute;
    protected $_view = 'pages.';
    protected $_directView;

    private $_breadcrumb;

    public function __construct(Request $request)
    {
       
        $this->middleware(function ($request, $next) {

            return $next($request);
        });
    }

   
    protected function addBaseRoute($path)
    {
        $this->_route .= $path;
    }

    protected function getRoute($path)
    {
        return ('' != $path)? $this->_route . '.' . $path : $this->_route ;
    }

    protected function getDirectRoute($path)
    {
        return ('' != $path)? $this->_directRoute . '.' . $path : $this->_directRoute ;
    }

    protected function addBaseView($path)
    {
        $this->_view .= $path;
    }

    protected function getView($path)
    {
        return ('' != $path)? $this->_view . '.' . $path : $this->_view ;
    }

    protected function getDirectView($path)
    {
        return ('' != $path)? $this->_directView . '.' . $path : $this->_directView ;
    }

    /**
     * Render view
     * @param $view
     * @param $data
     * @param $title
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function renderView($view, $data, $title)
    {
        $data['title'] = $title;
        return view($view, $data);
    }
}
