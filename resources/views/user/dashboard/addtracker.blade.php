@extends('user.layouts.master')
@section('content')
<style>
.pulse-container {
    display: inline-block;
    position: relative;
}

.dot-pulse {
    position: relative;
    display: inline-block; /* Display the pulses inline */
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background-color: #212529;
    color: #212529;
    box-shadow: 0 0 0 -5px rgba(74, 67, 106, 0.2);
    animation: dot-pulse 1.5s infinite linear;
    margin: 0 5px; /* Adjust the margin for spacing */
}

@keyframes dot-pulse {
    0%, 100% {
        transform: scale(1);
        opacity: 0.2;
    }
    50% {
        transform: scale(1.5);
        opacity: 1;
    }
}
</style>
<main>
    <div class="container-fluid px-4">
      <h1 class="mt-4">Add Tracker</h1>
      <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">
          <a href="{{ route('dashboard.index') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Add Tracker</li>
      </ol>
      <div class="row">
          <div class="col-xl-3 col-md-6">

        </div>
        <div class="col-xl-3 col-md-6">
          <div class="card bg-primary opacity-75 text-white mb-4 py-4">
            <?php
            if ($user->subscription->status == "active") {
                // Display content for active subscription
                echo '<div class="text-center fw-bold">Active Trackers</div>';
            } else {
                // Display content for inactive subscription
                echo '<div class="text-center fw-bold">InActive Trackers</div>';
            }
            ?>
            <div class="text-center fw-bold">{{$count}}</div>
          </div>
        </div>

        {{-- <div class="col-xl-3 col-md-6">
          <div class="card bg-danger opacity-75 text-white mb-4 py-4">
            <div class="text-center fw-bold">
              Trackers Over Billing Plan
            </div>
            <div class="text-center fw-bold">-3</div>
          </div>
        </div> --}}
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success opacity-75 text-white mb-4 py-4">
              <div class="text-center fw-bold">Total Trackers</div>
              <div class="text-center fw-bold">{{$totalCount}}</div>
            </div>
          </div>
      </div>

    <div id="response_message">

    </div>

