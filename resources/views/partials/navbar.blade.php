<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('product') ? 'active' : '' }}" href="{{ route('product') }}">Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('transaction') ? 'active' : '' }}" href="{{ route('transaction') }}">Transactions</a>
          </li>
        </ul>
        <div class="d-flex navbar-text">
            @auth
            <a class="nav-link" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>
            @else
            <a class="nav-link mx-2" href="{{ route('login') }}">Login</a> | 
            <a class="nav-link mx-2" href="{{ route('register') }}">Register</a>
            @endauth
        </div>
      </div>
    </div>
</nav>