<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav"
                aria-controls="main_nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="main_nav">
            <ul class="navbar-nav">
               
                    @foreach($genres as $genre)
                        @if ($genre->count() > 0)
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="{{ route('genre.show', $genre->id) }}" id="{{ $genre->id }}"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ $genre->genre_type }}</a>
                                <div class="dropdown-menu" aria-labelledby="{{ $genre->genre_type }}">
                                    @foreach($genres as $genre)
                                        <a class="dropdown-item" href="{{ route('genre.show', $genre->id) }}">{{ $genre->genre_type }}</a>
                                    @endforeach
                                </div>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('genre.show', $genre->id) }}">{{ $genre->genre_type }}</a>
                            </li>
                        @endif
                    @endforeach
                
            </ul>
        </div>
    </div>
</nav>
