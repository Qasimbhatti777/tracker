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
    <title>myCourtBot | Register</title>
    <link href="{{asset('build/assets/css/styles.css')}}" rel="stylesheet" />
    <link href="{{asset('build/assets/css/login.css')}}" rel="stylesheet" />
    <script
      src="https://use.fontawesome.com/releases/v6.3.0/js/all.js"
      crossorigin="anonymous"
    ></script>
  </head>
  <body>
    <div
      class="container"
      style="
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
      "
    >
    @php
        $stripeSecretKey = config('services.stripe.primary');
    @endphp
      <div>
        <div>
          <div class="card my-5">
            <form class="card-body cardbody-color p-lg-5">
              <div class="text-center">
                <img
                  src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTgy-nLu_4sPKcCVPG6zqPtf6b0Auj4guKz8D4_Aj4oZVYAs6G9Va8Olr96-_5ZPT7Y-p0&usqp=CAU"
                  class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3"
                  width="200px"
                  alt="profile"
                />
              </div>
              <div class="mb-3">
                <div class="row">
                  <div class="col-6">
                    <input
                      type="email"
                      class="form-control outline-none shadow-none border border-dark rounded-1"
                      id="firstName"
                      aria-describedby="firstName"
                      placeholder="First Name"
                    />
                  </div>
                  <div class="col-6">
                    <input
                      type="email"
                      class="form-control outline-none shadow-none border border-dark rounded-1"
                      id="lastName"
                      aria-describedby="lastName"
                      placeholder="Last Name"
                    />
                  </div>
                </div>
              </div>

              <div class="mb-3">
                <input
                  type="email"
                  class="form-control outline-none shadow-none border border-dark rounded-1"
                  id="EmailAddress"
                  aria-describedby="emailHelp"
                  placeholder="Email Address"
                />
              </div>
              <div class="mb-3">
                <input
                  type="password"
                  class="form-control outline-none shadow-none border border-dark rounded-1"
                  id="password"
                  placeholder="password"
                />
              </div>
              <div class="mb-3">
                <div class="form-check">
                  <input
                    class="form-check-input"
                    type="checkbox"
                    value=""
                    id="flexCheckChecked"
                    checked
                  />
                  <label class="form-check-label" for="flexCheckChecked">
                    I agree to the
                    <a href="terms-and-conditions.html" class="text-primary">
                      terms and conditions</a
                    >
                  </label>
                </div>
              </div>
              <div class="text-center">
                <button
                  type="button"
                  class="btn btn-primary px-5 mb-5 w-100 rounded-1"
                  data-bs-toggle="modal"
                  data-bs-target="#myModal"
                >
                  REGISTER
                </button>
                <!-- <a
                  href="./dashboard/index.html"
                  type="submit"
                  class="btn btn-primary px-5 mb-5 w-100 rounded-1"
                >
                  REGISTER
                </a> -->
              </div>
              <div id="emailHelp" class="form-text text-center mb-5 text-dark">
                Already have an account?
                <a href="login.html" class="text-dark fw-bold"> Login</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="myModal">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title mx-auto text-dark">PAYMENT !</h4>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            {{-- <ul class="nav nav-tabs w-100" id="myTab" role="tablist">
              <li class="nav-item w-50" role="presentation">
                <button
                  class="nav-link active w-100"
                  id="home-tab"
                  data-bs-toggle="tab"
                  data-bs-target="#home-tab-pane"
                  type="button"
                  role="tab"
                  aria-controls="home-tab-pane"
                  aria-selected="true"
                >
                  <img
                    src="https://www.nicepng.com/png/detail/235-2355689_american-express-mastercard-and-visa-logos-visa.png"
                    alt=""
                    class="img-fluid w-100"
                    style="height: 50px; object-fit: contain"
                  />
                </button>
              </li>
              <li class="nav-item w-50" role="presentation">
                <button
                  class="nav-link w-100"
                  id="profile-tab"
                  data-bs-toggle="tab"
                  data-bs-target="#profile-tab-pane"
                  type="button"
                  role="tab"
                  aria-controls="profile-tab-pane"
                  aria-selected="false"
                >
                  <img
                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSm95HnlK5qPlU409HtBtv_xsMnNSJMhub6U-AMT1oVJQ&s"
                    alt=""
                    class="img-fluid w-100"
                    style="height: 50px; object-fit: contain"
                  />
                </button>
              </li>
            </ul> --}}

            <div class="card">
                <form action="{{route('stripe.post')}}"  method="post" id="payment-form">
                    @csrf
                    <input type="hidden" name="stripeToken" id="stripeToken" value="{{ $stripeToken }}" />
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
                      <button
                      id="card-button"
                      class="btn btn-dark"
                      type="submit"
                      data-secret="sk_test_51NevDbJ4aKs9ggmFInxEBiypPSpZZsoOyLMLmVWrDb3H68orO4XYsIetFZotLJR2SZoPD5v2ZXU9twzkjMDNGdzH00YxIjyNwN"
                      > Pay </button>
                  </div>
              </form>
          </div>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button
              type="button"
              class="rounded-1 btn btn-light"
              data-bs-dismiss="modal"

            >
              Cancel
            </button>
          </div>
        </div>
      </div>
    </div>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
      crossorigin="anonymous"
    ></script>
    <script src="{{ asset('build/assets/js/scripts.js') }}"></script>

    <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include Stripe -->
<script src="https://js.stripe.com/v3/"></script>
<script>
    // Custom styling can be passed to options when creating an Element.
    var style = {
        base: {
            color: '#32325d',
            lineHeight: '18px',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    };

    const stripe = Stripe('pk_test_51NevDbJ4aKs9ggmF6Uc8JSpHjeJFtTbGoWGBhw0rpFvqG9st0B3Ek77IKGifYHaC28xlsvs1yF8ERkR53KtqjRYY00kb2pasC3'); // Replace with your actual public key
    const elements = stripe.elements(); // Create an instance of Elements.
    const cardElement = elements.create('card', { style: style }); // Create an instance of the card Element.
    cardElement.mount('#card-element'); // Add an instance of the card Element into the `card-element` <div>.

    // Handle real-time validation errors from the card Element.
    cardElement.addEventListener('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    // Handle form submission.
    var form = document.getElementById('payment-form');

    form.addEventListener('submit', async function(event) {
        event.preventDefault();

        const clientSecret = '{{ $clientSecret }}'; // Retrieve the client_secret from Blade template

        // Confirm the payment with the PaymentIntent
        const result = await stripe.confirmCardPayment(clientSecret, {
            payment_method: {
                card: cardElement
            }
        });

        if (result.error) {
            // Display error to user
            var errorElement = document.getElementById('card-errors');
            errorElement.textContent = result.error.message;
        } else if (result.paymentIntent.status === 'succeeded') {
            // Payment successful, submit the form
            form.submit();
        }
    });
</script>



  </body>
</html>
