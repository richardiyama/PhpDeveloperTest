<?php

namespace App\Http\Controllers\Admin;

use App\Traits\Upload;
use App\Models\FilmImage;
use Illuminate\Http\Request;
use App\Contracts\FilmContract;
use App\Http\Controllers\Controller;

class FilmImageController extends Controller
{
    use Upload;

    protected $filmRepository;

    public function __construct(FilmContract $filmRepository)
    {
        $this->filmRepository = $filmRepository;
    }

    public function upload(Request $request)
    {
        $film = $this->filmRepository->findFilmById($request->film_id);

        if ($request->has('image')) {

            $image = $this->uploadOne($request->image, 'films');

            $filmImage = new FilmImage([
                'full'      =>  $image,
            ]);

            $film->images()->save($filmImage);
        }

        return response()->json(['status' => 'Success']);
    }

    public function delete($id)
    {
        $image = FilmImage::findOrFail($id);

        if ($image->full != '') {
            $this->deleteOne($image->full);
        }
        $image->delete();

        return redirect()->back();
    }
}
