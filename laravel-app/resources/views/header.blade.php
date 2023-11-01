<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <link href="{{ asset('storage/icon/g4.png') }}" rel="icon">
    <title>Quản lý cửa hàng nhỏ lẻ</title>
    <!-- Fontfaces CSS-->
    <link href="{{ asset('css/font-face.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{ asset('vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{ asset('vendor/animsition/animsition.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet"
        media="all">
    <link href="{{ asset('vendor/wow/animate.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/slick/slick.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{ asset('css/theme.css') }}" rel="stylesheet" media="all">
    {{-- <script type="text/javascript" src="{{ asset('js/code.jquery.com_jquery-3.7.0.min.js') }}"> --}}
</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.html">
                            <img src="{{ asset('storage/icon/logo1.jpg') }}" alt="store" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li class="active has-sub">
                            <a href="{{ URL::to('/phieu-ban-hang') }}">
                                <i class="fas fa-copy"></i> Quản lí bán hàng </a>
                        </li>
                        <li>
                            <a href="{{ URL::to('/products') }}">
                                <i class="fas fa-chart-bar"></i>Quản lí sản phẩm</a>
                        </li>
                        <li>
                            <a href="{{ URL::to('/suppliers') }}">
                                <i class="fas fa-table"></i>Quản lí nhà cung cấp</a>
                        </li>
                        <li>
                            <a href="{{ URL::to('/phieu-nhap-hang') }}">
                                <i class="fas fa-copy"></i>Quản lí nhập hàng</a>
                        </li>
                        <li>
                            <a class="js-arrow" href="#">
                                <i class="fas fa-calendar-alt"></i>Quản lí báo cáo</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="{{ URL::to('/salereport') }}">
                                        Báo cáo bán hàng</a>
                                </li>
                                <li>
                                    <a href="{{ URL::to('/rp_inventory') }}">
                                        Báo cáo hàng tồn</a>
                                </li>

                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->
        @include('sidebar')
        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" action="" method="">
                                <input class="au-input au-input--xl" type="hidden" name="search"
                                    placeholder="Search for datas &amp; reports..." />

                            </form>
                            <div class="header-button">
                                
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            <img src="{{ asset('storage/icon/icon.png') }}" alt="admin" />
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#">{{ session('LoginName') }}</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">

                                            <div class="account-dropdown__item">
                                                <a href="/logout">
                                                    <i class="zmdi zmdi-power"></i>Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- HEADER DESKTOP-->
            <!-- MAIN CONTENT-->
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
            {{-- </div>

    </div> --}}
