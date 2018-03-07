<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Package;
use DB;
use Datatables;
use Carbon\Carbon;
use Auth;

class PackageController extends Controller
{
    public function datatable()
    {
        $users = DB::table('packages')
        ->select(['*']);

        return Datatables::of($users)
       
       
        ->addColumn('action', function ($user) {

            $html = '<div class="text-center btn-group btn-group-justified">';

                 $html .= '<a href="packages/'.$user->id.'/edit"><button type="button" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></button></a>';
            
            $html .= '<a href="packages-del/'.$user->id.'"><button type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></a>';
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
        return view('package.index');
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('package.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $p = new Package();
        $p->nama = $request->input('name');
        
        $p->save();

        DB::commit();

        return redirect('packages');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user_id =  Auth::user()->get()->id;

        $data['packages'] = DB::select("select p.id, p.nama, pt.updated_at from package_takens pt 
        join packages p on pt.package_id = p.id
        join projects pr on pr.id = pt.project_id
        where pr.user_id =".$user_id."
        ");

        
        $data['package_takens'] = DB::select("select * from package_takens pt 
        join packages p on pt.package_id = p.id
        join projects pj on pt.project_id = pj.id
        join vendors v on pt.vendor_id = v.id
        where pt.package_id =".$id.
        " and pj.user_id=".$user_id);

        return view('package.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $data['packages'] = Package::find($id);
        

        return view('package.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Package $package, Request $request, $id)
    {
        $package = Package::find($id);

        $package->nama = $request->input('nama');
        $package->save();
        DB::commit();

        return redirect('packages');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $packages = Package::findOrFail($id);
        $packages->delete();
        return redirect()->back();
    }
}
