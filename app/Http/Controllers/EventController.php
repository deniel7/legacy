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
        ->join('users', 'users.id', '=', 'events.user_id')
        ->orderby('events.id');

        return Datatables::of($events)

        ->addColumn('action', function ($event) {

            $html = '<div class="text-center btn-group btn-group-justified">';
            if (in_array(122, session()->get('allowed_menus'))) {
                $html .= '<a href="events/'.$event->id.'/edit"><button type="button" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></button></a>';
            }
            if (in_array(123, session()->get('allowed_menus'))) {
                $html .= '<a href="event/'.$event->id.'"><button type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></a>';
            }
            $html .= '</div>';

            return $html;
        })

        ->make(true);
    }

    public function show($id)
    {
    }

    public function create()
    {
        $data['usernames'] = DB::table('users')
        ->select(['users.id','users.username'])
        ->get();

        return view('event.create', $data);
    }

    public function store(Request $request)
    {
        $a = $request->input('tanggal');
        $event = new Event();
        //$event->tanggal = $a->format('Y-m-d');
        $event->tanggal = Carbon::createFromFormat('m-d-Y', $a)->format('Y-m-d');
        $event->user_id = $request->input('username');
        $event->event = $request->input('event');
        $event->save();

        DB::commit();
        //Flash::success('Saved');

        return redirect('events');
        
    }

    public function edit($id)
    {
       // if (in_array(142, session()->get('allowed_menus'))) {
            //$e = Event::findOrFail($e->id);


           // $data['status_users'] = User::select('active')->groupBy('active')->get();


            //$data['events'] = Event::find($id);
            // $data['usernames'] = DB::table('users')
            // ->select(['users.id','users.username'])
            // ->get();

            

            //return view('karyawan/edit', compact('karyawan'), $data);
            $data['event'] = Event::find($id);
            $data['usernames'] = User::select('id', 'username')->orderBy('id')->get();

            return view('event.edit', $data);
        //} else {
            //
        //}
    }

    public function update(Event $event, Request $request, $id)
    {
        $a = $request->input('tanggal');
        $tanggal = Carbon::createFromFormat('d-m-Y', $a)->format('Y-m-d');
        $user_id = $request->input('username');
        $event = $request->input('event');


        Event::findOrFail($id)->update([
            'tanggal' => $tanggal,
            'user_id' => $user_id,
            'event' => $event
        ]);

        DB::commit();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $events = Event::findOrFail($id);
        $events->delete();
        return redirect()->back();
    }
}
