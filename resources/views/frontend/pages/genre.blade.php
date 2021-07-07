@extends('frontend.app')
@section('title', $genre->genre_type)
@section('content')
<section class="section-pagetop bg-dark">
    <div class="container clearfix">
        <h2 class="title-page">{{ $genre->genre_type }}</h2>
    </div>
</section>
<section class="section-content bg padding-y">
    <div class="container">
        <div id="code_prod_complex">
            <div class="row">
                @forelse($genre->films as $film)
                    <div class="col-md-4">
                        <figure class="card card-product">
                            @if ($film->images->count() > 0)
                                <div class="img-wrap padding-y"><img src="{{ asset('storage/'.$film->images->first()->full) }}" alt=""></div>
                            @else
                                <div class="img-wrap padding-y"><img src="https://via.placeholder.com/176" alt=""></div>
                            @endif
                            <figcaption class="info-wrap">
                                <h4 class="title"><a href="{{ route('film.show', $film->name) }}">{{ $film->name }}</a></h4>
                            </figcaption>
                            <div class="bottom-wrap">
                                <a href="" class="btn btn-sm btn-success float-right"><i class="fa fa-cart-arrow-down"></i> Buy Now</a>
                                @if ($product->sale_price != 0)
                                    <div class="price-wrap h5">
                                        <span class="price"> {{ config('settings.currency_symbol').$product->sale_price }} </span>
                                        <del class="price-old"> {{ config('settings.currency_symbol').$product->price }}</del>
                                    </div>
                                @else
                                    <div class="price-wrap h5">
                                        <span class="price"> {{ config('settings.currency_symbol').$product->price }} </span>
                                    </div>
                                @endif
                            </div>
                        </figure>
                    </div>
                @empty
                    <p>No Products found in {{ $category->name }}.</p>
                @endforelse
            </div>
        </div>
    </div>
</section>
@stop