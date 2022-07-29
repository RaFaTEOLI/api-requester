<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CreateRequestService
{
    public function execute($params)
    {
        $reqParams = $this->buildRequest($params);
        $method = $reqParams["method"];


        if (!empty($params["headers"])) {
            $response = Http::withHeaders($params["headers"])->$method($reqParams["url"], $reqParams["body"]);
        } else {
            $response = Http::$method($reqParams["url"], $reqParams["body"]);
        }

        if (empty($response)) {
            return ["message" => "No API call was made"];
        }

        return $response->json();
    }

    private function buildRequest($params)
    {
        return ["url" => $params["url"], "method" => strtolower($params["method"]), "body" => $params["body"] ?? []];
    }
}
