<?php

use Illuminate\Database\Seeder;

class EntriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $entries = array(
            array('vin_number'=>'1FAHP25NX8W134012','engine_number'=>'N9TT-9G0A-B7FQ-RANC','number_plate'=>'GA 66 GK GP','license_disc_number_plate'=>'AD 59 GK GP','model'=>'EVEREST','image'=>'AD59GK.jpg'),//change
            array('vin_number'=>'1HGBH41JXMN109186','engine_number'=>'QK6A-JI6S-7ETR-0A6C','number_plate'=>'BKL 659 NW','license_disc_number_plate'=>'BKL 596 GP','model'=>'LEXUS RX 350','image'=>'BKL596.jpg'), //change
            array('vin_number'=>'3GNAL3EK3DS555487','engine_number'=>'XNSS-HSJW-3NGU-8XTJ','number_plate'=>'QL 67 LA GP','license_disc_number_plate'=>'QL 67 LA GP','model'=>'VW PASSAT','image'=>'QL67LA.jpg'),//new
            array('vin_number'=>'1G2HX5210VH244696','engine_number'=>'NHLE-L6MI-4GE4-ETEV','number_plate'=>'BF 96 KS GP','license_disc_number_plate'=>'BF 96 KS GP','model'=> 'SUZUKI GRAND VITARA','image'=>'BF96KS.jpg'),//new
            array('vin_number'=>'3GNAL3EK6ES659022','engine_number'=>'6ETI-UIL2-9WAX-XHYO','number_plate'=>'RT 12 WQ GP','license_disc_number_plate'=>'RT 12 WQ GP','model'=> 'PORSCHE PANAMERA S','image'=>'RT12WQ.jpg'),//new
            array('vin_number'=>'2G1FB1E38E9272203','engine_number'=>'2E62-E3SR-33FI-XHV3','number_plate'=>'EST 187 GP','license_disc_number_plate'=>'ES 87 CS L','model'=>'SUBARU FORESTER 2.5X'),//change
            array('vin_number'=>'2HKRL1868YH556651','engine_number'=>'7EIQ-72IU-2YNV-3L4Y','number_plate'=>'REL 441 GP','license_disc_number_plate'=>'RE 41 JK GP','model'=>'Nissan NP200','image'=>'RE41JK.jpg'),//change
            array('vin_number'=>'7J3ZZ56T783450003','engine_number'=>'SXFP-CHYK-ONI6-S89U','number_plate'=>'SA 47 PE GP','license_disc_number_plate'=>'FK 02 PE GP','model'=>'TOYOTA FJ CRUISER – 4 x 4','image'=>'FK02PE.jpg'),//change
            array('vin_number'=>'4T4BF1FKXDR286641','engine_number'=>'UK9W-CL3F-MAGM-WQY9','number_plate'=>'HC 58 TR GP','license_disc_number_plate'=>'HC 58 TR GP','model'=>'BMW X6','image'=>'HC58TR.jpg'),//new
            array('vin_number'=>'1FUYDWEB21PH27150','engine_number'=>'44NR-FWKU-TKPH-575G','number_plate'=>'IF 44 MN GP','license_disc_number_plate'=>'IF 44 MN GP','model'=>'MERCEDES BENZ GLC','image'=>'IF44MN.jpg')//new

        );

        foreach ($entries as $entry)
        {
            \App\Entry::create($entry);
        }
    }
}
