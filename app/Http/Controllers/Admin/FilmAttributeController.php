<?php

namespace App\Http\Controllers\Admin;

use App\Models\Film;
use App\Models\Attribute;
use Illuminate\Http\Request;
use App\Models\FilmAttribute;
use App\Http\Controllers\Controller;

class FilmAttributeController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function loadAttributes()
    {
        $attributes = Attribute::all();

        return response()->json($attributes);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function filmAttributes(Request $request)
    {
        $film = Film::findOrFail($request->id);

        return response()->json($film->attributes);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function loadValues(Request $request)
    {
        $attribute = Attribute::findOrFail($request->id);

        return response()->json($attribute->values);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addAttribute(Request $request)
    {
        $filmAttribute = FilmAttribute::create($request->data);

        if ($filmAttribute) {
            return response()->json(['message' => 'Film attribute added successfully.']);
        } else {
            return response()->json(['message' => 'Something went wrong while submitting film attribute.']);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteAttribute(Request $request)
    {
        $filmAttribute = FilmAttribute::findOrFail($request->id);
        $filmAttribute->delete();

        return response()->json(['status' => 'success', 'message' => 'Film attribute deleted successfully.']);
    }
}
