<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\NewsletterHeader;
use App\NewsletterDetail;
use App\User;
use Datatables;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function datatable()
    {
        $users = DB::table('newsletter_headers')
            ->select(['id', 'title', 'image', 'date', 'short_desc']);


        return Datatables::of($users)


            ->addColumn('action', function ($user) {

                $html = '<div class="text-center btn-group btn-group-justified">';

                if (in_array(122, session()->get('allowed_menus'))) {
                    $html .= '<a href="news-letter/' . $user->id . '/edit"><button type="button" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></button></a>';
                }

                if (in_array(123, session()->get('allowed_menus'))) {
                    $html .= '<a href="javascript:;" onclick="coupleModule.confirmDelete(event, \'' . $user->id . '\');"><button type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></a>';
                }

                $html .= '</div>';

                return $html;
            })

            ->make(true);
    }

    public function index()
    {
        if (in_array(120, session()->get('allowed_menus'))) {
            return view('newsletter.index');
        } else {
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['usernames'] = User::select('*')->get();
        return view('newsletter.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image = $request->file('image');

        if (!empty($image)) {
            $filename = $image->getClientOriginalName();
            $destinationPath = public_path('/images/upload/newsletter');
            $proses = $request->file('image')->move($destinationPath, $filename);
        } else {
            $filename = '';
        }

        $newsletter = new NewsletterHeader();
        $newsletter->title = $request->input('title');
        $newsletter->short_desc = $request->input('short_desc');
        $newsletter->date = $request->input('date');
        $newsletter->youtube = $request->input('youtube');
        $newsletter->stories = $request->input('stories');
        $newsletter->image = $filename;
        $newsletter->save();

        DB::commit();
        //Flash::success('Saved');

        return back();
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
        //if (in_array(142, session()->get('allowed_menus'))) {
        $data['newsletter'] = NewsletterHeader::find($id);

        //$data['status_users'] = User::select('active')->groupBy('active')->get();
        // dd($data);
        return view('newsletter.edit', $data);
        //} else {
        //
        //}
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NewsletterHeader $newsletter, Request $request, $id)
    {
        $image = $request->file('image');
        $old_image = $request->input('old_image');

        if (!empty($image)) {
            $filename = $image->getClientOriginalName();
            $destinationPath = public_path('images/upload/newsletter');

            if ($old_image) {
                unlink($destinationPath . '/' . $old_image);
            }

            $proses = $request->file('image')->move($destinationPath, $filename);
            $mr = $filename;
        } else {
            $mr = $old_image;
        }


        $newsletter = NewsletterHeader::find($id);

        $newsletter->title = $request->input('title');
        $newsletter->short_desc = $request->input('short_desc');
        $newsletter->date = $request->input('date');
        $newsletter->stories = $request->input('stories');
        $newsletter->image = $mr;
        $newsletter->youtube = $request->input('youtube');
        $newsletter->save();
        DB::commit();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('images/ckeditor'), $fileName);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('images/ckeditor/' . $fileName);
            $msg = 'Image uploaded successfully';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
    }
}
