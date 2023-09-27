<?php

namespace App\Http\Controllers;

use App\Mail\caseTrackerUpdate;
use App\Models\TackerActive;
use Carbon\Carbon;
use App\Models\User;
use App\Traits\GetResponse;
use Illuminate\Http\Request;
use App\Traits\MakesCurlRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Tracker as ModelTracker;
use Illuminate\Support\Facades\Mail;


class TrackerController extends Controller
{
    use GetResponse;
    use MakesCurlRequest;
    // Add Tracker
    public function addtracker()
    {
        $user = Auth::user();
        // Get the count of active trackers
        $count = ModelTracker::where('user_id', $user->id)->count();


        // Get the count of all trackers, including soft deleted ones
        $totalCount = ModelTracker::withTrashed()->where('user_id', $user->id)->count();
        return view('user.dashboard.addtracker', compact('count', 'totalCount', 'user'));
    }

    public function save_tracker(Request $request)
    {
        $caseNumber = $request->case_number;
        $url = env('SCRAPER_URL') . $caseNumber;
        // $url = 'http://146.190.175.71:8080/' . $caseNumber;
        $result = $this->makeCurlRequest($url);

        if ($result !== false) {
            $response = json_decode($result);

            // Split the response into sections based on "PARTY INFORMATION"
            $sections = explode("PARTY INFORMATION\n\n\n", $response);
            if (count($sections) == 2) {
                $caseInfoSection = $sections[0];
                $partyInfoSection = $sections[1];
                $caseInfoLines = explode("\n", $caseInfoSection);
                $caseData = [];
                $currentKey = '';
                foreach ($caseInfoLines as $line) {
                    if (strpos($line, ":") !== false) {
                        list($key, $value) = explode(":", $line, 2);
                        $currentKey = trim($key);
                        $caseData[$currentKey] = trim($value);
                    } else {
                        // Append the line to the current key's value
                        if (!empty($currentKey)) {
                            $caseData[$currentKey] .= ' ' . trim($line);
                        }
                    }
                }
                // Process the party information to end section
                $partyInfoLines = explode("\n", $partyInfoSection);
                $partyData = [];
                foreach ($partyInfoLines as $line) {
                    if (!empty($line)) {
                        $partyData[] = trim($line);
                    }
                }
                // Combine the two sections into an array
                $resultArray = [
                    "case_information" => $caseData,
                    "party_information_to_end" => $partyData,
                ];
                $case_information = $resultArray['case_information'];
                $line = $case_information['Case Number'];
                $pattern = '/^(.*?)\s(.*)$/';
                if (preg_match($pattern, $line, $matches)) {
                    $caseNumber = $matches[1];
                    $caseString = $matches[2];
                } else {
                    return response()->json([
                        'status' => 500,
                        'message' => 'Invalid line format.',
                    ]);
                }
                $authenticated_user = User::find(Auth::user()->id);

                $trackerCount = $authenticated_user->trackers()->withTrashed()->count();
                // Your logic for checking tracker limits based on the plan
                $plan = $authenticated_user->subscription->plan;
                $tracker_cases = $authenticated_user->trackers;
                $tracker_collection = collect($tracker_cases);
                if ($tracker_collection->contains('case_number', $caseNumber)) {
                    return response()->json([
                        'message' => 'Duplicate Case Number Found',
                        'status' => 500,
                    ]);
                }
                $trackerActiveCount = $authenticated_user->trackers->count();
                $tackerActiveMax = TackerActive::where('user_id', (Auth::user()->id))->first();
                if ($tackerActiveMax == null) {
                    $maxActiveLimite = 10;
                } else {
                    $maxActiveLimite = $tackerActiveMax->max_active;
                }
                if ($maxActiveLimite <= $trackerActiveCount) {
                    return response()->json([
                        'status' => 500,
                        'message' => 'Your Active Cases Limit Exceed for your plan. Please Increase Your Active Cases Limit',
                    ]);
                }

                if ($plan == "Small Practice") {
                    $limit = 25;
                }
                if ($plan == "Mid-Size Practice" && $trackerCount < 50) {
                    $limit = 50;
                }
                if ($plan == "Large Practice" && $trackerCount < 75) {
                    $limit = 75;
                }
                if ($trackerCount >= $limit) {
                    return response()->json([
                        'status' => 500,
                        'message' => 'Your Cases Limit Exceed for your plan. Please Upgrade Your Subscription Plan',
                    ]);
                } else {
                    $tracker = new ModelTracker();
                    $tracker->case_number = $caseNumber;
                    $tracker->case_name = $caseString;
                    $filingDate = $case_information['Filing Date'];
                    // Convert the date format to 'Y-m-d' (year-month-day)
                    $convertedDate = Carbon::createFromFormat('m/d/Y', $filingDate)->format('Y-m-d');
                    $tracker->last_update =  $convertedDate;
                    $tracker->tracking = 'N/A';
                    $tracker->user_id = Auth::user()->id;
                    $tracker->state = $request->state_Selected;
                    $tracker->county = $request->county_Selected;
                    $tracker->court = $request->court_Selected;
                    $tracker->type = $request->tracker_type_selected;

                    $tracker->save();
                    return response()->json([
                        'status' => 200,
                        'message' => 'Tracker added successfully.',
                    ]);
                }
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Wrong Case Number',
                ]);
            }
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Unable to get the response from the server',
            ]);
        }
    }


    public function remove($id)
    {
        $tracker = ModelTracker::find($id);
        $tracker->delete();
        return redirect()->back()->with('message', 'You Deleted Your Tracker Successfully');
    }
}
