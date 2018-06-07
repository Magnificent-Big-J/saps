<?php

namespace App\Http\Controllers;
use App\Http\Requests\CirculationRequest;
use App\Circulation;
use Illuminate\Http\Request;
use App\Http\Resources\CirculationsResources;
use Illuminate\Support\Facades\Session;
class CirculationController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        //$this->middleware('admin');
    }
    public function index()
    {
        $circulation = Circulation::orderBy('created_at','DESC')->paginate(4);
        return CirculationsResources::collection($circulation);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('circulations.dashboard');
    }
    public function saveImage(Request $request,$id)
    {
        if($request->hasFile('image'))
        {
            $imagename = $request->file('image');
            $file = $imagename->getClientOriginalName();
            //$equest->image->storeAs('images',$imagename);
            $imagename->move("images/circulations/",$file);
            $entry = Circulation::find($id);
            $entry->image = $file;
            $entry->save();
            return 'Image uploaded';
        }

        return 'Something went wrong';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CirculationRequest $request)
    {


        $circulation = new Circulation();
        $circulation->vin_number = $request->vin_number;
        $circulation->number_plate = $request->number_plate;
        $circulation->engine_number = $request->engine_number;
        if($request->has('reportedDate'))
        {
            $circulation->reportedDate = $request->reportedDate;
        }
        $circulation->colour = $request->colour;
        $circulation->model = $request->model;
        $circulation->owner_name = $request->owner_name;
        $circulation->save();


        return $circulation;
        //return CirculationsResources::collection($circulation);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Circulation  $circulation
     * @return \Illuminate\Http\Response
     */
    public function show(Circulation $circulation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Circulation  $circulation
     * @return \Illuminate\Http\Response
     */
    public function edit(Circulation $circulation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Circulation  $circulation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Circulation $circulation)
    {

       $mycirc = Circulation::find($circulation->id);
        $mycirc->vin_number = $request->vin_number;
        $mycirc->number_plate = $request->number_plate;
        $mycirc->engine_number = $request->engine_number;
        $mycirc->reportedDate = $request->reportedDate;
        $mycirc->colour = $request->colour;
        $mycirc->model = $request->model;
        $mycirc->owner_name = $request->owner_name;
        $mycirc->save();
        Session::flash('success','Successfully updated');
        return $mycirc;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Circulation  $circulation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Circulation $circulation)
    {
        //
    }
}
