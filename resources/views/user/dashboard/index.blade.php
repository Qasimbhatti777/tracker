@extends('user.layouts.master')
@section('content')

<main>
    <div class="container-fluid px-4">
      <h1 class="mt-4">myDashboard</h1>
      <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">{{ $user->first_name }}'s Dashboard</li>
      </ol>
      <div class="row">
        <div class="col-xl-3 col-md-6">
          <div class="card bg-primary opacity-75 text-white mb-4 py-4">
            {{-- <div class="text-center fw-bold">Active Trackers</div> --}}
            <?php
            if ($user->subscription->status == "active") {
                // Display content for active subscription
                echo '<div class="text-center fw-bold">Active Trackers</div>';
            } else {
                // Display content for inactive subscription
                echo '<div class="text-center fw-bold">InActive Trackers</div>';
            }
            ?>

            <div class="text-center fw-bold">{{ $count }}</div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6">
          <div class="card bg-success opacity-75 text-white mb-4 py-4">
            <div class="text-center fw-bold">
              Trackers Included in Subscription
            </div>
            <div class="text-center fw-bold">{{ $include_in_subscription }}</div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6">
          <div class="card bg-danger opacity-75 text-white mb-4 py-4">
            <div class="text-center fw-bold">
              Trackers over Subscription
            </div>
            <div class="text-center fw-bold">0</div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6">
          <div class="card bg-warning opacity-75 text-white mb-4 py-4">
            <div class="text-center fw-bold">
              Current Subscription Tier
            </div>
            <div class="text-center fw-bold">{{ $plan }}</div>
          </div>
        </div>
      </div>
      @if(session('message'))
      <div class="alert alert-danger">
          {{ session('message') }}
      </div>
        @endif
      <!-- add new Tracking start -->
      <div class="d-flex justify-content-start">
        <a
          href="{{ route('dashboard.addtracker') }}"
          class="btn btn-primary py-2 px-3 my-3 fs-6 opacity-75"
        >
          <i class="fa fa-plus" aria-hidden="true"></i>
          Add New Tracker
        </a>
      </div>

      <!-- table data  -->
      <div class="card mb-4">
        <div class="card-header">
          <i class="fas fa-table me-1"></i>
          myTrackers - Active
        </div>
        <div class="card-body">
          <table id="datatablesSimple">
            <thead>
              <tr>
                <th>Case Number</th>
                <th>Case Name</th>
                <th>Tracking</th>
                <th>Last Update</th>
                <th>Action</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Case Number</th>
                <th>Case Name</th>
                <th>Tracking</th>
                <th>Last Update</th>
                <th>Action</th>
              </tr>
            </tfoot>
            <tbody>
                @foreach ($trackers as $tracker)
                <tr>
                    <td>{{ $tracker->case_number }}</td>
                    <td>{{ $tracker->case_name }}</td>
                    <td>N/A</td>
                    <td>{{ $tracker->last_update }}</td>
                    <td>
                      <a href="{{ route('dashboard.remove_tracker', ['tracker' => $tracker->id]) }}">
                        <button class="btn btn-danger">Remove</button>
                      </a>
                    </td>
                  </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </main>
  <div class="modal fade" id="myModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title mx-auto text-danger">ATTENTION !</h4>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <p>
            You are currently Removing a Tracker which will count towards
            your monthly total number of trackers. using more trackers than
            included in your current plan will result in additional charges
            per tracker based on your subscription tier.
          </p>
          <p class="text-center fw-bold">Do you wish to proceed ?</p>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button
            type="button"
            class="rounded-1 btn btn-light"
            data-bs-dismiss="modal"
          >
            No
          </button>
          <button
            type="submit"
            class="rounded-1 btn btn-dark"
            id="submitFormButton"
            data-bs-dismiss="modal"
          >
            Yes
          </button>
        </div>
      </div>
    </div>
  </div>
    <script>
      document.addEventListener("DOMContentLoaded", function () {

    const submitFormButton = document.getElementById("submitFormButton");
    const form = document.querySelector("form");

    submitFormButton.addEventListener("click", function () {
      form.submit(); // Manually submit the form
    });
  });
  </script>
@endsection
