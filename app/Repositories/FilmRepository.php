<?php

namespace App\Repositories;

use App\Models\Film;
use App\Traits\Upload;
use Illuminate\Http\UploadedFile;
use App\Contracts\FilmContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class FilmRepository
 *
 * @package \App\Repositories
 */
class FilmRepository extends BaseRepository implements FilmContract
{
    use Upload;

    /**
     * FilmRepository constructor.
     * @param Film $model
     */
    public function __construct(Film $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listFilms(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findFilmById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }

    }

    /**
     * @param array $params
     * @return Film|mixed
     */
    public function createFilm(array $params)
    {
        try {
            $collection = collect($params);

            $featured = $collection->has('featured') ? 1 : 0;
            $status = $collection->has('status') ? 1 : 0;

            $merge = $collection->merge(compact('status', 'featured'));

            $film = new Film($merge->all());

            $film->save();

            if ($collection->has('genres')) {
                $film->genres()->sync($params['genres']);
            }
            return $film;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateFilm(array $params)
    {
        $product = $this->findFilmById($params['film_id']);

        $collection = collect($params)->except('_token');

        $featured = $collection->has('featured') ? 1 : 0;
        $status = $collection->has('status') ? 1 : 0;

        $merge = $collection->merge(compact('status', 'featured'));

        $film->update($merge->all());

        if ($collection->has('genres')) {
            $film->genres()->sync($params['genres']);
        }

        return $film;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteFilm($id)
    {
        $film = $this->findFilmById($id);

        $film->delete();

        return $film;
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function findFilmBySlug($slug)
    {
        $film = Film::where('slug', $slug)->first();

        return $film;
    }
}
