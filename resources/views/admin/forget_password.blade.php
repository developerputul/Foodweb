<!doctype html>
<html lang="en">

    <head>

        <meta charset="utf-8" />
        <title>Admin Forget Password</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('Backend/assets/images/favicon.ico')}}">

        <!-- preloader css -->
        <link rel="stylesheet" href="{{asset('Backend/assets/css/preloader.min.css')}}" type="text/css" />

        <!-- Bootstrap Css -->
        <link href="{{asset('Backend/assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{asset('Backend/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{asset('Backend/assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />

    </head>

    <body>

    <!-- <body data-layout="horizontal"> -->
        <div class="auth-page">
            <div class="container-fluid p-0">
                <div class="row g-0">
                    <div class="col-lg-4 col-lg-4 col-md-4">
                        <div class="auth-full-page-content d-flex p-sm-5 p-4">
                            <div class="w-100">
                                <div class="d-flex flex-column h-100">
                                    <div class="mb-4 mb-md-5 text-center">
                                        <a href="index.html" class="d-block auth-logo">
                                            <img src="{{asset('Backend/assets/images/logo-sm.svg')}}')}}" alt="" height="28"> <span class="logo-txt">Minia</span>
                                        </a>
                                    </div>
                                    <div class="auth-content my-auto">
                                        <div class="text-center">
                                            <h5 class="mb-0">Forget Password!</h5>
                                           
                                        </div>

                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    @endif

                    @if (Session::has('error'))
                        <li>{{ Session::get('error') }}</li>
                    @endif

                    @if (Session::has('success'))
                        <li>{{ Session::get('success') }}</li>
                    @endif

                <form class="mt-4 pt-2" action="{{ route('admin.password_submit') }}" method="post">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email">
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">EMAIL PASSWORD RESET LINK</button>
                    </div>
                </form>

                                <div class="mt-4 pt-2 text-center">
                                    <div class="signin-other-title">
                                        <h5 class="font-size-14 mb-3 text-muted fw-medium">- Sign in with -</h5>
                                    </div>

                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item">
                                            <a href="javascript:void()"
                                                class="social-list-item bg-primary text-white border-primary">
                                                <i class="mdi mdi-facebook"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="javascript:void()"
                                                class="social-list-item bg-info text-white border-info">
                                                <i class="mdi mdi-twitter"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="javascript:void()"
                                                class="social-list-item bg-danger text-white border-danger">
                                                <i class="mdi mdi-google"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="mt-5 text-center">
                                    <p class="text-muted mb-0">Don't have an account ? <a href="auth-register.html"
                                            class="text-primary fw-semibold"> Signup now </a> </p>
                                </div>
                            </div>
                            <div class="mt-4 mt-md-5 text-center">
                                <p class="mb-0">© <script>document.write(new Date().getFullYear())</script> EasyLearning   . Crafted with <i class="mdi mdi-heart text-danger"></i> by Easy Learning</p>
                            </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end auth full page content -->
                                    </div>
                                    <!-- end col -->
                                
                                    <!-- end col -->
                                </div>
                                <!-- end row -->
                            </div>
                            <!-- end container fluid -->
                        </div>


        <!-- JAVASCRIPT -->
        <script src="{{asset('Backend/assets/libs/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('Backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('Backend/assets/libs/metismenu/metisMenu.min.js')}}"></script>
        <script src="{{asset('Backend/assets/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{asset('Backend/assets/libs/node-waves/waves.min.js')}}"></script>
        <script src="{{asset('Backend/assets/libs/feather-icons/feather.min.js')}}"></script>
        <!-- pace js -->
        <script src="{{asset('Backend/assets/libs/pace-js/pace.min.js')}}"></script>
        <!-- password addon init -->
        <script src="{{asset('Backend/assets/js/pages/pass-addon.init.js')}}"></script>

    </body>

</html>