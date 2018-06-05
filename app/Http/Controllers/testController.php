<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class testController extends Controller
{
    public function index()
    {
        return view('imageupload');
    }
    public function store(Request $request)
    {
        if($request->hasFile('image'))
        {
            $imagename = $request->file('image');
            $file = $imagename->getClientOriginalName();
            //$equest->image->storeAs('images',$imagename);
            $imagename->move("images/",$file);

        }

        return $request->name;

    }
    public function test()
    {
        return view('test');
    }
    public function saveImage(Request $request)
    {
        $this->validate($request,[
            'vin_number'=>'required',
            'engine_number'=>'required',
            'number_plate'=>'required',
            'license_disc_number_plate'=>'required',
            'model'=>'required',
            'image'=>'required'
        ]);

        return $request->file('image');
    }
}
