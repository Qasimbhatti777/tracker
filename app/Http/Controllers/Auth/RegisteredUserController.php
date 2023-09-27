<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use Stripe\Stripe;
use App\Models\User;
use Stripe\Customer;
use Stripe\Subscription;
use Illuminate\View\View;
use Stripe\PaymentIntent;
use Stripe\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use App\Models\Subscription as Subscribe;
use App\Models\Subscription as ModelsSubscription;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        // Create a PaymentIntent
        Stripe::setApiKey(config('services.stripe.secret'));

        $intent = PaymentIntent::create([
            'amount' => 1000,
            'currency' => 'usd',
        ]);

        // Pass the client_secret to the registration view
        return view('auth.register', ['clientSecret' => $intent->client_secret]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        DB::beginTransaction();
        $subscription_plan_description = $request->subscription_plan_description;
        if ($subscription_plan_description == 'Small Practice') {

            $price_id = $request->price_id_small;
        } else if ($subscription_plan_description == 'Mid-Size Practice') {
            $price_id = $request->price_id_mid;
        } else if ($subscription_plan_description == 'Large Practice') {
            $price_id = $request->price_id_large;
        }
        try {
            // Register the user
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // Process the Stripe payment
            Stripe::setApiKey(config('services.stripe.secret'));

            // Create a customer in Stripe
            $customer = Customer::create([
                'email' => $request->email,
                'payment_method' => $request->stripeToken,
            ]);
            // Attach PaymentMethod to the customer
            $paymentMethod = PaymentMethod::retrieve($request->stripeToken);
            $customer->invoice_settings->default_payment_method = $paymentMethod->id;
            $customer->save();

            // Create a subscription
            $subscription = Subscription::create([
                'customer' => $customer->id,
                'items' => [
                    [
                        'price' => $price_id, // Replace with the actual Price ID from Stripe Dashboard
                    ],
                ],
            ]);

            // Check if the subscription creation is successful
            if ($subscription->status === 'active') {
                // Subscription creation successful
                // Store subscription information in your database
                $subscriptionRecord = new Subscribe(); // Replace with the actual model name
                $subscriptionRecord->user_id = $user->id;
                $subscriptionRecord->stripe_subscription_id = $subscription->id;
                $subscriptionRecord->plan = $request->subscription_plan_description; // Replace with the plan name or identifier
                $subscriptionRecord->subscription_date = Carbon::now();
                $subscriptionRecord->save();
                $user->subscription_id = $subscriptionRecord->id;
                $user->save();
            } else {
                // Subscription creation not successful
                // Handle this scenario as needed
                DB::rollback(); // Rollback the transaction
                Session::flash('error', 'An error occurred while processing the subscription.');
                return redirect()->back(); // Redirect back to the form with an error message
            }

            DB::commit(); // Commit the transaction

            // Redirect the user to a success page or dashboard
            Session::flash('success', 'Registration and Payment Successful!');
            event(new Registered($user));
            Auth::login($user);
            return redirect(RouteServiceProvider::HOME);
        } catch (\Exception $e) {
            dd('Caught Exception: ' . $e->getMessage());
            DB::rollback(); // Rollback the transaction
            Session::flash('error', 'An error occurred during registration and payment.');
            return redirect()->back(); // Redirect back to the form with an error message
        }
    }
    public function renewSubscription(Request $request)
    {
        DB::beginTransaction();
        $user = ModelsSubscription::where('user_id', (Auth::user()->id))->first();

        $subscription_plan_description = $request->subscription_plan_description;
        if ($subscription_plan_description == 'Small Practice') {

            $price_id = $request->price_id_small;
        } else if ($subscription_plan_description == 'Mid-Size Practice') {
            $price_id = $request->price_id_mid;
        } else if ($subscription_plan_description == 'Large Practice') {
            $price_id = $request->price_id_large;
        }
        try {
            // Register the user
            $subscriptionRecord = ModelsSubscription::where('user_id', (Auth::user()->id))->first();;

            // Process the Stripe payment
            Stripe::setApiKey(config('services.stripe.secret'));

            // Create a customer in Stripe
            $customer = Customer::create([
                'email' => $request->email,
                'payment_method' => $request->stripeToken,
            ]);
            // Attach PaymentMethod to the customer
            $paymentMethod = PaymentMethod::retrieve($request->stripeToken);
            $customer->invoice_settings->default_payment_method = $paymentMethod->id;
            $customer->save();

            // Create a subscription
            $subscription = Subscription::create([
                'customer' => $customer->id,
                'items' => [
                    [
                        'price' => $price_id, // Replace with the actual Price ID from Stripe Dashboard
                    ],
                ],
            ]);

            // Check if the subscription creation is successful
            if ($subscription->status === 'active') {
                // Subscription creation successful
                // Store subscription information in your database
                $subscriptionRecord->user_id = Auth::user()->id;
                $subscriptionRecord->stripe_subscription_id = $subscription->id;
                $subscriptionRecord->plan = $request->subscription_plan_description; // Replace with the plan name or identifier
                $subscriptionRecord->subscription_date = Carbon::now();
                $subscriptionRecord->status = "active";
                $subscriptionRecord->save();
            } else {
                // Subscription creation not successful
                // Handle this scenario as needed
                DB::rollback(); // Rollback the transaction
                Session::flash('error', 'An error occurred while processing the subscription.');
                return redirect()->back(); // Redirect back to the form with an error message
            }

            DB::commit(); // Commit the transaction

            // Redirect the user to a success page or dashboard
            Session::flash('success', 'Registration and Payment Successful!');
            return redirect()->back();
        } catch (\Exception $e) {
            dd('Caught Exception: ' . $e->getMessage());
            DB::rollback(); // Rollback the transaction
            Session::flash('error', 'An error occurred during registration and payment.');
            return redirect()->back(); // Redirect back to the form with an error message
        }
    }
}
