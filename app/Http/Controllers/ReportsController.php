<?php

namespace App\Http\Controllers;

use App\Circulation;
use App\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
class ReportsController extends Controller
{
    public function index()
    {
        //$posts = App\Post::has('comments')->get();
        //$reports = Circulation::has('reports')->paginate(10);
        $reports = DB::table('circulations')
                ->join('reports','reports.circulation_id','=','circulations.id')
                ->select('circulations.number_plate','circulations.vin_number','circulations.model','reports.status','reports.created_at','circulations.engine_number')
                ->get();


        return $reports;
    }
    public function test()
    {
       return Circulation::has('reports')->paginate(10);
    }
    public function create()
    {
        return view('circulations.reports');
    }
}
