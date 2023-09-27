@extends('user.layouts.master')
@section('content')
<main>
    <div class="container-fluid px-4">
      <h1 class="mt-4">Support</h1>
      <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">
          <a href="{{route('dashboard.index')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Contact Support</li>
      </ol>
      <div class="text-center fs-4 fw-bold text-uppercase">
        Reason for Support
      </div>
      <div class="row">
        <div class="row col-12 col-lg-10 col-xxl-8 mx-auto">
          <label
            for="radio-card-1"
            class="radio-card col-12 col-sm-6 col-md-3"
          >
            <input
              type="radio"
              name="radio-card"
              id="radio-card-1"
              checked
            />
            <div class="card-content-wrapper">
              <span class="check-icon"></span>
              <div class="card-content">
                <h4 class="fw-bold">Billing</h4>
              </div>
            </div>
          </label>
          <!-- /.radio-card -->

          <label
            for="radio-card-2"
            class="radio-card col-12 col-sm-6 col-md-3"
          >
            <input type="radio" name="radio-card" id="radio-card-2" />
            <div class="card-content-wrapper">
              <span class="check-icon"></span>
              <div class="card-content">
                <h4 class="fw-bold">Product Issue</h4>
              </div>
            </div>
          </label>
          <!-- /.radio-card -->
          <label
            for="radio-card-3"
            class="radio-card col-12 col-sm-6 col-md-3"
          >
            <input type="radio" name="radio-card" id="radio-card-3" />
            <div class="card-content-wrapper">
              <span class="check-icon"></span>
              <div class="card-content">
                <h4 class="fw-bold">Suggestion(s)</h4>
              </div>
            </div>
          </label>
          <!-- /.radio-card -->
          <label
            for="radio-card-4"
            class="radio-card col-12 col-sm-6 col-md-3"
          >
            <input type="radio" name="radio-card" id="radio-card-4" />
            <div class="card-content-wrapper">
              <span class="check-icon"></span>
              <div class="card-content">
                <h4 class="fw-bold">Other Issue</h4>
              </div>
            </div>
          </label>
          <!-- /.radio-card -->
        </div>
        <!-- /.grid-wrapper -->
      </div>
      <div class="row my-3 px-3">
        <div class="col-12 col-lg-10 col-xxl-8 mx-auto">
          <p class="fw-bold fs-6">Message:</p>
          <textarea
            class="form-control outline-none shadow-none border border-secondary"
            id="exampleFormControlTextarea1"
            rows="5"
            style="resize: none"
            placeholder="Message type here ..."
          ></textarea>
          <div class="text-center my-3">
            <button
              class="btn btn-primary outline-none shadow-none rounded-1 py-2 px-4"
            >
              Send Message
            </button>
          </div>
        </div>
      </div>
      <!-- /.container -->
    </div>
  </main>
@endsection
