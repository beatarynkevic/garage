<?php

namespace App\Http\Controllers;

use App\Models\Truck;
use Illuminate\Http\Request;
use App\Models\Mechanic;
use PDF;
use Validator;

class TruckController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $mechanics = Mechanic::all();

        if($request->mechanic_id) {
            $trucks = Truck::where('mechanic_id', $request->mechanic_id)->get();
            $filterBy = $request->mechanic_id;
        }
        else {
            $trucks = Truck::all();
        }
    
        //RUSIAVIMAS(KOLEKCIJA)
        if($request->sort && 'asc' == $request->sort){
            $trucks= $trucks->sortBy('maker');
            $sortBy = 'asc';
        }
        elseif ($request->sort && 'desc' == $request->sort) {
            $trucks = $trucks->sortByDesc('maker');
            $sortBy = 'desc';
        }

        return view('truck.index', [
            'trucks' => $trucks,
            'mechanics' => $mechanics,
            'filterBy' => $filterBy ?? 0,
            'sortBy' => $sortBy ?? 0
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mechanics = Mechanic::all();
       return view('truck.create', ['mechanics' => $mechanics]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'truck_maker' => ['required', 'min:3', 'max:64', 'alpha'],
            'truck_plate' => ['required', 'min:3', 'max:64', 'alpha_dash'],
            'truck_make_year' => ['required', 'size:4'],
        ],
        //  [
        //  'mechanic_name.min' => 'per trumpas vardas',
        //  'mechanic_surname.min' => 'per trumpas pavarde',
        //  'mechanic_name.required' => 'visi laukai turi buti uzpildyti',
        //  'mechanic_surname.required' => 'visi laukai turi buti uzpildyti',
        //  'mechanic_name.alpha' => 'naudokite tik raides',
        //  'mechanic_surname.alpha' => 'naudokite tik raides'
        //  ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $truck = new Truck;
        $truck->maker = $request->truck_maker;
        $truck->plate = $request->truck_plate;
        $truck->make_year = $request->truck_make_year;
        $truck->mechanic_notices = $request->truck_mechanic_notices;
        $truck->mechanic_id = $request->mechanic_id;
        $truck->save();
        return redirect()->route('truck.index')->with('success_message', 'Sekmingai įrašytas.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Truck  $truck
     * @return \Illuminate\Http\Response
     */
    public function show(Truck $truck)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Truck  $truck
     * @return \Illuminate\Http\Response
     */
    public function edit(Truck $truck)
    {
        $mechanics = Mechanic::all();
       return view('truck.edit', ['truck' => $truck, 'mechanics' => $mechanics]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Truck  $truck
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Truck $truck)
    {
        $validator = Validator::make($request->all(),
        [
            'truck_maker' => ['required', 'min:3', 'max:64', 'alpha'],
            'truck_plate' => ['required', 'min:3', 'max:64', 'alpha_dash'],
            'truck_make_year' => ['required', 'size:4'],
        ],
        //  [
        //  'mechanic_name.min' => 'per trumpas vardas',
        //  'mechanic_surname.min' => 'per trumpas pavarde',
        //  'mechanic_name.required' => 'visi laukai turi buti uzpildyti',
        //  'mechanic_surname.required' => 'visi laukai turi buti uzpildyti',
        //  'mechanic_name.alpha' => 'naudokite tik raides',
        //  'mechanic_surname.alpha' => 'naudokite tik raides'
        //  ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

       $truck->maker = $request->truck_maker;
        $truck->plate = $request->truck_plate;
        $truck->make_year = $request->truck_make_year;
        $truck->mechanic_notices = $request->truck_mechanic_notices;
        $truck->mechanic_id = $request->mechanic_id;
        $truck->save();
        return redirect()->route('truck.index')->with('success_message', 'Sėkmingai pakeistas.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Truck  $truck
     * @return \Illuminate\Http\Response
     */
    public function destroy(Truck $truck)
    {
        $truck->delete();
        return redirect()->route('truck.index')->with('success_message', 'Trinti negalima, nes turi knygų.');
    }

    public function pdf(Truck $truck)
    {
        $pdf = PDF::loadView('truck.pdf', ['truck' => $truck]); // standartinis view
        return $pdf->download('truck-id' . $truck->id . '.pdf'); // failo pavadinimas
    }
}
