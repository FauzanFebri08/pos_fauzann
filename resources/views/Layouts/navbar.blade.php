<nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top py-2 border-bottom">
  <div class="container">
    {{-- Brand / Logo --}}
    <a class="navbar-brand fw-bold text-primary d-flex align-items-center gap-2" href="{{ route('dashboard') }}">
      <i class="bi bi-box-seam-fill fs-4"></i>
      <span>POS App</span>
    </a>

    <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-3 gap-1">
        <li class="nav-item">
          <a class="nav-link fw-semibold px-3 rounded-3 {{ Request::is('dashboard*') ? 'active bg-primary text-white' : 'text-secondary' }}" href="{{ route('dashboard') }}">
            <i class="bi bi-speedometer2 me-1"></i> Dashboard
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link fw-semibold px-3 rounded-3 {{ Request::is('produk*') ? 'active bg-primary text-white' : 'text-secondary' }}" href="{{ route('produk.index') }}">
            <i class="bi bi-box-seam me-1"></i> Produk
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link fw-semibold px-3 rounded-3 {{ Request::is('penjualan*') ? 'active bg-primary text-white' : 'text-secondary' }}" href="{{ route('penjualan.index') }}">
            <i class="bi bi-cart-check me-1"></i> Penjualan
          </a>
        </li>

        @if (Auth::check() && (Auth::user()->role_id == 1 || (Auth::user()->role && Auth::user()->role->id == 1)))
          <li class="nav-item">
            <a class="nav-link fw-semibold px-3 rounded-3 {{ Request::is('admin/users*') ? 'active bg-primary text-white' : 'text-secondary' }}" href="{{ route('admin.users') }}">
              <i class="bi bi-people me-1"></i> Users
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('jenis*') ? 'active bg-primary text-white' : 'text-secondary' }} fw-semibold px-3 rounded-3" href="{{ route('jenis.index') }}">
              <i class="bi bi-tags me-1"></i> Jenis
            </a>
          </li>
        @endif
      </ul>

      {{-- Dropdown Profile & User Info --}}
      <div class="d-flex align-items-center gap-3 mt-3 mt-lg-0 pt-2 pt-lg-0 border-top border-lg-0">
        <div class="dropdown">
          {{-- Trigger Dropdown --}}
          <a href="#" class="d-flex align-items-center gap-2 text-decoration-none dropdown-toggle" id="dropdownProfile" data-bs-toggle="dropdown" aria-expanded="false">
            <div class="bg-primary-subtle text-primary fw-bold rounded-circle d-flex align-items-center justify-content-center overflow-hidden" style="width: 38px; height: 38px;">
              @if (Auth::user()->avatar)
                <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar" class="w-100 h-100 object-fit-cover">
              @else
                {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
              @endif
            </div>
            <div class="d-none d-sm-block text-start leading-tight me-1">
              <span class="d-block fw-bold text-dark small mb-0">{{ Auth::user()->name ?? 'User' }}</span>
              <span class="badge bg-secondary-subtle text-secondary border fs-7">
                {{ (Auth::user()->role_id == 1 || (Auth::user()->role && Auth::user()->role->id == 1)) ? 'Admin' : 'Kasir' }}
              </span>
            </div>
          </a>

          {{-- Menu Dropdown --}}
          <ul class="dropdown-menu dropdown-menu-end shadow-sm rounded-3 mt-2" aria-labelledby="dropdownProfile">
            <li>
              <a class="dropdown-item d-flex align-items-center gap-2 py-2 {{ Request::is('profile*') ? 'active' : '' }}" href="{{ route('profile.show') }}">
                <i class="bi bi-person fs-5 text-primary"></i>
                <span>Profil Saya</span>
              </a>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
              <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="dropdown-item d-flex align-items-center gap-2 py-2 text-danger fw-semibold">
                  <i class="bi bi-box-arrow-right fs-5"></i>
                  <span>Logout</span>
                </button>
              </form>
            </li>
          </ul>
        </div>
      </div>

    </div>
  </div>
</nav>