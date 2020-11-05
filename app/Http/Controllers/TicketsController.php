<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class TicketsController extends Controller
{
    protected $user;

    /*public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }*/
    public function index()
    {        
        $time =  date('Y-m-d H:i:s');
        $tick = DB::table('tickets')->where('quantity', '>', 0)->
        where('start_time', '<', $time)->
        where('finish_time', '>', $time)->get();
        return json_encode($tick);
    }
    
}
