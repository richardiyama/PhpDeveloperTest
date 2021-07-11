<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contracts\GenreContract;

class GenreController extends Controller
{
    protected $genreRepository;

    public function __construct(GenreContract $genreRepository)
    {
        $this->genreRepository = $genreRepository;
    }

    public function show($slug)
    {
        $genre = $this->genreRepository->findBySlug($slug);

        return view('frontend.pages.genre', compact('genre'));
    }
}
