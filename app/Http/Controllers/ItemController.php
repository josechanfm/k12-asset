<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;
use App\Models\Item;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Item::paginate(5);
        return response()->json($data);
        // return Inertia::render('Item/Item');
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
        Validator::make($request->all(), [
            'serial' => ["required"],
            'title_zh' => ['required'],
            'photos'=>['required']
        ])->validate();
        $data=[
            'data'=>$request->all()
        ];
        //Item::create($request->all());
        //return redirect()->back();
        return response()->json($request);
        //return back()->with('info','You added new items, follow next step!');

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

    public function checkin()
    {
        return Inertia::render('Item/Checkin');
    }

    public function saveFiles($files)
    {
        $uploadResult=[];
        $allowedfileExtension = ['pdf', 'jpg', 'png', 'docx'];
        foreach ($files as $file) {
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $check = in_array($extension, $allowedfileExtension);
            //dd($check);
            if ($check) {
                $items = Item::create($request->all());
                foreach ($request->photos as $photo) {
                    $filename = $photo->store('photos');
                    ItemDetail::create([
                        'item_id' => $items->id,
                        'filename' => $filename
                    ]);
                }
                $uploadResult.push(["file"=>$filename,"result"=>'success']);
            } else {
                $uploadResult.push(["file"=>$filename,"result"=>'fail']);
            }
        }
        return $uploadResult;
    }
}
