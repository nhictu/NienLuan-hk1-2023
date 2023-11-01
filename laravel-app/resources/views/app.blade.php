{{-- Now add bootstrap 5 to Header  --}}
@include('header')

{{-- app.blade.php is master page,
index.blade.php is child page,
about.blade.php is child page. --}}
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            @include('alert')
            <div class="row">
                <div class="col-lg-12">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Now add bootstrap 5 to Footer  --}}
@include('footer')
@yield('script')
