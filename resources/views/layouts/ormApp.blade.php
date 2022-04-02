<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>OWRMS - Login</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="{{ asset('css/orm-style.css') }}" rel="stylesheet">

    @stack('styles')

    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>

</head>
<body>
    <div id="orm-app">
        <div class="container-fluid side-nav position-absolute">
            <div class="row">
                <div class="col-sm-auto h-100 sticky-top side-col" style="height:100%; background:#1268cd !important;">
                    <div class="d-flex flex-sm-column flex-row flex-nowrap align-items-between sticky-top">
                        <!-- <div class="d-flex flex-column flex-shrink-0 bg-light" style="width: 4.5rem;"> -->
                            <a href="/" class="orm-tooltip p-3 link-dark text-decoration-none d-flex justify-content-center align-items-center" style="height:50px;width:50px;border-radius:25px;background:#ffffff;padding:0px !important;">
                                <img src="{{ asset('images/logo2.png') }}" width="45px" alt="">
                                <span class="orm-tooltiptext">Company Stocks</span>
                            </a>
                            <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
                                <li class="nav-item orm-tooltip">
                                    <a href="#" class=" nav-link active py-3 border-bottom" aria-current="page">
                                        <em class="fa fa-home fs-3"></em>
                                    </a>
                                    <span class="orm-tooltiptext">Home</span>
                                </li>
                                <li>
                                    <a href="#" class="orm-tooltip nav-link py-3 border-bottom" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Dashboard">
                                        <em class="fa fa-archive fs-3"></em>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="orm-tooltip nav-link py-3 border-bottom" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Orders">
                                        <em class="fa fa-home fs-3"></em>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="orm-tooltip nav-link py-3 border-bottom" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Products">
                                        <em class="fa fa-home fs-3"></em>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="orm-tooltip nav-link py-3 border-bottom" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Customers">
                                        <em class="fa fa-home fs-3"></em>
                                    </a>
                                </li>
                            </ul>
                            <div class="dropdown border-top">
                                <a href="#" class="d-flex align-items-center justify-content-center p-3 link-dark text-decoration-none dropdown-toggle" id="dropdownUser3" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="https://github.com/mdo.png" alt="mdo" width="24" height="24" class="rounded-circle">
                                </a>
                                <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser3" style="">
                                    <li><a class="dropdown-item" href="#">New project...</a></li>
                                    <li><a class="dropdown-item" href="#">Settings</a></li>
                                    <li><a class="dropdown-item" href="#">Profile</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="#">Sign out</a></li>
                                </ul>
                            </div>
                        <!-- </div> -->
                    </div>
                </div>
            </div>
        </div>
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    
</body>
</html>
