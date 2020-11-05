<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Booking;
use App\Ticket;

use Illuminate\Http\Request;

class BookingsController extends Controller
{
    protected $user;

    public function store(Request $request)
    {
        $booking = new  Booking();
        $booking->user_id = $request->user_id;
        $booking->ticket_id = $request->ticket_id;
        DB::table('tickets')->where('id', '=', $request->ticket_id)->decrement('quantity', 1);
        $booking->save();
        
        return  response()->json([
            'status' => 'ok',
            'data' => $booking
        ], 200);
    }
}
