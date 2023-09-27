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
    <title>myCourtBot | Dashboard</title>
    <link
      href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css"
      rel="stylesheet"
    />
    <link href="{{ asset('build/assets/css/styles.css') }}" rel="stylesheet" />
    <link href="{{ asset('build/assets/css/addtracker.css') }}" rel="stylesheet" />
    <link href="{{ asset('build/assets/css/support.css') }}" rel="stylesheet" />
    <script
      src="https://use.fontawesome.com/releases/v6.3.0/js/all.js"
      crossorigin="anonymous"
    ></script>
  </head>
  <body class="sb-nav-fixed">
    <a
      href="{{ route('dashboard.index') }}"
      style="
        position: fixed;
        bottom: 50px;
        right: 20px;
        padding: 10px 20px;
        background-color: rgba(0, 0, 0, 0.5);
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.3);
        z-index: 10000;
        width: 150px;
      "
    >
      <img
        src="{{asset('build/assets/assets/img/dashboardlogo.png')}}"
        class="img-fluid w-100"
        alt=""
      />
    </a>