<div class="loader-button"></div>
      <div class="alert alert-secondary" role="alert">
        <b>Note: </b
        ><span
          >Each item tracked counts towards the total number of cases
          being tracked.</span
        >
      </div>
      <form >
      <div class="addTrackerForm mx-auto my-5">
        {{-- <div class="my-3 d-flex flex-column gap-1">
          <div class="fw-bold">State :</div>
          <select
            class="form-select outline-none shadow-none border border-dark rounded-1"
            aria-label="Default select example"
          >
            <option selected>Select</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>
        </div> --}}
        <div class="my-3 d-flex flex-column gap-1">
            <div class="fw-bold">State :</div>
            {{-- <select
              class="form-select outline-none shadow-none border border-dark rounded-1"
              aria-label="Default select example"
              id="stateSelect"
            > --}}
            <div>
                <select class="form-select outline-none shadow-none border border-dark rounded-1" aria-label="Default select example" id="California">
                  <option selected>Select State</option>
                  <option value="California">California</option>
                </select>
              </div>
              <div class="my-3 d-flex flex-column gap-1">
                <div class="fw-bold">County :</div>
                <select class="form-select outline-none shadow-none border border-dark rounded-1" aria-label="County select" id="County">
                  <option selected>Select County</option>
                </select>
              </div>

          </div>
        <div class="my-3 d-flex flex-column gap-1">
          <div class="fw-bold">COURT :</div>
          <select
            class="form-select outline-none shadow-none border border-dark rounded-1"
            aria-label="Default select example" id="courtSelect">
            <option selected>Select</option>
            <option value="Superior Court of California - Los Angeles">Superior Court of California - Los Angeles </option>
            {{-- <option value="Courts of Appeals">Courts of Appeals</option>
            <option value="District Courts">District Courts</option>
            <option value="Article I Courts">Article I Courts</option>
            <option value="">District Courts</option> --}}
          </select>
        </div>
        <div class="my-3 d-flex flex-column gap-1">
          <div class="fw-bold">Tracker Type # :</div>
          <select
            class="form-select outline-none shadow-none border border-dark rounded-1"
            aria-label="Default select example" id="trackerType"
          >
            <option selected>Select</option>
            <option value="Case Summary">Case Summary</option>
            <option value="Probate Notes">Probate Notes</option>
          </select>
        </div>
        <div class="my-3 d-flex flex-column gap-1">
            <div class="fw-bold">*CASE # :</div>
            <input type="text" name="case_number" id="case_number" placeholder="Case Number" class="form-control outline-none shadow-none border border-dark rounded-1">
        </div>
        <p style="color: gray; font-size: 14px; text-align: justify">
            *Please enter the case number exactly as you would into the
            court’s website, do not use the full case # used in the case
            unless you know it works properly on the courts website.
        </p>
        <div class="  text-center">
            {{-- <div
                class="btn btn-dark px-5 rounded-1"
                data-bs-toggle="modal"
                data-bs-target="#myModal"
                id="submitFormButton"
            >
                Add Tracker
            </div> --}}

            <?php
            if ($user->subscription->status == "active") {
                // Display content for active subscription
                echo '<div
                class="btn btn-dark px-5 rounded-1"
                data-bs-toggle="modal"
                data-bs-target="#myModal"
                id="submitFormButton"
            >
                Add Tracker
            </div>';
            } else {
                // Display content for inactive subscription
                echo '<button
                                class="btn btn-dark px-5 rounded-1"
                                disabled
                            >
                                Activate your subscription
                            </button>';
            }
            ?>
            <div class="pulse-container" style="display: none;">
                <div class="dot-pulse"></div>
                <div class="dot-pulse"></div>
                <div class="dot-pulse"></div>
            </div>
        </div>



      </div>

    </form>
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
                You are currently adding a new tracker which will count towards
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
                id="submitFormButton1"
                data-bs-dismiss="modal"
              >
                Yes
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  @endsection
  @push('script')
  <script>
    $(document).ready(function() {

        $('#submitFormButton1').click(function(event) {

            event.preventDefault();
            $('#submitFormButton').prop('disabled', true);
            $('.pulse-container').show();
            var case_number=$('#case_number').val();
            var state_Selected=$('#stateSelect').val();
            var county_Selected=$('#countySelect').val();
            var court_Selected=$('#courtSelect').val();
            var tracker_type_selected=$('#trackerType').val();

            $.ajax({
                type: 'GET',
                url: '{{ route('dashboard.save_tracker') }}',
                data: { case_number: case_number ,state_Selected:state_Selected,county_Selected:county_Selected,court_Selected:court_Selected,tracker_type_selected:tracker_type_selected},
                success: function(response) {
                    if (response.status === 200) {
                           // Redirect to another route
                         window.location.href = '{{ route('dashboard.index') }}';
                    } else if (response.status === 500) {

                        $('#response_message').addClass('alert alert-danger');
                        $('#response_message').text(response.message);

                            setTimeout(function() {
                            $('#response_message').removeClass('alert alert-danger');
                            $('#response_message').text('');
                        }, 3000); // 10000 milliseconds = 10 seconds
                            $('.pulse-container').hide();
                    }
                },
                error: function() {
                 $('.pulse-container').hide();
                    $('#responseMessage').text('An error occurred');
                }
            });
        });
    });

    // Fetch the JSON data from the provided URL
  fetch('https://gist.githubusercontent.com/mshafrir/2646763/raw/8b0dbb93521f5d6889502305335104218454c2bf/states_hash.json')
    .then(response => response.json())
    .then(data => {
      // Get a reference to the select element
      const stateSelect = document.getElementById('stateSelect');

      // Loop through the JSON data and create an option element for each state
      for (const stateCode in data) {
        const stateName = data[stateCode];
        const option = document.createElement('option');
        option.value = stateName;
        option.textContent = stateName;
        stateSelect.appendChild(option);
      }
    })
    .catch(error => {
      console.error('Error fetching data:', error);
    });


  // Fetch the JSON data with states and counties
  // Get references to the select elements
  const stateSelect = document.getElementById('stateSelect');
  const countySelect = document.getElementById('countySelect');

  // Fetch the JSON data with states and counties
  fetch('https://gist.githubusercontent.com/vitalii-z8i/bbb96d55d57f1e4342c3408e7286d3f2/raw/3b9b1fba8b226359d5a025221bb2688e9807c674/counties_list.json')
    .then(response => response.json())
    .then(data => {
      // Populate the state dropdown with options
      const states = [...new Set(data.map(item => item.State))]; // Extract unique states
      states.forEach(state => {
        const option = document.createElement('option');
        option.value = state;
        option.textContent = state;
        stateSelect.appendChild(option);
      });
//

      // Add an event listener to the state dropdown
      stateSelect.addEventListener('change', function() {
        const selectedState = this.value; // Get the selected state
        countySelect.innerHTML = '<option selected>Select</option>'; // Clear county dropdown

        // Populate the county dropdown based on the selected state
        const counties = data.filter(item => item.State === selectedState);
        if (counties.length === 0) {
          console.log(`No counties found for ${selectedState}`);
        } else {
          counties.forEach(county => {
            const option = document.createElement('option');
            option.value = county.County;
            option.textContent = county.County;
            countySelect.appendChild(option);
          });
        }
      });
    })
    .catch(error => {
      console.error('Error fetching data:', error);
    });

/////////////////////////////////////////////////////////////////// Just Show the Country Option List  static ///////////////

 // Define an object that maps states to their respective counties
 const countyData = {
    California: ["Los Angeles"],
    // Add more states and counties as needed
  };

  // Function to populate the County dropdown based on the selected state
  function populateCounties() {
    const selectedState = $("#California").val();
    const countyDropdown = $("#County");

    if (selectedState in countyData) {
      countyData[selectedState].forEach(county => {
        countyDropdown.append(`<option value="${county}">${county}</option>`);
      });
    }
  }
  // Event handler for the "Select State" dropdown change event
  $("#California").change(populateCounties);
  // Initial population of the County dropdown
  populateCounties();
    </script>
@endpush
