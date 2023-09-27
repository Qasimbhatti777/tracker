<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\User;
use Stripe\Charge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Exception\CardException;
use Illuminate\Support\Facades\Session;
use Stripe\Stripe;
use Stripe\PaymentMethod;
use Stripe\Customer;
use Stripe\PaymentIntent;

class SubscriptionController extends Controller
{
    //
    public function stripePost(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            // Check if the customer already exists
            $customer = Customer::create([
                'email' => 'waqas@gmail.com', // Provide customer's email
                'payment_method' => $request->stripeToken,
            ]);

            // Attach PaymentMethod to the customer
            $paymentMethod = PaymentMethod::retrieve($request->stripeToken);
            $paymentMethod->attach(['customer' => $customer->id]);

            // Create a PaymentIntent
            $intent = PaymentIntent::create([
                'amount' => 50, // Minimum amount in cents (50 cents)
                'currency' => 'USD',
                'customer' => $customer->id,
                'payment_method' => $paymentMethod->id,
                'confirm' => true, // Automatically confirm the PaymentIntent
            ]);

            // Check if the payment intent is succeeded
            if ($intent->status === 'succeeded') {
                Session::flash('success', 'Payment Successful!');
                dd('success', 'Payment Successful!');
                return redirect()->back(); // Redirect to a success page or back to the form
            } else {
                // Payment intent status is not 'succeeded'
                // Handle this scenario as needed
            }
        } catch (\Exception $e) {
            dd('Caught Exception: ' . $e->getMessage());
            Session::flash('error', 'An error occurred while processing the payment.');
            return redirect()->back(); // Redirect back to the form with an error message
        }
    }

    public function subscriptionCancel(Request $request)
    {

        $userSubscription = Subscription::where('user_id', (Auth::user()->id))->first();
        if ($userSubscription) {
            // Update the existing record
            $userSubscription->status = $request->cancel;
            $userSubscription->save();
            return response()->json([
                'message' => 'Your subscription cancelled successfully',
                'status' => 200,
            ]);
        }
    }
}
