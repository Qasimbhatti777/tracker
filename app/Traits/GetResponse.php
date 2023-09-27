<?php
namespace App\Traits;

use Carbon\Carbon;
use app\Service\UserService;

trait GetResponse
{
    protected $base_uri;
    public function get_response($endpoint){


        try {
            $response = Http::get( $this->$endpoint);

            if ($response->successful()) {
                return $response->body();
            } else {
                return "Request was not successful. Status code: " . $response->status();
            }
        } catch (\Exception $e) {
            return "An error occurred: " . $e->getMessage();
        }


    }

    public function getDateFromString($string, $format = 'm/d/Y')
    {
        if (preg_match("/(\d{2}\/\d{2}\/\d{4})/", $string, $matches)) {
            $dateString = $matches[1];
            $carbon_date= Carbon::createFromFormat($format, $dateString);
            return $carbon_date->toDateString();

        }

        return null;
    }
}
