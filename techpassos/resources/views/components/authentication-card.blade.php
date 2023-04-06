<div class="container-fluid">
    <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
        <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
            <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">

                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>Tech Passos</h3>
                    @if (Route::has('login'))
                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                        @endif @if (Route::has('login'))
                            <a href="{{ route('login') }}" class="ml-4 text-sm text-gray-700 underline">Login</a>
                        @endif
                </div>
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
