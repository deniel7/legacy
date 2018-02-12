<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Banner;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Banner $banner)
    {
        $data['banners'] = DB::table('banners')->get();

        
        return view('banner.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image1 = $request->file('image1');
        $image2 = $request->file('image2');
        $image3 = $request->file('image3');
        $image4 = $request->file('image4');
        $image5 = $request->file('image5');
        
        $img1 = $request->input('img1');
        $img2 = $request->input('img2');
        $img3 = $request->input('img3');
        $img4 = $request->input('img4');
        $img5 = $request->input('img5');

        if (!empty($image1)) {
            $image1 = $image1->getClientOriginalName();
            $destinationPath = public_path('/images/upload/banner');

            unlink($destinationPath.'/'.$img1);

            
            $proses = $request->file('image1')->move($destinationPath, $image1);
        } else {
            $image1 = $img1;
        }

        if (!empty($image2)) {
            $image2 = $image2->getClientOriginalName();
            $destinationPath = public_path('/images/upload/banner');

            unlink($destinationPath.'/'.$img2);

            $proses = $request->file('image2')->move($destinationPath, $image2);
        } else {
            $image2 = $img2;
        }

        if (!empty($image3)) {
            $image3 = $image3->getClientOriginalName();
            $destinationPath = public_path('/images/upload/banner');
            unlink($destinationPath.'/'.$img3);
            $proses = $request->file('image3')->move($destinationPath, $image3);
        } else {
            $image3 = $img3;
        }

        if (!empty($image4)) {
            $image4 = $image4->getClientOriginalName();
            $destinationPath = public_path('/images/upload/banner');
            unlink($destinationPath.'/'.$img4);
            $proses = $request->file('image4')->move($destinationPath, $image4);
        } else {
            $image4 = $img4;
        }

        if (!empty($image5)) {
            $image5 = $image5->getClientOriginalName();
            $destinationPath = public_path('/images/upload/banner');
            unlink($destinationPath.'/'.$img5);
            $proses = $request->file('image5')->move($destinationPath, $image5);
        } else {
            $image5 = $img5;
        }

        $banner = Banner::find(1);
        $banner->image1 = $image1;
        $banner->image2 = $image2;
        $banner->image3 = $image3;
        $banner->image4 = $image4;
        $banner->image5 = $image5;
        $banner->save();

        DB::commit();
        //Flash::success('Saved');

        return redirect('banners');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}
