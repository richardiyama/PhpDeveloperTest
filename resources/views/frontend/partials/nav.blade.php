<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav"
                aria-controls="main_nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="main_nav">
            <ul class="navbar-nav">
                @foreach($genres as $gen)
                    @foreach($gen->items as $genre)
                        @if ($genre->items->count() > 0)
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="{{ route('genre.show', $genre->slug) }}" id="{{ $genre->slug }}"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ $genre->name }}</a>
                                <div class="dropdown-menu" aria-labelledby="{{ $genre->slug }}">
                                    @foreach($genre->items as $item)
                                        <a class="dropdown-item" href="{{ route('genre.show', $item->slug) }}">{{ $item->name }}</a>
                                    @endforeach
                                </div>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('genre.show', $genre->slug) }}">{{ $genre->name }}</a>
                            </li>
                        @endif
                    @endforeach
                @endforeach
            </ul>
        </div>
    </div>
</nav>
