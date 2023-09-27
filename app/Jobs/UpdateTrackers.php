<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Mail\caseTrackerUpdate;
use Carbon\Carbon;
use App\Models\User;
use App\Traits\GetResponse;
use Illuminate\Http\Request;
use App\Traits\MakesCurlRequest;
use App\Models\Tracker as ModelTracker;
use Illuminate\Support\Facades\Mail;


class UpdateTrackers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, GetResponse, MakesCurlRequest;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $trackers = ModelTracker::all();
        $userTrackers = []; // Initialize the $userTrackers array
        foreach ($trackers as $tracker) {
            $userId = $tracker->user_id;
            $caseNumber = $tracker->case_number;
            $state = $tracker->state;
            $county = $tracker->county;
            $court = $tracker->court;
            $type = $tracker->type;

            $url = env('SCRAPER_URL') . $caseNumber;
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
                    $filingDate = $case_information['Filing Date'];
                    // Convert the date format to 'Y-m-d' (year-month-day)
                    $convertedDate = Carbon::createFromFormat('m/d/Y', $filingDate)->format('Y-m-d');
                    $line = $case_information['Case Number'];
                    // $last_update = Carbon::createFromFormat('m/d/Y', $case_information['Filing Date']);
                    $pattern = '/^(.*?)\s(.*)$/';
                    if (preg_match($pattern, $line, $matches)) {
                        $caseNumber = $matches[1];
                        $caseString = $matches[2];
                        if ($caseString !== $tracker->case_name || $convertedDate !== $tracker->last_update) {
                            // Data has changed; update the database
                            $tracker->case_number = $caseNumber;
                            $tracker->case_name = $caseString;
                            $tracker->last_update = $convertedDate;
                            $tracker->tracking = 'N/A';
                            $tracker->user_id = $userId;
                            $tracker->state = $state;
                            $tracker->county = $county;
                            $tracker->court = $court;
                            $tracker->type = $type;
                            $tracker->save();
                            if (!isset($userTrackers[$userId])) {
                                $userTrackers[$userId] = [];
                            }

                            $userTrackers[$userId][] = $tracker;
                        }
                    }
                }
            }
        }
        if ($userTrackers) {
            foreach ($userTrackers as $userId => $updatedTrackers) {
                $user = User::find($userId);
                $userEmail = $user->email;
                Mail::to($userEmail)->send(new caseTrackerUpdate($updatedTrackers));
            }
        }
    }
}
