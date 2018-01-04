<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class ProjectController extends Controller
{
    //
    public function index()
    {
        $data['projects'] = DB::select("select p.id,u.pengantin_pria, u.pengantin_wanita, p.quotes, g.gbr1 from projects p 
        join users u on p.user_id = u.id
        join galleries g on p.id = g.project_id
        ");


        return view('projects.index', $data);
    }
}
