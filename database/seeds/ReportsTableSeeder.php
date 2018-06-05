<?php

use Illuminate\Database\Seeder;

class ReportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $entries = DB::table('entries')
            ->orderBy('id','ASC')
            ->limit(4)
            ->get();


        foreach ($entries as $entry)
        {
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
                    DB::table('circulations')
                        ->where('id', $circulations->id)
                        ->update(['reportedDate' => \Carbon\Carbon::now(),'status'=>"YES"]);
                }

            }

            DB::table('reports')->insert([
                'circulation_id'=> $circulations->id,
                'status'=>$message,
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now()
            ]);
        }



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
