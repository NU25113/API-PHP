<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index() {
        return 'DateTime: ' . now() . config('app.name');
    }

    public function contact($email) {
        return 'TOT Email: ' . $email;
    }
}
