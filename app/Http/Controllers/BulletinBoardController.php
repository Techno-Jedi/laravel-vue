<?php
namespace App\Http\Controllers;
use File;
use App\Http\Requests\StoreBoardRequest;
use App\Models\BulletinBoard;
use Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class BulletinBoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render("Index", [
        "boards" => BulletinBoard::all(),
        "user_id" =>Auth::user()->name
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return Inertia::render("Create", [
        "user_id" => Auth::user()->name,
        "boards" => BulletinBoard::all(),
    ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBoardRequest $request)
    {
        if ($request->hasFile('image')) {
            $userId =  Auth::user()->name;
            $ads = new BulletinBoard();
            $ads->title = $request->input('title');
            $ads->description = $request->input('description');
            $ads->price = $request->input('price');
            $ads->user_id =  $userId;
            $file = $request->file('image');
            $upload_folder = 'public/board' ;
            $filename = $file->getClientOriginalName();
            Storage::putFileAs($upload_folder, $file, $filename);
            $imgName = substr($filename, 0);
            $ads->image = $imgName;
            $ads->save();
            }else{
                BulletinBoard::create($request->all());
            }
            return redirect("/board");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BulletinBoard  $board
     * @return \Illuminate\Http\Response
     */

    public function show(BulletinBoard $board)
    {
        $ads = $board->toArray();
       return Inertia::render("Show", ["board" =>BulletinBoard::where('user_id', Auth::id())->get()]);
    }
    /**`
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BulletinBoard  $board
     * @return \Illuminate\Http\Response
     */

    public function edit(BulletinBoard $board)
    {
        $ads = $board->toArray();
        return Inertia::render("Edit",["boards" => BulletinBoard::find($ads)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BulletinBoard  $board
     * @return \Illuminate\Http\Response
     */

    public function update(StoreBoardRequest $request, BulletinBoard $board)
    {
      if ($request->hasFile('image')) {
        $ads = $request->id;
        $file = $request->file('image');
        $upload_folder = 'public/board' ;
        $filename = $file->getClientOriginalName();
        Storage::putFileAs($upload_folder, $file, $filename);
        $imgName = substr($filename, 0);
        BulletinBoard::where(
        ['id' => $ads],
        )->update( ['image' => $imgName]);
    }
    BulletinBoard::updateOrInsert(
        ['id' => $request->id],
        [
            'title'       => $request->input('title'),
            'description' => $request->input('description'),
            'price'       => $request->input('price'),
        ]
    );

    return redirect('board');
}
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BulletinBoard  $board
     * @return \Illuminate\Http\Response
     */

    public function destroy(BulletinBoard $board)
    {
        $board->delete();
        return redirect()->back();
    }
    public function myAds(BulletinBoard $board)
    {
       return Inertia::render("Ribbon", ["boards" =>BulletinBoard::where('user_id', Auth::user()->name)->get()]);
    }
}
