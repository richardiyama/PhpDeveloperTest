<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Contracts\GenreContract;
use App\Http\Controllers\BaseController;

/**
 * Class Genre Controller
 * @package App\Http\Controllers\Admin
 */
class GenreController extends BaseController
{
    /**
     * @var GenreContract
     */
    protected $genreRepository;

    /**
     * Genre Controller constructor.
     * @param GenreContract $genreRepository
     */
    public function __construct(GenreContract $genreRepository)
    {
        $this->genreRepository = $genreRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $genres = $this->genreRepository->genres();

        $this->setPageTitle('Genres', 'List of all genres');
        return view('admin.genres.index', compact('genres'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $genres = $this->genreRepository->treeList();

        $this->setPageTitle('Genres', 'Create Genre');
        return view('admin.genres.create', compact('genres'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      =>  'required|max:191',
            'parent_id' =>  'required|not_in:0',
            'image'     =>  'mimes:jpg,jpeg,png|max:1000'
        ]);

        $params = $request->except('_token');

        $genre = $this->genreRepository->createGenre($params);

        if (!$genre) {
            return $this->responseRedirectBack('Error occurred while creating genre.', 'error', true, true);
        }
        return $this->responseRedirect('admin.genres.index', 'Genre added successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $targetGenre = $this->genreRepository->findGenreById($id);
        $genres = $this->genreRepository->treeList();

        $this->setPageTitle('Genres', 'Edit Genre : '.$targetGenre->name);
        return view('admin.genres.edit', compact('genres', 'targetGenre'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'name'      =>  'required|max:191',
            'parent_id' =>  'required|not_in:0',
            'image'     =>  'mimes:jpg,jpeg,png|max:1000'
        ]);

        $params = $request->except('_token');

        $genre = $this->genreRepository->updateGenre($params);

        if (!$genre) {
            return $this->responseRedirectBack('Error occurred while updating genre.', 'error', true, true);
        }
        return $this->responseRedirectBack('Genre updated successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $genre = $this->genreRepository->deleteGenre($id);

        if (!$genre) {
            return $this->responseRedirectBack('Error occurred while deleting genre.', 'error', true, true);
        }
        return $this->responseRedirect('admin.genres.index', 'Genre deleted successfully' ,'success',false, false);
    }
}
