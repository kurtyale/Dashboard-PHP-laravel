<!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-secondary navbar-dark">
        <a href="/dashboard" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary">Tech Passos</h3>
        </a>
         <div class="d-flex align-items-center ms-4 mb-4">

             @if (Auth::check())
                @php
                    $user = Auth::user();
                    $nome = $user->name;
                @endphp

                <a href="{{ route('profile.show') }}" class="nav-link " data-bs-toggle="dropdown">
                    <span class="text-primary d-none d-lg-inline-flex">{{ $nome }}</span>
                </a>
            @endif

        </div>
        <div class="navbar-nav w-100">
            <a href="/dashboard" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
            <a href="/tabela" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Relatórios</a>
        </div>
    </nav>
</div>
<!-- Sidebar End -->
