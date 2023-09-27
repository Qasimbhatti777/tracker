<?php

namespace App\Traits;

trait MakesCurlRequest
{
    /**
     * Send a cURL request and return the response.
     *
     * @param string $url
     * @param array $options
     * @return mixed
     */


    public function makeCurlRequest($url, $options = [])
    {
        $ch = curl_init();

        // Set the cURL options
        foreach ($options as $option => $value) {
            curl_setopt($ch, $option, $value);
        }

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute the request
        $response = curl_exec($ch);

        // Check for cURL errors
        if (curl_errno($ch)) {
            $error = curl_error($ch);
            // Handle the error appropriately
        }

        // Close the cURL session
        curl_close($ch);

        // Return the response
        return $response;
    }
}
