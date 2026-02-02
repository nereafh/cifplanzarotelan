<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">
            <i class="bi bi-book-half"></i> Biblioteca App
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('libro*') ? 'active' : '' }}" href="/libro">
                        Libros
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('socio*') ? 'active' : '' }}" href="/socio">
                        Socios
                    </a>
                </li>

                </ul>

            <form class="d-flex" action="{{ request()->is('socio*') ? '/socio' : '/libro' }}" method="GET">
                <input class="form-control me-2" type="search" name="search" placeholder="Buscar..." value="{{ request('search') }}">
                <button class="btn btn-outline-success" type="submit">Buscar</button>
            </form>
        </div>
    </div>
</nav>