<?php

namespace App\Http\Controllers\Admin\Website;

use App\Http\Controllers\Controller;
use App\Models\Website;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Website::first();
        $count = Website::count();

        return view('admin.website.index', compact('data', 'count'));
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
        if ($request->hasFile('photo')){
            if ($request->file('photo')->isValid()){
                // $imagePath = $request->file('photo');
                // $imageName = $imagePath->getClientOriginalName();
                // $imageExt = $imagePath->getClientOriginalExtension();

                $time = Carbon::now()->timestamp;

                $path = $request->file('photo')->storeAs('website',  'logo-'.$time.'.png', 'public');

                $website = Website::updateOrCreate(
                ['id' => $request->data_id],
                [
                    'nama_website' => $request->nama_website,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'footer' => $request->footer,
                    'alamat' => $request->alamat,
                    'facebook' => $request->facebook,
                    'instagram' => $request->instagram,
                    'youtube' => $request->youtube,
                    'logo' => 'storage/' . $path,
                    'nama_singkat' => $request->nama_singkat,
                    'lokasi' => $request->lokasi,
                ]);
            }
        }
        else {
            if ($request->hasFile('photo2')){
                $time = Carbon::now()->timestamp;
                $path = $request->file('photo2')->storeAs('website',  'logo-'.$time.'.png', 'public');
                $website = Website::updateOrCreate(
                    ['id' => $request->data_id],
                    [
                        'nama_website' => $request->nama_website,
                        'email' => $request->email,
                        'phone' => $request->phone,
                        'footer' => $request->footer,
                        'alamat' => $request->alamat,
                        'facebook' => $request->facebook,
                        'instagram' => $request->instagram,
                        'youtube' => $request->youtube,
                        'nama_singkat' => $request->nama_singkat,
                        'lokasi' => $request->lokasi,
                        'logo2' => 'storage/' . $path,
                    ]);
            } else {
                $website = Website::updateOrCreate(
                    ['id' => $request->data_id],
                    [
                        'nama_website' => $request->nama_website,
                        'email' => $request->email,
                        'phone' => $request->phone,
                        'footer' => $request->footer,
                        'alamat' => $request->alamat,
                        'facebook' => $request->facebook,
                        'instagram' => $request->instagram,
                        'youtube' => $request->youtube,
                        'nama_singkat' => $request->nama_singkat,
                        'lokasi' => $request->lokasi,
                    ]);
            }
        }

        return response()->json($website->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Website::find($id);
        return view('admin.website.right', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $website = Website::find($id);
        return response()->json([
            'website' => $website,
            'link' => asset($website->logo)
        ]);
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
