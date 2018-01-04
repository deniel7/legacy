<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Event;
use App\User;
use Datatables;
use Carbon\Carbon;

class EventController extends Controller
{
    public function index()
    {
        if (in_array(120, session()->get('allowed_menus'))) {
            return view('event.index');
        } else {
        }
    }

    public function datatable()
    {
        $events = DB::table('events')
        ->select(['events.id','events.tanggal', 'users.username', 'events.event'])
        ->join('projects', 'projects.id', '=', 'events.project_id')
        ->join('users', 'users.id', '=', 'projects.user_id')
        ->orderby('events.id');

        return Datatables::of($events)

        ->addColumn('action', function ($event) {

            $html = '<div class="text-center btn-group btn-group-justified">';
            if (in_array(122, session()->get('allowed_menus'))) {
                $html .= '<a href="karyawan-tetap/'.$event->id.'/edit"><button type="button" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></button></a>';
            }
            if (in_array(123, session()->get('allowed_menus'))) {
                $html .= '<a href="javascript:;" onclick="karyawanHarianModule.confirmDelete(event, \''.$event->id.'\');"><button type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></a>';
            }
            $html .= '</div>';

            return $html;
        })

        ->make(true);
    }

    public function create()
    {
        $data['usernames'] = DB::table('users')
        ->select(['projects.id', 'users.username'])
        ->join('projects', 'projects.user_id', '=', 'users.id')
        ->get();

        return view('event.create', $data);
    }

    public function store(Request $request)
    {
        $a = $request->input('tanggal');
        $event = new Event();
        //$event->tanggal = $a->format('Y-m-d');
        $event->tanggal = Carbon::createFromFormat('d-m-Y', $a)->format('Y-m-d');
        $event->project_id = $request->input('username');
        $event->event = $request->input('event');
        $event->save();

        DB::commit();
        //Flash::success('Saved');

        return redirect('events');
        
    }
}
