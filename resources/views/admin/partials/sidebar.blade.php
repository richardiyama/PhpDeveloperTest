<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <ul class="app-menu">
        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.dashboard' ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                <i class="app-menu__icon fa fa-dashboard"></i>
                <span class="app-menu__label">Dashboard</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.orders.index' ? 'active' : '' }}" href="{{ route('admin.orders.index') }}">
                <i class="app-menu__icon fa fa-bar-chart"></i>
                <span class="app-menu__label">Orders</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.films.index' ? 'active' : '' }}" href="{{ route('admin.films.index') }}">
                <i class="app-menu__icon fa fa-shopping-bag"></i>
                <span class="app-menu__label">Films</span>
            </a>
        </li>
       
        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.genres.index' ? 'active' : '' }}" href="{{ route('admin.genres.index') }}">
                <i class="app-menu__icon fa fa-tags"></i>
                <span class="app-menu__label">Genres</span>
            </a>
        </li>
      
        
    </ul>
</aside>
