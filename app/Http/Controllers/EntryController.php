<?php

namespace App\Http\Controllers;

use App\Entry;
use Illuminate\Http\Request;
use App\Http\Resources\EntriesResources;
use App\Http\Requests\EntryRequest;
use App\Circulation;
use App\Report;
use Illuminate\Support\Facades\DB;

class EntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entries = Entry::orderBy('id','DESC')->paginate(10);
        return EntriesResources::collection($entries);
    }
    public function saveImage(Request $request,$id)
    {
        if($request->hasFile('image'))
        {
            $imagename = $request->file('image');
            $file = $imagename->getClientOriginalName();
            //$equest->image->storeAs('images',$imagename);
            $imagename->move("images/entry/",$file);
            $entry = Entry::find($id);
            $entry->image = $file;
            $entry->save();
            return 'Image uploaded';
        }

        return 'Something went wrong';
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('circulations.entry');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EntryRequest $request)
    {

        $myentry = new Entry();
        $myentry->vin_number = $request->vin_number;
        $myentry->engine_number = $request->engine_number;
        $myentry->number_plate = $request->number_plate;
        $myentry->license_disc_number_plate = $request->license_disc_number_plate;
        $myentry->model = $request->model;
        $myentry->save();

        return $myentry;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function show(Entry $entry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function edit(Entry $entry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Entry $entry)
    {
        $myentry = Entry::find($entry->id);
        $myentry->vin_number = $request->vin_number;
        $myentry->engine_number = $request->engine_number;
        $myentry->number_plate = $request->number_plate;
        $myentry->license_disc_number_plate = $request->license_disc_number_plate;
        $myentry->model = $request->model;
        $myentry->save();

        return $myentry;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function destroy(Entry $entry)
    {
        //
    }
    public function validCheck($id)
    {
         $entry = Entry::find($id);
         $matched = "";
            $message = "";
            $engineMatched = false;
            $vinMatched = false;
            $plateMatched = false;
            $licenseMatched = true;


            $circulations = DB::table('circulations')
                ->where('vin_number','=',$entry->vin_number)
                ->first();

            //check if number plate and license disc number plate are the same
            if($this->clearspaces($entry->license_disc_number_plate) != $this->clearspaces($entry->number_plate))
            {
                $licenseMatched = false;

                $matched = "License disc number plate does not match with the car's number plate";
            }

            if($licenseMatched)
            {
                //Check for vin
                if($circulations->vin_number == $entry->vin_number)
                {
                    $vinMatched = true;

                }
                //Check engine
                if($this->clearDashes($circulations->engine_number) == $this->clearDashes($entry->engine_number))
                {
                    $engineMatched = true;

                }
                //check plate
                if($this->clearspaces($circulations->number_plate) == $this->clearspaces($entry->number_plate))
                {
                    $plateMatched = true;
                }

                if($vinMatched && $engineMatched && $plateMatched)
                {

                    if($this->reportedStolen($circulations->status))
                    {
                        $message = "Access Denied";
                    }
                    else{
                        $message = "Access Granted";
                    }
                }
                else
                {
                    if(!$vinMatched)
                    {
                        $error = "No record of the car in the circulations, please capture the information first";
                    }
                    else if(!$engineMatched && !$plateMatched)
                    {
                        if($this->reportedStolen($circulations->status))
                        {
                            $message = "Access Denied";
                        }
                        else{
                            $message = "Access Granted";
                        }
                    }
                    else if(!$engineMatched && $plateMatched)
                    {
                        if($this->reportedStolen($circulations->status))
                        {
                            $message = "Access Denied";
                        }
                        else{
                            $message = "Access Granted";
                        }
                    }
                    else if($engineMatched && !$plateMatched)
                    {
                        if($this->reportedStolen($circulations->status))
                        {
                            $message = "Access Denied";
                        }
                        else{
                            $message = "Access Granted";
                        }
                    }

                }
            }
            else
            {
                if($this->reportedStolen($circulations->status))
                {

                    $message = "Reported stole on " .$circulations->reportedDate ;
                }
                else
                {
                    $message = "Not reported ".$matched . ". The car will be reported stolen and immediately impounded";
                    $mycirc = Circulation::find($circulations->id);
                    $mycirc->reportedDate = \Carbon\Carbon::now();
                    $mycirc->status = "YES";
                    $mycirc->save();
                }

            }

            Report::create([
                'circulation_id'=> $circulations->id,
                'status'=>$message,
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now()
            ]);


            return $message;
    }
    protected function clearspaces($val)
    {

        return str_replace(" ","",$val);
    }

    protected function clearDashes($val)
    {
        return str_replace("-","",$val);
    }
    protected function reportedStolen($status)
    {
        switch ($status) {
            case 'YES':
                $isStolen= true;

                break;
            case 'NO':
                $isStolen = false;
                break;
        }

        return $isStolen;
    }

}
