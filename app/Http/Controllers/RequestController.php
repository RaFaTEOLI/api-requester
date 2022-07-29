<?php

namespace App\Http\Controllers;

use App\Http\Requests\MakeRequest;
use App\Services\CreateRequestService;
use Exception;

class RequestController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                "message" => "Hello, you can make your request by posting on the request endpoint",
                "allowedMethods" => ["POST", "GET", "PUT", "PATCH", "DELETE"],
                "example" => [
                    "url" => "https://some_url.com/",
                    "method" =>  "POST",
                    "body" =>  [
                        "test" =>  "Hello World!"
                    ],
                    "headers" =>  [
                        "Authorization" =>  "Bearer a8558705-70e1-46e7-ac2c-4079e1ed837d"
                    ]
                ]
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    public function store(MakeRequest $request)
    {
        try {
            $input = $request->only(["url", "method", "body", "headers"]);

            $response = (new CreateRequestService())->execute($input);

            return response()->json($response);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage()], 500);
        }
    }
}
