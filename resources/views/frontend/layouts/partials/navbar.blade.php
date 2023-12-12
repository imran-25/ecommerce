<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{ url('/') }}">Eshop</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">


          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Categories
            </a>
            <ul class="dropdown-menu">
                @foreach ($categories as $category)
                    <li><a class="dropdown-item" href="{{ route('category.products', $category->slug) }}">{{ $category->name  ?? ''}}</a></li>
                @endforeach
            </ul>
          </li>

        </ul>
        <div class="d-flex">
            @auth
                <a class="nav-link text-white" href="{{ route('cart.index') }}">
                    Cart - ({{ auth()->user()->cartItems->count() }})
                </a>

                <a class="nav-link text-white" href="{{ auth()->user()->isCustomer() ? url('/dashboard') : url('/admin') }}">
                    Dashboard
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class=" d-flex align-items-center">
                      <i class="bi bi-box-arrow-right"></i>
                      <span>Sign Out</span>
                    </button>
                  </form>
            @else
                <a class="nav-link text-white" href="{{ url('/login') }}">
                    Login
                </a>-
                <a class="nav-link text-white" href="{{ url('/register') }}">
                    Register
                </a>
            @endauth

        </div>
      </div>
    </div>
  </nav>
