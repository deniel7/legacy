<?php

namespace app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use App\User;
use App\Project;
use App\StatusKaryawan;
use Datatables;
use Carbon\Carbon;
use PDF;
use Image;

class CoupleController extends Controller
{
    
    public function datatable()
    {
        $users = DB::table('projects')
        ->select(['projects.id','users.username', 'users.pengantin_pria', 'users.pengantin_wanita'])
        ->leftjoin('users', 'users.id', '=', 'projects.user_id')
        ;

        return Datatables::of($users)
       
       
        ->addColumn('action', function ($user) {

            $html = '<div class="text-center btn-group btn-group-justified">';

            if (in_array(122, session()->get('allowed_menus'))) {
                $html .= '<a href="couple/'.$user->id.'/edit"><button type="button" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></button></a>';
            }

            if (in_array(122, session()->get('allowed_menus'))) {
                $html .= '<a href="couple/image/'.$user->id.'"><button type="button" class="btn btn-sm btn-info"><i class="fa fa-picture-o"></i></button></a>';
            }

            if (in_array(122, session()->get('allowed_menus'))) {
                $html .= '<a href="/package_taken/'.$user->id.'"><button type="button" class="btn btn-sm btn-success"><i class="fa fa-list"></i></button></a>';
            }
            
            $html .= '</div>';

            return $html;
        })

        ->make(true);
    }

    public function index()
    {
        if (in_array(120, session()->get('allowed_menus'))) {
            return view('couple.index');
        } else {
        }
    }
    

    public function edit($id)
    {
        if (in_array(142, session()->get('allowed_menus'))) {
            $data['user'] = User::find($id);
            $data['status_users'] = User::select('active')->groupBy('active')->get();
        
            return view('couple.edit', $data);
        } else {
            //
        }
    }

    public function getPreviewImage($id)
    {

        //$data['id'] = Project::find($id)->first();

        $data['id'] = DB::table('projects')->where('id', '=', $id)->get();
                //dd($data);

        return view('couple.image', $data);
    }

    public function resizeImagePost(Request $request)
    {

        $this->validate($request, [

        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'image2' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'image3' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'image4' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'image5' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'image6' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'image7' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);


         $id = $request->input('id');
        // $image2 = $request->file('image2');


        $files =[];
        if ($request->file('image')) {
            $files[] = $request->file('image');
        }
        if ($request->file('image2')) {
            $files[] = $request->file('image2');
        }
        if ($request->file('image3')) {
            $files[] = $request->file('image3');
        }
        if ($request->file('image4')) {
            $files[] = $request->file('image4');
        }
        if ($request->file('imag5')) {
            $files[] = $request->file('image5');
        }
        if ($request->file('image6')) {
            $files[] = $request->file('image6');
        }
        if ($request->file('image7')) {
            $files[] = $request->file('image7');
        }

        $destinationPath = public_path('images/upload/thumbnail');

        foreach ($files as $file) {
            if (!empty($file)) {
                $filename=$file->getClientOriginalName();


                $img = Image::make($file->getRealPath());

                $img->resize(500, 500, function ($constraint) {

                    $constraint->aspectRatio();

                })->save($destinationPath.'/'.$filename);



                $destinationPath = public_path('/images/upload');

                $file->move($destinationPath, $filename);
            }
        }


        $imgUploadPath = '/images/upload';
        

        $obj = array(
                'project_id' => $id,
                'gbr1' => (count($files) > 0) ? $imgUploadPath . '/thumbnail/' . $files[0]->getClientOriginalName() : '',
                'gbr2' => (count($files) > 1) ? $imgUploadPath . '/' . $files[1]->getClientOriginalName() : '',
                'gbr3' => (count($files) > 2) ? $imgUploadPath . '/' . $files[2]->getClientOriginalName() : '',
                'gbr4' => (count($files) > 3) ? $imgUploadPath . '/' . $files[3]->getClientOriginalName() : '',
                'gbr5' => (count($files) > 4) ? $imgUploadPath . '/' . $files[4]->getClientOriginalName() : '',
                'gbr6' => (count($files) > 5) ? $imgUploadPath . '/' . $files[5]->getClientOriginalName() : '',
                'gbr7' => (count($files) > 6) ? $imgUploadPath . '/' . $files[6]->getClientOriginalName() : '',
            );
        DB::table('galleries')->insert($obj);


        return back()

        ->with('success', 'Image Upload successful');

        //->with('imageName', $filename);


    }

    public function getPack(Request $request)
    {
        $data['gambar1'] = 'gambar 1';
        return view('couple.pack', $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($karyawan_harian)
    {
        DB::beginTransaction();

        try {
            $karyawan_harian->delete();

            DB::commit();
            echo 'success';
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            echo 'Error ('.$e->errorInfo[1].'): '.$e->errorInfo[2].'.';
        }
    }

    public function create()
    {
        $data['usernames'] = User::select('*')->get();
        return view('couple.create', $data);
    }

    public function store(Request $request)
    {
        
        $project = new Project();
        $project->user_id = $request->input('username');
        $project->deskripsi = $request->input('deskripsi');
        $project->quotes = $request->input('quotes');
        $project->summary = $request->input('summary');
        $project->main_rundown = $request->input('main_rundown');
        $project->save();

        DB::commit();
        //Flash::success('Saved');

        return redirect('couple');
        
    }
}
