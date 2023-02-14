<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBoardRequest;
use App\Models\BulletinBoard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class BulletinBoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $ads = Bulletin_board::where('salesman', Auth::id())->get();
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
       return Inertia::render("Create", ["user_id" => Auth::id()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBoardRequest $request)
    {
        BulletinBoard::create($request->all());

        return redirect("/board");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bulletin_board  $bulletin_board
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
     * @param  \App\Models\Bulletin_board  $bulletin_board
     * @return \Illuminate\Http\Response
     */
    public function edit(Bulletin_board $board)
    {
        $ads = $board->toArray();
        return Inertia::render("Edit",["boards" => BulletinBoard::find($ads)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bulletin_board  $bulletin_board
     * @return \Illuminate\Http\Response
     */
    public function update(StoreBoardRequest $request, BulletinBoard $board)
    {
        $data = $request->all();
        $board->update($data);
        return to_route("/board");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bulletin_board  $bulletin_board
     * @return \Illuminate\Http\Response
     */
    public function destroy(BulletinBoard $board)
    {
        $board->delete();
        return redirect()->back();
    }
    public function myfunc(BulletinBoard $board)
    {
       return Inertia::render("Ribbon", ["boards" =>BulletinBoard::where('user_id', Auth::id())->get()]);
    }
}
