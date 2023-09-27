<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Tracker;
use App\Traits\GetResponse;
use App\Service\UserService;
use Illuminate\Http\Request;
use App\Traits\MakesCurlRequest;
use Illuminate\Support\Facades\Auth;

class CaseTrackerApi extends Controller
{
    use GetResponse;
    use MakesCurlRequest;
    //
    public function case_information(){

        //     $endpoint=$this->get_response($endpoint);

        // $endpoint = 'http://146.190.175.71:5000/';

        // try {
        //     $response = Http::get($endpoint);

        //     if ($response->successful()) {
        //         return $response->body();
        //     } else {
        //         return "Request was not successful. Status code: " . $response->status();
        //     }
        // } catch (\Exception $e) {
        //     return "An error occurred: " . $e->getMessage();
        // }

        // $response=$this->get_response($json,'register_of_actions');
        // $userService = app(UserService::class, [
        //     'response' => $json,
        //     'parameter' => 'party_information',
        // ]);

        // $register_of_actions = $userService->getResponse();
        // dd($register_of_actions);
        // $date=$this->getDateFromString($register_of_actions[0]->status);
        // dd($date);
            $id='22STPB09351';

        // try {
            $url = 'http://146.190.175.71:5000/' . $id;
            $result = $this->makeCurlRequest($url);
            // dd($result);

            // $jsonResponse = json_decode($result, true);

            $response = json_decode($result);
             // Paste your provided response here

            // Split the response into sections based on "PARTY INFORMATION"
            $sections = explode("PARTY INFORMATION\n\n\n", $response);
            // dd($sections);

            if ($sections) {
                $caseInfoSection = $sections[0];
                $partyInfoSection = $sections[1];

                // Process the case information section
                $caseInfoLines = explode("\n", $caseInfoSection);
                // dd($caseInfoLines);
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

                $case_information=$resultArray['case_information'];


                    $line = $case_information['Case Number'];

                    $pattern = '/^(.*?)\s(.*)$/';
                    if (preg_match($pattern, $line, $matches)) {
                        $caseNumber = $matches[1];
                        $caseString = $matches[2];

                        echo "Case Number: " . $caseNumber . PHP_EOL;
                        echo "Case String: " . $caseString . PHP_EOL;
                    } else {
                        echo "Invalid line format.";
                    }






                    $tracker=new Tracker();
                    $tracker->case_number=$caseNumber;
                    $tracker->case_name=$caseString;
                    $last_update = Carbon::createFromFormat('m/d/Y', $case_information['Filing Date']);
                    $tracker->last_update=$last_update;
                    // dd(Auth::check());
                    $tracker->tracking='N/A';
                    $tracker->user_id = Auth::user()->id;
                    $tracker->save();

            } else {
                echo "Error: Unable to split the response into sections.";
            }
        // } catch (\Exception $e) {
        //     $data = [
        //         "status" => "401",
        //         "message" => $e->getMessage(),
        //         "Data" => null,
        //     ];
        //     $status = 401;
        // }

        return response()->json($data, $status);


    }
}
