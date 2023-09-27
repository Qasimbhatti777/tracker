<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>myCourtBot | Register</title>
    <link href="{{ asset('build/assets/css/styles.css') }}" rel="stylesheet" />
    <link href="{{ asset('build/assets/css/login.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="{{ asset('build/assets/css/support.css') }}" rel="stylesheet" />
    <style>
    @media (min-width: 992px)  and (max-width: 1168px){
        .col-lg-6 {
            width: 75%!important;
        }
    }
    @media (min-width: 1168px)  and (max-width: 1465px){
        p {
            font-size: 11px!important;
        }
        h4 {
            font-size: 12px;
        }
    }
    </style>
</head>

<body>
<div class="container-fluid">
        @php
            $intent = config('services.stripe.secret');
            $stripeSecretKey = config('services.stripe.primary');
        @endphp
            <div class="row justify-content-center">
                <div class="col-12 col-lg-6 col-md-12">
                <div class="card my-5">


                    <form class="card-body cardbody-color p-lg-5" action="{{ route('register') }}" method="post" id="payment-form">
                        @csrf
                        <div class="text-center">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTgy-nLu_4sPKcCVPG6zqPtf6b0Auj4guKz8D4_Aj4oZVYAs6G9Va8Olr96-_5ZPT7Y-p0&usqp=CAU"
                                class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3" width="200px"
                                alt="profile" />
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-6">
                                    <input type="text"
                                        class="form-control outline-none shadow-none border border-dark rounded-1"
                                        id="firstName" name="first_name" aria-describedby="firstName" placeholder="First Name" />
                                </div>
                                <div class="col-6">
                                    <input type="text"
                                        class="form-control outline-none shadow-none border border-dark rounded-1"
                                        id="lastName" name="last_name" aria-describedby="lastName" placeholder="Last Name" />
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <input type="email"
                                class="form-control outline-none shadow-none border border-dark rounded-1"
                                id="EmailAddress" name="email" aria-describedby="emailHelp" placeholder="Email Address" />
                        </div>
                        <div class="mb-0">
                            <input type="password"
                                class="form-control outline-none shadow-none border border-dark rounded-1"
                                id="password" name="password" placeholder="password" />
                        </div>
                        <div class="row">
                            <div class="d-flex justify-content-around flex-wrap"> <!-- Use justify-content-around for spacing -->
                                <label for="radio-card-1" class="radio-card col-12 col-sm-6 col-md-4 col-lg-4 p-0">
                                    <div class="pe-2">
                                        <input type="radio"  name="radio-card" id="radio-card-1" value="10"  />
                                        <div class="card-content-wrapper p-3 bg-light d-flex" style="height: 160px;">
                                            <!-- Set height to 200px -->
                                            <span class="check-icon"></span>
                                            <div class="card-content">
                                                <h4 class="fw-bold subscription_plan_description">Small Practice</h4>
                                                <input type="hidden" name="price_id_small" value="price_1NfezTJ4aKs9ggmFYgHq0Mp5">
                                                <p class="mb-0">$10/Month</p>
                                                <p class="mb-0">Track 1-25 Cases</p>
                                                <p class="mb-0">Extra Trackers = $0.35 per month</p>
                                            </div>
                                        </div>
                                    </div>

                                </label>
                                <label for="radio-card-2" class="radio-card col-12 col-sm-6 col-md-4 col-lg-4 p-0">
                                    <div class="pe-2">
                                        <input type="radio" name="radio-card"  id="radio-card-2" value="18" />
                                        <div class="card-content-wrapper p-3 bg-light d-flex" style="height: 160px;">
                                            <!-- Set height to 200px -->
                                            <span class="check-icon"></span>
                                            <div class="card-content">
                                                <h4 class="fw-bold subscription_plan_description">Mid-Size Practice</h4>
                                                <input type="hidden" name="price_id_mid" value="price_1Nff0vJ4aKs9ggmFVaLRnbWI">
                                                <p class="mb-0">$18/Month</p>
                                                <p class="mb-0">Track 26-50 Cases</p>
                                                <p class="mb-0">Extra Trackers = $0.30 per month</p>
                                            </div>
                                        </div>
                                    </div>
                                </label>

                                <label for="radio-card-3" class="radio-card col-12 col-sm-6 col-md-4 col-lg-4 p-0">
                                    <div class="pe-2">
                                        <input type="radio" name="radio-card" id="radio-card-3" value="25" />
                                        <div class="card-content-wrapper p-3 bg-light d-flex" style="height: 160px;">
                                            <!-- Set height to 200px -->
                                            <span class="check-icon"></span>
                                            <div class="card-content">
                                                <h4 class="fw-bold subscription_plan_description">Large Practice</h4>
                                                <input type="hidden" name="price_id_large" value="price_1Nff25J4aKs9ggmF6ttW2ebQ">
                                                <p class="mb-0">$25/Month</p>
                                                <p class="mb-0">Track 51-75 Cases</p>
                                                <p class="mb-0">Extra Trackers = $0.25 per month</p>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                                <input type="hidden" value="" id="subscription_plan" name="subscription_plan">
                                <input type="hidden" value="" id="subscription_plan_description" name="subscription_plan_description">
                            </div>
                            <div class="alert alert-danger mt-3" id="validation-message" style="display: none;">
                                Please select a subscription plan.
                            </div>

                            <!-- /.d-flex justify-content-around -->
                        </div>
                        <!-- /.row -->
                        <div class="my-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked"
                                    checked />
                                <label class="form-check-label" for="flexCheckChecked">
                                    I agree to the
                                    <a href="{{ route('user_terms') }}" class="text-primary">
                                        terms and conditions</a>
                                </label>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="button" id="register_valid" class="btn btn-primary px-5 mb-3 w-100 rounded-1"
                                data-bs-toggle="modal" data-bs-target="#myModal">
                                REGISTER
                            </button>

                        </div>
                        <div id="emailHelp" class="form-text text-center text-dark">
                            Already have an account?
                            <a href="{{ url('/login') }}" class="text-dark fw-bold"> Login</a>
                        </div>

                </div>
            </div>
        </div>

    <div class="modal fade modal12" id="myModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" id="modal_content_main">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title mx-auto text-dark">PAYMENT !</h4>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
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
                        </form>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button"  id="model_cancel" class="rounded-1 btn btn-light" data-bs-dismiss="modal">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="{{ asset('build/assets/js/scripts.js') }}"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script>


              $('#register_valid').on('click', function(){
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
            $('.modal-backdrop').addClass('show');
            $("#subscription_plan").val(selectedRadio.val());
            var subscriptionPlanDescription = selectedRadio.closest('.radio-card').find('.subscription_plan_description').text();


            $("#subscription_plan_description").val(subscriptionPlanDescription);


        }
        });
             $('input[name="radio-card"]').on('change', function() {
                $("#validation-message").hide();
            if ($(this).is(':checked')) {
                var radioCardContainer = $(this).closest('.radio-card');

            // Find the <h4> element within the .radio-card container
            var selectedH4 = radioCardContainer.find('.subscription_plan_description');
                $('#subscription_plan').val($(this).val());
                $('#subscription_plan_description').val(selectedH4.text());
            }
        });
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


     $('#payment-form').submit(function(event) {
            event.preventDefault();

            // Create a token using the cardElement
            stripe.createToken(cardElement).then(function(result) {
                if (result.error) {
                    // Display error to user
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
                            // Display error to user
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
    </script>



</body>

</html>
