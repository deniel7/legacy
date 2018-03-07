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

            if (in_array(123, session()->get('allowed_menus'))) {
                $html .= '<a href="javascript:;" onclick="coupleModule.confirmDelete(event, \''.$user->id.'\');"><button type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></a>';
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

        'image1' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        'image2' => 'image|mimes:jpeg,png,jpg,gif,svg',
        'image3' => 'image|mimes:jpeg,png,jpg,gif,svg',
        'image4' => 'image|mimes:jpeg,png,jpg,gif,svg',
        'image5' => 'image|mimes:jpeg,png,jpg,gif,svg',
        'image6' => 'image|mimes:jpeg,png,jpg,gif,svg',
        'image7' => 'image|mimes:jpeg,png,jpg,gif,svg',
        'image8' => 'image|mimes:jpeg,png,jpg,gif,svg',
        'image9' => 'image|mimes:jpeg,png,jpg,gif,svg',
        

        ]);


         $id = $request->input('id');
        // $image2 = $request->file('image2');


        $files =[];
        if ($request->file('image1')) {
            $files[] = $request->file('image1');
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
        if ($request->file('image5')) {
            $files[] = $request->file('image5');
        }
        if ($request->file('image6')) {
            $files[] = $request->file('image6');
        }
        if ($request->file('image7')) {
            $files[] = $request->file('image7');
        }
        if ($request->file('image8')) {
            $files[] = $request->file('image8');
        }
        if ($request->file('image9')) {
            $files[] = $request->file('image9');
        }

        $destinationPath = public_path('images/upload/thumbnail');
        
        foreach ($files as $file) {
            // if (!empty($file)) {
                $filename=$file->getClientOriginalName();


                $img = Image::make($file->getRealPath());

                $img->resize(500, 500, function ($constraint) {

                    $constraint->aspectRatio();

                })->save($destinationPath.'/'.$filename);



                $destinationPath = public_path('/images/upload');

                $file->move($destinationPath, $filename);
            // }
        }


        $imgUploadPath = '/images/upload';
        

        $obj = array(
                'project_id' => $id,
                'gbr1' => (count($files) > 0) ? $files[0]->getClientOriginalName() : '',
                'gbr2' => (count($files) > 1) ? $files[1]->getClientOriginalName() : '',
                'gbr3' => (count($files) > 2) ? $files[2]->getClientOriginalName() : '',
                'gbr4' => (count($files) > 3) ? $files[3]->getClientOriginalName() : '',
                'gbr5' => (count($files) > 4) ? $files[4]->getClientOriginalName() : '',
                'gbr6' => (count($files) > 5) ? $files[5]->getClientOriginalName() : '',
                'gbr7' => (count($files) > 6) ? $files[6]->getClientOriginalName() : '',
                'gbr8' => (count($files) > 7) ? $files[7]->getClientOriginalName() : '',
                'gbr9' => (count($files) > 8) ? $files[8]->getClientOriginalName() : '',
                
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
    public function destroy($user)
    {
        DB::beginTransaction();

        try {
            $user->delete();

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
        $pdf = $request->file('pdf');

        if (!empty($pdf)) {
            $filename = $pdf->getClientOriginalName();
            $destinationPath = public_path('/images/upload/pdf');
            $proses = $request->file('pdf')->move($destinationPath, $filename);
        } else {
            $filename = '';
        }

        $project = new Project();
        $project->user_id = $request->input('username');
        $project->deskripsi = $request->input('deskripsi');
        $project->quotes = $request->input('quotes');
        $project->summary = $request->input('summary');
        $project->main_rundown = $filename;
        $project->save();

        DB::commit();
        //Flash::success('Saved');

        return redirect('couple');
        
    }

    public function edit($id)
    {
        if (in_array(142, session()->get('allowed_menus'))) {
            $data['projects'] = Project::find($id);

            //$data['status_users'] = User::select('active')->groupBy('active')->get();
        
            return view('couple.edit', $data);
        } else {
            //
        }
    }

    public function update(Project $project, Request $request, $id)
    {
        $pdf = $request->file('pdf');
        $old_pdf = $request->input('old_pdf');

        if (!empty($pdf)) {
            $filename = $pdf->getClientOriginalName();
            $destinationPath = public_path('/images/upload/pdf');

            if ($old_pdf) {
                unlink($destinationPath.'/'.$old_pdf);
            }
            
            $proses = $request->file('pdf')->move($destinationPath, $filename);
            $mr = $filename;
        } else {
            $mr = $old_pdf;
        }


        $project = Project::find($id);

        $project->deskripsi = $request->input('deskripsi');
        $project->quotes = $request->input('quotes');
        $project->summary = $request->input('summary');
        $project->main_rundown = $mr;
        $project->save();
        DB::commit();

        return redirect('couple');
    }
}
