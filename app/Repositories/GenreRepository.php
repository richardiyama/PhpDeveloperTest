<?php

namespace App\Repositories;

use App\Models\Genre;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\GenreContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class GenreRepository
 *
 * @package \App\Repositories
 */
class GenreRepository extends BaseRepository implements GenreContract
{
    use UploadAble;

    /**
     * Genre Repository constructor.
     * @param Category $model
     */
    public function __construct(Genre $model)
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
    public function listGenres(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findGenreById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }

    }

    /**
     * @param array $params
     * @return Genre|mixed
     */
    public function createGenre(array $params)
    {
        try {
            $collection = collect($params);

            $image = null;

            if ($collection->has('image') && ($params['image'] instanceof  UploadedFile)) {
                $image = $this->uploadOne($params['image'], 'genres');
            }

            $featured = $collection->has('featured') ? 1 : 0;
            $menu = $collection->has('menu') ? 1 : 0;

            $merge = $collection->merge(compact('menu', 'image', 'featured'));

            $genre = new Category($merge->all());

            $genre->save();

            return $genre;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateGenre(array $params)
    {
        $category = $this->findGenreById($params['id']);

        $collection = collect($params)->except('_token');

        if ($collection->has('image') && ($params['image'] instanceof  UploadedFile)) {

            if ($genre->image != null) {
                $this->deleteOne($category->image);
            }

            $image = $this->uploadOne($params['image'], 'genres');
        }

        $featured = $collection->has('featured') ? 1 : 0;
        $menu = $collection->has('menu') ? 1 : 0;

        $merge = $collection->merge(compact('menu', 'image', 'featured'));

        $genre->update($merge->all());

        return $genre;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteGenre($id)
    {
        $category = $this->findGenreById($id);

        if ($genre->image != null) {
            $this->deleteOne($genre->image);
        }

        $genre->delete();

        return $genre;
    }

    /**
     * @return mixed
     */
    public function treeList()
    {
        return Genre::orderByRaw('-name ASC')
            ->get()
            ->nest()
            ->setIndent('|–– ')
            ->listsFlattened('name');
    }

    public function findBySlug($slug)
    {
        return Genre::with('films')
            ->where('slug', $slug)
            ->where('menu', 1)
            ->first();
    }
}
