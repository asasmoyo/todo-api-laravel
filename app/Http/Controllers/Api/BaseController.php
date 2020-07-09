<?php

namespace App\http\Controllers\Api;

use Illuminate\Routing\Controller;

class BaseController extends Controller {
    public function __construct() {
        $this->middleware(function ($request, $next) {
            if ($request->isJson()) {
                return $next($request);
            }
            return response('', 400);
        });
    }
}
