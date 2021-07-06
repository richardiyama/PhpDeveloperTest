<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film;
use App\Models\Genre;

class FilmController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:ROLE_ADMIN');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $films = Film::all();
        return view('films.index',compact('films'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $genres = Genre::all();
        return view('films.create')->with([
            'genres'  => $genres
            
   
           ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'description' => 'reqiured',
            'genre_name' => 'required',
            'quantity' => 'required',
            'price' => 'required',
        ]);

        $film = new Film();




        $film->name = $request->get('name');
        $film->genre_id = $request->get('genre_name');
        $film->description = $request->get('description');
        $film->quantity = $request->get('name');
        $film->price = $request->get('price');

        $film->save();

        return redirect()->route('films.index')->with('success','Film created successfully.');
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
        return view('films.show',compact('film'));
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
        return view('films.edit', compact('film'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Film $film)
    {
        //
        $request->validate([
            'name' => 'required',
            'description' => 'reqiured',
            'genre_name' => 'required',
            'quantity' => 'required',
            'price' => 'required',
        ]);

        $film = Film::find($request->input('id'));




        $film->name = $request->get('name');
        $film->genre_id = $request->get('genre_name');
        $film->description = $request->get('description');
        $film->quantity = $request->get('name');
        $film->price = $request->get('price');






        $film->save();

        return redirect()->route('films.index')->with('success','Film updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Film $film)
    {
        //
        $film->delete();
        return redirect()->route('films.index')->with('success','film deleted successfully');
    }
}
