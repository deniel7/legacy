<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Datatables;
use Carbon\Carbon;
use App\Package;
use App\Vendor;
use App\PackageTaken;

class PackageTakenController extends Controller
{
    public function datatable($id)
    {
        $pts = DB::table('package_takens')
        ->select(['package_takens.id','packages.nama', 'vendors.name','package_takens.created_at', 'package_takens.updated_at'])
        ->join('vendors', 'vendors.id', '=', 'package_takens.vendor_id')
        ->join('packages', 'packages.id', '=', 'package_takens.package_id')
        ->where('package_takens', '=', $id)
        ;

        return Datatables::of($pts)
       
       
        ->addColumn('action', function ($pt) {

            $html = '<div class="text-center btn-group btn-group-justified">';

            if (in_array(122, session()->get('allowed_menus'))) {
                $html .= '<a href="package-taken/'.$pt->id.'/edit"><button type="button" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></button></a>';
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
    public function getIndex($id)
    {

        $data['projects'] = DB::table('package_takens')
        ->select(['package_takens.id','packages.nama', 'vendors.name','package_takens.created_at', 'package_takens.updated_at'])
        ->join('vendors', 'vendors.id', '=', 'package_takens.vendor_id')
        ->join('packages', 'packages.id', '=', 'package_takens.package_id')
        ->where('package_takens.project_id', '=', $id)->get()
        ;
        $data['id'] = $id;
        // return Datatables::of($users)
       
       
        // ->addColumn('action', function ($user) {

        //     $html = '<div class="text-center btn-group btn-group-justified">';

        //     if (in_array(122, session()->get('allowed_menus'))) {
        //         $html .= '<a href="couple/'.$user->id.'/edit"><button type="button" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></button></a>';
        //     }

        //     $html .= '</div>';

        //     return $html;
        // })

        // ->make(true);

        return view('package_taken.list', $data);
        //return 'hello';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $data['packages'] = Package::select('id', 'nama')->orderBy('id')->get();
        $data['vendors'] = Vendor::select('id', 'name')->orderBy('id')->get();
        $data['id'] = $id;

        return view('package_taken.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pt = new PackageTaken();
        $pt->project_id = $request->input('id');
        $pt->package_id = $request->input('package_id');
        $pt->vendor_id = $request->input('vendor_id');
        $pt->keterangan = $request->input('keterangan');
        
        $pt->save();

        DB::commit();

        return redirect('couple');
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
    public function edit(PackageTaken $pt)
    {
        if (in_array(142, session()->get('allowed_menus'))) {
            // $data['pt'] = PackageTaken::find($id);
             $data['packages'] = Package::select('id', 'nama')->orderBy('id')->get();
             $data['vendors'] = Vendor::select('id', 'name')->orderBy('id')->get();
        
            return view('package_taken.edit', compact('pt'), $data);
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
    public function update(PackageTaken $pt, Request $request)
    {
        // $pt = new PackageTaken();

        $package_id = $request->input('package_id');
        $vendor_id = $request->input('vendor_id');
        $keterangan = $request->input('keterangan');
        
        // $pt->save();
        // DB::commit();

                PackageTaken::findOrFail($pt->id)->update([
                    'package_id' => $package_id,
                    'vendor_id' => $vendor_id,
                    'keterangan' => $keterangan
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
        $package_takens = PackageTaken::findOrFail($id);
        $package_takens->delete();
         return redirect()->back();
    }
}
