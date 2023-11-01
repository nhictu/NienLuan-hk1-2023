<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Register</title>

    <!-- Fontfaces CSS-->
    <link href="{{ asset('css/font-face.css')}}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/font-awesome-4.7/css/font-awesome.min.css')}}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/font-awesome-5/css/fontawesome-all.min.css')}}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{ asset('vendor/bootstrap-4.1/bootstrap.min.css')}}" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{ asset('vendor/animsition/animsition.min.css')}}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/wow/animate.css')}}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/css-hamburgers/hamburgers.min.css')}}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/slick/slick.css')}}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/select2/select2.min.css')}}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/perfect-scrollbar/perfect-scrollbar.css')}}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{ asset('css/theme.css')}}" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <p style="color:rgb(13, 143, 28); font-weight: bold; font-size:40px">ĐĂNG KÝ</p>
                            </a>
                        </div>
                        <div class="login-form">
                            <form action="{{ route('register-user') }}" method="POST">

                                @if(Session::has('success'))
                                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                                @endif

                                @if(Session::has('fail'))
                                    <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                                @endif
                            
                                @csrf


                                <div class="form-group">
                                    <label>Họ và tên <span style="color:red">*</span> </label>
                                    <input class="au-input au-input--full" type="text" name="fullname" placeholder="Họ tên">
                                    <span class="text-danger small">@error('fullname') {{ $message }} @enderror</span>
                                </div>
                                <div class="form-group">
                                    <label>Giới tính <span style="color:red">*</span> </label>
                                    <div class="form-check">
                                        <input type="radio"  class="form-check-input" name="gender" id="female" value="Nữ" checked>
                                        <label for="female" class="form-check-label">Nữ</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio"  class="form-check-input" name="gender" id="male" value="Nam">
                                        <label for="male" class="form-check-label">Nam</label>
                                    </div>
                                    <span class="text-danger small">@error('gender') {{ $message }} @enderror</span>
                                </div>

                                <div class="form-group">
                                    <label>Email <span style="color:red">*</span> </label>
                                    <input class="au-input au-input--full" type="email" name="email" placeholder="Email">
                                    <span class="text-danger small">@error('email') {{ $message }} @enderror</span>
                                </div>
                               
                                <div class="form-group">
                                    <label>Password <span style="color:red">*</span></label>
                                    <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
                                    <span class="text-danger small">@error('password') {{ $message }} @enderror</span>
                                </div>
                               
                                <div class="login-checkbox">
                                    <label>
                                        <input type="checkbox" name="aggree">Đồng ý với chính sách và điều khoản của chúng tôi
                                    </label>
                                </div>
                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">Đăng kí</button>
                                
                            </form>
                            <div class="register-link">
                                <p>
                                    Bạn đã có tài khoản?
                                    <a href="/">Đăng nhập</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="{{ asset('vendor/jquery-3.2.1.min.js')}}"></script>
    <!-- Bootstrap JS-->
    <script src="{{ asset('vendor/bootstrap-4.1/popper.min.js')}}"></script>
    <script src="{{ asset('vendor/bootstrap-4.1/bootstrap.min.js')}}"></script>
    <!-- Vendor JS       -->
    <script src="{{ asset('vendor/slick/slick.min.js')}}">
    </script>
    <script src="{{ asset('vendor/wow/wow.min.js')}}"></script>
    <script src="{{ asset('vendor/animsition/animsition.min.js')}}"></script>
    <script src="{{ asset('vendor/bootstrap-progressbar/bootstrap-progressbar.min.js')}}">
    </script>
    <script src="{{ asset('vendor/counter-up/jquery.waypoints.min.js')}}"></script>
    <script src="{{ asset('vendor/counter-up/jquery.counterup.min.js')}}">
    </script>
    <script src="{{ asset('vendor/circle-progress/circle-progress.min.js')}}"></script>
    <script src="{{ asset('vendor/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    <script src="{{ asset('vendor/chartjs/Chart.bundle.min.js')}}"></script>
    <script src="{{ asset('vendor/select2/select2.min.js')}}">
    </script>

    <!-- Main JS-->
    <script src="{{ asset('js/main.js')}}"></script>

</body>

</html>
<!-- end document-->