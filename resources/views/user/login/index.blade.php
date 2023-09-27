<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>myCourtBot | Home</title>
    <link
      href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="{{ asset('build/assets/css/styles.css') }}" />
    <link href="{{ asset('build/assets/css/landingpage.css') }}" rel="stylesheet" />
    <script
      src="https://use.fontawesome.com/releases/v6.3.0/js/all.js"
      crossorigin="anonymous"
    ></script>
  </head>
  <body>
    <div class="landing_page_hero_section">
      <div class="bg_image">
        <div>
          <h1>The Best Application Trackers At Your Fingertips!</h1>
          <h2>Get Started Now!</h2>
          <a href="{{ url('/login') }}" class="login_button">LOGIN</a>
          <div
            class="d-flex flex-row align-items-center justify-content-center text-white"
          >
            <a href="{{ route('user_privacy') }}" class="text-white">
              Privacy Policy</a
            >
            <a href="{{ route('user_terms') }}" class="text-white">
              Terms & Conditions</a
            >
          </div>
        </div>
      </div>
    </div>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
      crossorigin="anonymous"
    ></script>
    <script src="js/scripts.js"></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"
      crossorigin="anonymous"
    ></script>
    <script src="{{ asset('build/assets/assets/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('build/assets/assets/demo/chart-bar-demo.js') }}"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
      crossorigin="anonymous"
    ></script>
    <script src="{{ asset('build/assets/js/scripts.js') }}"></script>
  </body>
</html>
