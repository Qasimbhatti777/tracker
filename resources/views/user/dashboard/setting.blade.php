@extends('user.layouts.master')
@section('content')
    <style>
        .modal {
            --bs-modal-width: 660px !important;
        }

        .modal-header button {
            background: lightgrey;
            border: 0;
            /* padding: 5px; */
            border-radius: 50%;
            width: 30px;
            height: 30px;
            margin: 0;
            padding: 0;
        }

        .card {
            margin-top: 14px;
            border: 0;
        }
    </style>
    <main>
        @php
            $intent = config('services.stripe.secret');
            $stripeSecretKey = config('services.stripe.primary');
        @endphp
        <div class="container-fluid px-4">
            <h1 class="mt-4">Setting</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard.index') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Settings</li>
            </ol>
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary opacity-75 text-white mb-4 py-4">
                        <?php
                        if ($authenticated_user->subscription->status == "active") {
                            // Display content for active subscription
                            echo '<div class="text-center fw-bold">Active Trackers</div>';
                        } else {
                            // Display content for inactive subscription
                            echo '<div class="text-center fw-bold">InActive Trackers</div>';
                        }
                        ?>
                        <div class="text-center fw-bold" id="trackerCount">{{ $activeTracker }}</div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success opacity-75 text-white mb-4 py-4">
                        <div class="text-center fw-bold">
                            Trackers Included in Subscription
                        </div>
                        <div class="text-center fw-bold" id="planValue">{{ $include_in_subscription }}</div>
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

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter">
                Cancel Subscription
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Cancel Subscription</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Add a heading for the cancellation message -->
                            <h5>Are you sure you want to cancel your subscription?</h5>
                            <!-- Additional content can be added here -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-danger" id="sub_cancel" data-dismiss="modal">Cancel
                                Subscription</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <!-- Button trigger modal renew subscription  -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenterRenew">
                Renew Subscription
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenterRenew" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Renew Subscription</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <form class="row" action="{{ route('dashboard.renew_subscription') }}" method="post"
                                id="payment-form">
                                @csrf

                                <div class="d-flex justify-content-around flex-wrap">
                                    <!-- Use justify-content-around for spacing -->

                                    <!-- Subscription Plan 1 -->

                                    <label for="radio-card-1"
                                        class="radio-card col-12 col-sm-6 col-md-4 col-lg-4 p-0 border-2">
                                        <div class="pe-2 ">
                                            <input type="radio" name="radio-card" id="radio-card-1" value="10"
                                                class="radio-card" <?php if ($plan === 'Small Practice' &&  $authenticated_user->subscription->status==
                                                "active") {
                                                    echo 'checked';
                                                } ?> />
                                            <div class="card-content-wrapper testing p-3 bg-light d-flex"
                                                style="height: 160px;">
                                                <!-- Set height to 200px -->
                                                <span class="check-icon"></span>
                                                <div class="card-content">
                                                    <h4 class="fw-bold subscription_plan_description">Small Practice</h4>
                                                    <input type="hidden" name="price_id_small"
                                                        value="price_1NfezTJ4aKs9ggmFYgHq0Mp5">
                                                    <p class="mb-0">$10/Month</p>
                                                    <p class="mb-0">Track 1-25 Cases</p>
                                                    <p class="mb-0">Extra Trackers = $0.35 per month</p>
                                                </div>
                                            </div>
                                        </div>

                                    </label>
                                    <label for="radio-card-2" class="radio-card col-12 col-sm-6 col-md-4 col-lg-4 p-0">
                                        <div class="pe-2">
                                            <input type="radio" name="radio-card" id="radio-card-2" value="18"
                                                <?php if ($plan === 'Mid-Size Practice' &&  $authenticated_user->subscription->status==
                                                "active") {
                                                    echo 'checked';
                                                } ?> />
                                            <div class="card-content-wrapper p-3 bg-light d-flex" style="height: 160px;">
                                                <!-- Set height to 200px -->
                                                <span class="check-icon"></span>
                                                <div class="card-content">
                                                    <h4 class="fw-bold subscription_plan_description">Mid-Size Practice
                                                    </h4>
                                                    <input type="hidden" name="price_id_mid"
                                                        value="price_1Nff0vJ4aKs9ggmFVaLRnbWI">
                                                    <p class="mb-0">$18/Month</p>
                                                    <p class="mb-0">Track 26-50 Cases</p>
                                                    <p class="mb-0">Extra Trackers = $0.30 per month</p>
                                                </div>
                                            </div>
                                        </div>
                                    </label>

                                    <label for="radio-card-3" class="radio-card col-12 col-sm-6 col-md-4 col-lg-4 p-0">
                                        <div class="pe-2">
                                            <input type="radio" name="radio-card" id="radio-card-3" value="25"
                                                <?php if ($plan === 'Large Practice' &&  $authenticated_user->subscription->status==
                                                "active") {
                                                    echo 'checked';
                                                } ?> />
                                            <div class="card-content-wrapper p-3 bg-light d-flex" style="height: 160px;">
                                                <!-- Set height to 200px -->
                                                <span class="check-icon"></span>
                                                <div class="card-content">
                                                    <h4 class="fw-bold subscription_plan_description">Large Practice</h4>
                                                    <input type="hidden" name="price_id_large"
                                                        value="price_1Nff25J4aKs9ggmF6ttW2ebQ">
                                                    <p class="mb-0">$25/Month</p>
                                                    <p class="mb-0">Track 51-75 Cases</p>
                                                    <p class="mb-0">Extra Trackers = $0.25 per month</p>
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                    <input type="hidden" value="" id="subscription_plan"
                                        name="subscription_plan">
                                    <input type="hidden" value="" id="subscription_plan_description"
                                        name="subscription_plan_description">
                                </div>
                                <div class="alert alert-danger mt-3" id="validation-message" style="display: none;">
                                    Please select a subscription plan.
                                </div>

                                <div class="card">

                                    <input type="hidden" id="stripeToken" value="" name="stripeToken">
                                    <div class="form-group">
                                        <div class="card-header">
                                            <label for="card-element">
                                                Enter your credit card information
                                            </label>
                                        </div>
                                        <div class="card-body">
                                            <div id="card-element">
                                                <!-- A Stripe Element will be inserted here. -->
                                            </div>
                                            <!-- Used to display form errors. -->
                                            <div id="card-errors" role="alert"></div>
                                            <input type="hidden" name="plan" value="" />
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button id="card-button" class="btn btn-dark" type="submit"
                                            data-secret="sk_test_51NevDbJ4aKs9ggmFInxEBiypPSpZZsoOyLMLmVWrDb3H68orO4XYsIetFZotLJR2SZoPD5v2ZXU9twzkjMDNGdzH00YxIjyNwN">
                                            Pay </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        {{-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="register_valid" data-bs-toggle="modal" data-bs-target="#myModal2"> Renew Subscription</button>

            </div> --}}
                    </div>
                </div>
            </div>


            <div id="response_message" class="mt-2">

            </div>
            <div class="rounded my-5" style="background-color: rgb(238, 237, 237)">
                <div class="fw-bold text-dark p-2 rounded-top" style="background-color: rgb(189, 187, 187)">
                    Set # of Trackers
                </div>

                <div class="p-4">
                    <div class="d-flex align-items-center justify-content-between gap-1">
                        <span class="text-secondary"> Max # of Trackers</span>
                        <span class="text-secondary fs-5" id="trackerCountAdd">
                            <?php if ($tackerActiveMax !== null): ?>
                            <?= $tackerActiveMax->max_active ?>
                            <?php else: ?>
                            10
                            <?php endif; ?>
                        </span>
                        <input type="hidden" id="userId" value={{ $authenticated_user->id }}>

                        <span class="d-flex align-items-center gap-2">
                            <button class="btn btn-dark" id="decrementButton">
                                <i class="fa fa-minus" aria-hidden="true"></i>
                            </button>
                            <button class="btn btn-dark" id="incrementButton">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="rounded my-5" style="background-color: rgb(238, 237, 237)">
                <div class="fw-bold text-dark p-2 rounded-top" style="background-color: rgb(189, 187, 187)">
                    Tracker Notification Email Address(es)
                </div>
                <div class="p-4">
                    <div class="d-flex flex-column gap-2">
                        <div class="row">
                            <div class="col-md-3 d-flex align-items-center gap-1">
                                <input type="text" id="newEmail"
                                    class="form-control shadow-none outline-none border rounded-1"
                                    placeholder="Add new email address" />
                                <button id="addEmail" class="btn btn-dark shadow-none outline-none rounded-1">
                                    Add
                                </button>
                            </div>
                        </div>
                        <ul id="emailList">
                            @foreach ($userEmail as $email)
                                <li>{{ $email->email }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </main>
@endsection
<!-- Latest compiled and minified JavaScript -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Popper.js (required by Bootstrap) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<script src="{{ asset('build/assets/js/scripts.js') }}"></script>
<script src="https://js.stripe.com/v3/"></script>

<script>
    // Wrap your code in a DOMContentLoaded event listener
    document.addEventListener('DOMContentLoaded', function() {
        // Get a reference to the plus and minus buttons by their class names
        var plusButton = document.querySelector('.btn-dark i.fa-plus').parentElement;
        var minusButton = document.querySelector('.btn-dark i.fa-minus').parentElement;

        // Get a reference to the span elements by their ids
        var trackerCountSpanAdd = document.getElementById('trackerCountAdd');
        var planValueSpan = document.getElementById('planValue');

        // Retrieve the tracker count from localStorage or use a default value
        var trackerCount = localStorage.getItem('trackerCount') || 10;

        // Function to update the tracker count
        function updateTrackerCount() {
            // Check if the tracker count is less than the plan value
            if (trackerCount < parseInt(planValueSpan.textContent)) {
                // Increment the tracker count
                trackerCount++;
                // Update the content of the span element
                trackerCountSpanAdd.textContent = trackerCount;
                // Update the count in localStorage
                localStorage.setItem('trackerCount', trackerCount);
            }
        }

        // Add a click event listener to the plus button
        plusButton.addEventListener('click', updateTrackerCount);

        // Add a click event listener to the minus button
        minusButton.addEventListener('click', function() {
            // Decrement the tracker count, but ensure it doesn't go below 0
            if (trackerCount > 0) {
                trackerCount--;
                // Update the content of the span element
                trackerCountSpanAdd.textContent = trackerCount;
                // Update the count in localStorage
                localStorage.setItem('trackerCount', trackerCount);
            }
        });

        // Initialize the count on page load
        trackerCountSpanAdd.textContent = trackerCount;
    });

    // Wrap your code in a DOMContentLoaded event listener

    $(document).ready(function() {
        $('#incrementButton').click(function(event) {
            event.preventDefault();
            // Get the value of the span element with id 'trackerCountAdd'
            var count = document.getElementById('trackerCountAdd').textContent;
            var user = document.getElementById('userId').value;

            $.ajax({
                type: 'GET',
                url: '{{ route('dashboard.active_tracker') }}',
                data: {
                    count: count,
                    user: user
                },
                success: function(response) {},
                error: function() {
                    $('.pulse-container').hide();
                    $('#responseMessage').text('An error occurred');
                }
            });
        });
    });
    $(document).ready(function() {
        $('#decrementButton').click(function(event) {
            event.preventDefault();
            // Get the value of the span element with id 'trackerCountAdd'
            var count = document.getElementById('trackerCountAdd').textContent;
            var user = document.getElementById('userId').value;

            $.ajax({
                type: 'GET',
                url: '{{ route('dashboard.active_tracker') }}',
                data: {
                    count: count,
                    user: user
                },
                success: function(response) {},
                error: function() {
                    $('.pulse-container').hide();
                    $('#responseMessage').text('An error occurred');
                }
            });
        });
    });
    ////////////// Add emmail ///////////////
    $(document).ready(function() {
        $('#addEmail').click(function() {
            var email = $('#newEmail').val();

            if (!email) {
                $('#response_message').addClass('alert alert-danger');
                $('#response_message').text('Email address is required');

                setTimeout(function() {
                    $('#response_message').removeClass('alert alert-danger');
                    $('#response_message').text('');
                }, 1000); // Remove the message after 1000 milliseconds (1 second)

                return; // Stop further execution
            }

            // Create a new list item and append the email to the <ul>
            var listItem = $('<li>' + email + '</li>');
            $('#emailList').append(listItem);

            $.ajax({
                type: 'POST',
                url: '{{ route('dashboard.user_email') }}',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'email': email
                },
                success: function(data) {
                    console.log(data.message);
                    if (data.status === 200) {
                        $('#response_message').addClass('alert alert-danger');
                        $('#response_message').text(data.message);
                        // Redirect to another route
                    } else {
                        console.log("Error jajlad");

                        $('#response_message').addClass('alert alert-danger');
                        $('#response_message').text(data.message);

                    }
                    setTimeout(function() {
                        $('#response_message').removeClass('alert alert-danger');
                        $('#response_message').text('');
                    }, 1000); // Remove the message after 1000 milliseconds (1 second)

                    $('.pulse-container').hide();
                    // Clear the input field after successful submission
                    $('#newEmail').val('');
                },
                error: function(data) {
                    // Handle errors here
                    console.log(data.responseJSON);
                }
            });
        });
    });
    //// sub_cancel //////////////////////////////////

    $(document).ready(function() {
        $('#sub_cancel').click(function(event) {
            event.preventDefault();
            var cancel = "cancel";
            $.ajax({
                type: 'GET',
                url: '{{ route('dashboard.subscription_cancel') }}',
                data: {
                    cancel: cancel
                },
                success: function(response) {
                    if (response.status === 200) {
                        $('#response_message').addClass('alert alert-danger');
                        $('#response_message').text(response.message);
                    }
                    setTimeout(function() {
                        $('#response_message').removeClass('alert alert-danger');
                        $('#response_message').text('');
                    }, 1000); // Remove the message after 1000 milliseconds (1 second)
                },
                error: function() {
                    $('.pulse-container').hide();
                    $('#responseMessage').text('An error occurred');
                }
            });
        });
    });

    //////////// stripe //////////////////////////////////////////////////////////////////


    $(document).ready(function() {
        $(".card-content-wrapper").click(function() {
            // Find the radio input within the parent label
            const radioInput = $(this).closest("label").find('input[type="radio"]');

            // Get the value of the radio input
            const radioValue = radioInput.val();

            // Select the radio input (optional)
            radioInput.prop('checked', true);

            // Update the hidden input fields with the selected values
            $("#subscription_plan").val(radioValue);
            $("#subscription_plan_description").val($(this).find('.subscription_plan_description')
            .text());


        });
    });


    $(document).ready(function() {
        // Define stripe object in an accessible scope
        var stripe = Stripe(
            'pk_test_51NevDbJ4aKs9ggmF6Uc8JSpHjeJFtTbGoWGBhw0rpFvqG9st0B3Ek77IKGifYHaC28xlsvs1yF8ERkR53KtqjRYY00kb2pasC3'
        );
        var elements = stripe.elements();
        var cardElement = elements.create('card');

        cardElement.mount('#card-element');

        // Handle real-time validation errors from the card Element.
        cardElement.on('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        $('#register_valid').click(function(event) {
            var selectedRadio = $('input[type="radio"]:checked');

            if (!selectedRadio.length) {
                $("#validation-message").show();
                $('#modal_content_main').hide();
                $('.modal12').hide();
                $('.modal-backdrop').removeClass('show');
            } else {
                $("#validation-message").hide();
                $('#modal_content_main').show();
                $('.modal12').show();
                $('#myModal2').addClass('show');
                $("#subscription_plan").val(selectedRadio.val());
                var subscriptionPlanDescription = selectedRadio.closest('.radio-card').find(
                    '.subscription_plan_description').text();
                $("#subscription_plan_description").val(subscriptionPlanDescription);
            }
        });

        $('input[type="radio"]').on('change', function() {
            $("#validation-message").hide();
            if ($(this).is(':checked')) {
                var radioCardContainer = $(this).closest('.radio-card');

                // Find the <h4> element within the .radio-card container
                var selectedH4 = radioCardContainer.find('.subscription_plan_description');
                $('#subscription_plan').val($(this).val());
                $('#subscription_plan_description').val(selectedH4.text());
            }
        });

        $('#payment-form').click(function(event) {
            event.preventDefault();

            // Create a token using the cardElement
            stripe.createToken(cardElement).then(function(result) {
                if (result.error) {
                    // Display error to the user
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Token created successfully, proceed with payment
                    const clientSecret =
                        '{{ $clientSecret }}'; // Retrieve the client_secret from Blade template

                    // Confirm the payment with the PaymentIntent and save the payment method
                    stripe.confirmCardPayment(clientSecret, {
                        payment_method: {
                            card: cardElement,
                            billing_details: {
                                // Provide billing details if needed
                            },
                        },
                        setup_future_usage: 'off_session', // Save the payment method for future use
                    }).then(function(result) {
                        if (result.error) {
                            // Display error to the user
                            var errorElement = document.getElementById('card-errors');
                            errorElement.textContent = result.error.message;
                        } else if (result.paymentIntent.status === 'succeeded') {
                            // Payment successful, set payment method ID and submit the form
                            $('#stripeToken').val(result.paymentIntent.payment_method);
                            $('#payment-form')[0].submit();
                        }
                    });
                }
            });
        });
    });
</script>
