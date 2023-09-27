<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>myCourtBot | Login</title>
    <link href="{{ asset('build/assets/css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('build/assets/css/login.css') }}" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container" style="height: 100vh; display: flex; align-items: center; justify-content: center;">
        <div>
            <div>
                <div class="card my-5">
                    <form class="card-body cardbody-color p-lg-5" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="text-center">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTgy-nLu_4sPKcCVPG6zqPtf6b0Auj4guKz8D4_Aj4oZVYAs6G9Va8Olr96-_5ZPT7Y-p0&usqp=CAU"
                            class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3"
                            width="200px"
                            alt="profile">
                        </div>

                        <div class="mb-3">
                            <input type="email" class="form-control outline-none shadow-none border border-dark rounded-1"
                                   id="email" name="email" aria-describedby="emailHelp" placeholder="Email Address">
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control outline-none shadow-none border border-dark rounded-1"
                                   id="password" name="password" placeholder="Password">
                        </div>

                        <div class="block mt-4">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                            </label>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            @if (Route::has('password.request'))
                                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary px-5 mb-5 w-100 rounded-1">{{ __('Log in') }}</button>
                        </div>
                        <div id="emailHelp" class="form-text text-center mb-5 text-dark">
                            Don't have an account?
                            <a href="{{ url('/register') }}" class="text-dark fw-bold">Create an Account</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('build/assets/js/scripts.js') }}"></script>
</body>
</html>
