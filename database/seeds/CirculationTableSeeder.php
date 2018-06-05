<?php

use Illuminate\Database\Seeder;

class CirculationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $circulation = array(
            array('vin_number'=>'1FAHP25NX8W134012','engine_number'=>'N9TT-9G0A-B7FQ-RANC','model'=>'EVEREST','colour'=>'Light Blue','number_plate'=>'AD 59 GK GP','owner_name'=>'John Doe','reportedDate'=>\Carbon\Carbon::now()->subDays(1),'status'=>'YES'),
            array('vin_number'=>'1HGBH41JXMN109186','engine_number'=>'QK6A-JI6S-7ETR-0A6C','model'=>'LEXUS RX 350','colour'=>'Grey','number_plate'=>'BKL 596 GP','owner_name'=>'Tom Jerry'),
            array('vin_number'=>'3GNAL3EK3DS555487','engine_number'=>'XNSS-HSJW-3NGU-8XTJ','model'=>'VW PASSAT', 'colour'=>'Navy Blue','number_plate'=>'QL 67 LA GP','owner_name'=>'Mitchell White'),
            array('vin_number'=>'1G2HX5210VH244696','engine_number'=>'NHLE-L6MI-4GE4-ETEV','model'=> 'SUZUKI GRAND VITARA', 'colour'=>'Black','number_plate'=>'BF 96 KS GP','owner_name'=>'George Soros'),
            array('vin_number'=>'7J3ZZ56T783450003','engine_number'=>'SXFP-CHYK-ONI6-S89U','model'=>'TOYOTA FJ CRUISER – 4 x 4','colour'=>'Red','number_plate'=>'FK 02 PE GP','owner_name'=>'Kim Smith','reportedDate'=>\Carbon\Carbon::now()->subDays(12),'status'=>'YES'),
            array('vin_number'=>'3GNAL3EK6ES659022','engine_number'=>'6ETI-UIL2-9WAX-XHYO','model'=> 'PORSCHE PANAMERA S', 'colour'=>'ICE White','number_plate'=>'RT 12 WQ GP','owner_name'=>'Mike Jones'),
            array('vin_number'=>'2G1FB1E38E9272203','engine_number'=>'2E62-E3SR-33FI-XHV3','model'=>'SUBARU FORESTER 2.5X','colour'=>'Green','number_plate'=>'ES 87 CS GP','owner_name'=>'Fitz Grant','reportedDate'=>\Carbon\Carbon::now()->subDays(7),'status'=>'YES'),
            array('vin_number'=>'2HKRL1868YH556651','engine_number'=>'7EIQ-72IU-2YNV-3L4Y','model'=>'Nissan NP200','colour'=>'Red','number_plate'=>'RE 41 JK GP','owner_name'=>'Olivia Pope','reportedDate'=>\Carbon\Carbon::now()->subDays(4),'status'=>'YES'),
            array('vin_number'=>'4T4BF1FKXDR286641','engine_number'=>'UK9W-CL3F-MAGM-WQY9','model'=>'BMW X6','colour'=>'Light black','number_plate'=>'HC 58 TR GP','owner_name'=>'Randy Jackson'),
            array('vin_number'=>'1FUYDWEB21PH27150','engine_number'=>'44NR-FWKU-TKPH-575G','model'=>'MERCEDES BENZ GLC','colour'=>'Grey','number_plate'=>'IF 44 MN GP','owner_name'=>'Alex Reeds')

        );

        foreach ($circulation as $circ)
        {
            \App\Circulation::create($circ);
        }
    }
}
