<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Tracker;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TackerActive;
use App\Models\UserEmail;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Subscription;
use Illuminate\View\View;
use Stripe\PaymentIntent;
use Stripe\PaymentMethod;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use App\Models\Subscription as Subscribe;



class UserController extends Controller
{
    //Dashboard Index
    public function index()
    {
        $user = Auth::user();
        $trackers = Auth::user()->trackers;
        $authenticated_user = User::find(Auth::user()->id);

        $plan = $authenticated_user->subscription->plan;
        if ($plan == "Small Practice") {
            $include_in_subscription = 25;
        } elseif ($plan == "Mid-Size Practice") {
            $include_in_subscription = 50;
        } elseif ($plan == "Large Practice") {
            $include_in_subscription = 75;
        } else {
            $include_in_subscription = 'N/A';
        }
        $count = count($trackers);
        return view('user.dashboard.index', compact('trackers', 'count', 'plan', 'include_in_subscription', 'user'));
    }

    // Setting
    public function setting()
    {
        $user = Auth::user();
        // Get the count of active trackers
        $activeTracker = Tracker::where('user_id', $user->id)->count();
        $trackers = Auth::user()->trackers;
        $authenticated_user = User::find(Auth::user()->id);
        $tackerActiveMax = TackerActive::where('user_id', (Auth::user()->id))->first();
        $userEmail =  UserEmail::where('user_id', (Auth::user()->id))->get();
        $plan = $authenticated_user->subscription->plan;
        if ($plan == "Small Practice") {
            $include_in_subscription = 25;
        } elseif ($plan == "Mid-Size Practice") {
            $include_in_subscription = 50;
        } elseif ($plan == "Large Practice") {
            $include_in_subscription = 75;
        } else {
            $include_in_subscription = 'N/A';
        }
        // Create a PaymentIntent
        Stripe::setApiKey(config('services.stripe.secret'));

        $intent = PaymentIntent::create([
            'amount' => 1000,
            'currency' => 'usd',
        ]);
        $clientSecret = $intent->client_secret;

        // Pass the client_secret to the registration view
        // return view('auth.register', ['clientSecret' => $intent->client_secret]);
        return view('user.dashboard.setting', compact('activeTracker', 'plan', 'include_in_subscription', 'authenticated_user', 'tackerActiveMax', 'userEmail', 'clientSecret'));
    }

    public function activeTracker(Request $request)
    {
        $tackerActiveMax = TackerActive::where('user_id', $request->user)->first();

        if ($tackerActiveMax) {
            // Update the existing record
            $tackerActiveMax->max_active = $request->count;
            $tackerActiveMax->save();
        } else {
            // Create a new record
            $tracker = new TackerActive();
            $tracker->user_id = $request->user;
            $tracker->max_active = $request->count;
            $tracker->save();
        }
    }

    public function userEmailStore(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email',
        ]);

        // Check if the email is empty
        if (empty($request->input('email'))) {
            return response()->json([
                'message' => 'Email address is required',
                'status' => 500,
            ]);
        }

        // Create a new UserEmail instance
        $userEmail = new UserEmail();
        $userEmail->user_id = Auth::user()->id;
        $userEmail->email = $request->input('email');
        $userEmail->save();

        return response()->json([
            'message' => 'Email address saved successfully',
            'status' => 200,
        ]);
    }

    // Support
    public function support()
    {
        return view('user.dashboard.support');
    }

    // Payment
    public function payment()
    {
        return view('user.dashboard.payment');
    }

    // login
    public function login()
    {
        return view('user.login.login');
    }

    //register
    public function register_user()
    {
        return view('user.login.register');
    }

    // Privacy Dashboard
    public function privacy()
    {
        return view('user.dashboard.privace-policy');
    }
    // Privacy Vendor
    public function user_privacy()
    {
        return view('user.privacy');
    }
    // Terms Vendor
    public function user_terms()
    {
        return view('user.terms');
    }
    // Terms
    public function terms()
    {
        return view('user.dashboard.terms');
    }
    // Landing Page
    public function landing_page()
    {
        return view('user.login.index');
    }
}
