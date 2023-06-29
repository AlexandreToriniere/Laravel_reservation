<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\Prestation;
use App\Rules\DateBetween;
use App\Rules\TimeBetween;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationStoreRequest;

class FrontendReservationController extends Controller
{
    public function stepOne(Request $request)
    {
        $prestations = Prestation::all();
        $reservation = $request->session()->get('reservation');
        $min_date = Carbon::today();
        $max_date = Carbon::now()->addWeek();
        return view('reservation.step-one', compact('reservation', 'min_date', 'max_date','prestations'));
    }

    public function storeStepOne(Request $request)
    {
        $validated = $request->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email'],
            'res_date' => ['required', 'date', new DateBetween, new TimeBetween],
            'tel_number' => ['required'],
            'prestation_id'=>['required'],
        ]);

        if (empty($request->session()->get('reservation'))) {
            $reservation = new Reservation();
            $reservation->fill($validated);
            $request->session()->put('reservation', $reservation);
        } else {
            $reservation = $request->session()->get('reservation');
            $reservation->fill($validated);
            $request->session()->put('reservation', $reservation);
        }

        $reservation->save();
        $request->session()->forget('reservation');

        return to_route ('thankyou')->with('success', 'reservations Created successfully');
    }
    
  
}    
