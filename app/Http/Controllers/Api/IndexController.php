<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class IndexController extends BaseController {
    public function status() {
        $database_ok = DB::select('select true as ok;')[0]->ok;
        return response()->json([
            'database_ok' => $database_ok,
        ]);
    }
}
