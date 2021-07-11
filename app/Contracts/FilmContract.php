<?php

namespace App\Contracts;

/**
 * Interface FilmContract
 * @package App\Contracts
 */
interface FilmContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listFilms(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findFilmById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createFilm(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateFilm(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteFilm($id);

    /**
     * @param $slug
     * @return mixed
     */
    public function findFilmBySlug($slug);
}
