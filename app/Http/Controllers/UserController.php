<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Datatables;
use Flash;
use Auth;
use App\User;
use DB;

class UserController extends Controller
{
    
    public function datatable()
    {
        $users = DB::table('users')
        ->select(['*'])
        ;

        return Datatables::of($users)

        ->editColumn('id', '<span class="pull-right">{{ $id }}</span>')
        ->editColumn('username', '<span class="pull-right">{{ $username }}</span>')
       
       
        ->addColumn('action', function ($user) {

            $html = '<div class="text-center btn-group btn-group-justified">';

            if (in_array(122, session()->get('allowed_menus'))) {
                $html .= '<a href="users/'.$user->id.'/edit"><button type="button" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></button></a>';
            }
            
            $html .= '</div>';

            return $html;
        })

        ->make(true);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (in_array(140, session()->get('allowed_menus'))) {
            return view('user.index');
        } else {
            //
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (in_array(141, session()->get('allowed_menus'))) {
            return view('angkutan.add');
        } else {
            //
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $count = Angkutan::where('nama', $request->nama)->count();
        
        // check exist
        if ($count > 0) {
            Flash::error('Error: Angkutan dengan nama ' . $request->nama . ' sudah ada.');
            return redirect('/angkutan/create')->withInput();
        } else {
            try {
                $angkutan = new Angkutan;
                $angkutan->nama = $request->nama;
                $angkutan->created_by = Auth::check() ? Auth::user()->username : '';
                $angkutan->save();
                
                return redirect('/angkutan');
            } catch (\Illuminate\Database\QueryException $e) {
                Flash::error('Error (' . $e->errorInfo[1] . '): ' . $e->errorInfo[2] . '.');
                return redirect('/angkutan/create')->withInput();
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (in_array(142, session()->get('allowed_menus'))) {
            $data['user'] = User::find($id);
            $data['status_users'] = User::select('active')->groupBy('active')->get();
        
            return view('user.edit', $data);
        } else {
            //
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, Request $request, $id)
    {

        $user = User::find($id);

        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->pengantin_pria = $request->input('pengantin_pria');
        $user->pengantin_wanita = $request->input('pengantin_wanita');
        $user->active = $request->input('active');
        $user->save();
        DB::commit();

        return redirect('users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $angkutan = Angkutan::find($id);
        
        try {
            $angkutan->delete();
            echo 'success';
        } catch (\Illuminate\Database\QueryException $e) {
            echo 'Error (' . $e->errorInfo[1] . '): ' . $e->errorInfo[2] . '.';
        }
    }
}
