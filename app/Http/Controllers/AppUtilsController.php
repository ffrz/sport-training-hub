<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class AppUtilsController extends Controller
{
    public function run()
    {
        if (!env('APP_CMD_ALLOWED')) {
            abort(403, 'Acces denied!');
        }

        dd('SUCCESS');
    }
}
