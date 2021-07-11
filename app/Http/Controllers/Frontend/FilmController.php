<?php

namespace App\Http\Controllers\Frontend;

use Cart;
use Illuminate\Http\Request;
use App\Contracts\FilmContract;
use App\Http\Controllers\Controller;
use App\Contracts\AttributeContract;

class FilmController extends Controller
{
    protected $filmRepository;

    protected $attributeRepository;

    public function __construct(FilmContract $filmRepository, AttributeContract $attributeRepository)
    {
        $this->filmRepository = $filmRepository;
        $this->attributeRepository = $attributeRepository;
    }

    public function show($slug)
    {
        $film = $this->filmRepository->findFilmBySlug($slug);
        $attributes = $this->attributeRepository->listAttributes();

        return view('frontend.pages.film', compact('film', 'attributes'));
    }

    public function addToCart(Request $request)
    {
        $product = $this->productRepository->findProductById($request->input('filmId'));
        $options = $request->except('_token', 'filmId', 'price', 'qty');

        Cart::add(uniqid(), $film->name, $request->input('price'), $request->input('qty'), $options);

        return redirect()->back()->with('message', 'Item added to cart successfully.');
    }
}
