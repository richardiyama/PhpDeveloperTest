<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Contracts\BrandContract;
use App\Contracts\GenreContract;
use App\Contracts\FilmContract;
use App\Http\Controllers\BaseController;
use App\Http\Requests\StoreFilmFormRequest;

class FilmController extends BaseController
{
    protected $brandRepository;

    protected $genreRepository;

    protected $filmRepository;

    public function __construct(
        BrandContract $brandRepository,
        GenreContract $genreRepository,
        FilmContract $filmRepository
    )
    {
        $this->brandRepository = $brandRepository;
        $this->genreRepository = $genreRepository;
        $this->filmRepository = $filmRepository;
    }

    public function index()
    {
        $films = $this->filmRepository->listFilms();

        $this->setPageTitle('Films', 'Films List');
        return view('admin.films.index', compact('films'));
    }

    public function create()
    {
        $brands = $this->brandRepository->listBrands('name', 'asc');
        $genres = $this->genreRepository->listGenres('name', 'asc');

        $this->setPageTitle('Films', 'Create Film');
        return view('admin.films.create', compact('genres', 'brands'));
    }

    public function store(StoreFilmFormRequest $request)
    {
        $params = $request->except('_token');

        $film = $this->filmRepository->createFilm($params);

        if (!$film) {
            return $this->responseRedirectBack('Error occurred while creating film.', 'error', true, true);
        }
        return $this->responseRedirect('admin.films.index', 'Film added successfully' ,'success',false, false);
    }

    public function edit($id)
    {
        $film = $this->filmRepository->findFilmById($id);
        $brands = $this->brandRepository->listBrands('name', 'asc');
        $genres = $this->genreRepository->listGenres('name', 'asc');

        $this->setPageTitle('Films', 'Edit Film');
        return view('admin.films.edit', compact('genres', 'brands', 'film'));
    }

    public function update(StoreFilmFormRequest $request)
    {
        $params = $request->except('_token');

        $film = $this->filmRepository->updateFilm($params);

        if (!$film) {
            return $this->responseRedirectBack('Error occurred while updating film.', 'error', true, true);
        }
        return $this->responseRedirect('admin.films.index', 'Film updated successfully' ,'success',false, false);
    }
}
