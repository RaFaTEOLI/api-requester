<?php

namespace Tests\Unit;

use App\Services\CreateRequestService;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RequestTest extends TestCase
{
    use WithFaker;

    private function makeSut($method, $withHeaders = false)
    {
        $urlMethod = strtolower($method);
        $request = [
            "url" => "https://postman-echo.com/{$urlMethod}",
            "method" => $method,
            "body" => [
                "test" => $this->faker->word()
            ],
        ];

        if ($withHeaders) {
            $request["headers"] = [
                "Authorization" => $this->faker->word()
            ];
        }

        return $request;
    }

    /**
     * It should create a post request
     *
     * @return void
     */
    public function testShouldCreateAPostRequest()
    {
        $request = $this->makeSut("POST");

        $response = (new CreateRequestService())->execute($request);

        $this->assertTrue($response["data"] === $request["body"]);
        $this->assertTrue($response["url"] === $request["url"]);
    }

    /**
     * It should create a post request with headers
     *
     * @return void
     */
    public function testShouldCreateAPostRequestWithHeaders()
    {
        $request = $this->makeSut("POST", true);

        $response = (new CreateRequestService())->execute($request);

        $this->assertTrue($response["data"] === $request["body"]);
        $this->assertTrue($response["url"] === $request["url"]);
        $this->assertArrayHasKey("authorization", $response["headers"]);
        $this->assertTrue($response["headers"]["authorization"] === $request["headers"]["Authorization"]);
    }

    /**
     * It should create a get request
     *
     * @return void
     */
    public function testShouldCreateAGetRequest()
    {
        $request = $this->makeSut("GET");

        $response = (new CreateRequestService())->execute($request);

        $this->assertTrue($response["url"] === "{$request["url"]}?test={$request["body"]["test"]}");
    }

    /**
     * It should create a get request with headers
     *
     * @return void
     */
    public function testShouldCreateAGetRequestWithHeaders()
    {
        $request = $this->makeSut("GET", true);

        $response = (new CreateRequestService())->execute($request);

        $this->assertTrue($response["url"] === "{$request["url"]}?test={$request["body"]["test"]}");
        $this->assertArrayHasKey("authorization", $response["headers"]);
        $this->assertTrue($response["headers"]["authorization"] === $request["headers"]["Authorization"]);
    }

    /**
     * It should create a put request
     *
     * @return void
     */
    public function testShouldCreateAPutRequest()
    {
        $request = $this->makeSut("PUT");

        $response = (new CreateRequestService())->execute($request);

        $this->assertTrue($response["data"] === $request["body"]);
        $this->assertTrue($response["url"] === $request["url"]);
    }

    /**
     * It should create a put request with headers
     *
     * @return void
     */
    public function testShouldCreateAPutRequestWithHeaders()
    {
        $request = $this->makeSut("PUT", true);

        $response = (new CreateRequestService())->execute($request);

        $this->assertTrue($response["data"] === $request["body"]);
        $this->assertTrue($response["url"] === $request["url"]);
        $this->assertArrayHasKey("authorization", $response["headers"]);
        $this->assertTrue($response["headers"]["authorization"] === $request["headers"]["Authorization"]);
    }

    /**
     * It should create a patch request
     *
     * @return void
     */
    public function testShouldCreateAPatchRequest()
    {
        $request = $this->makeSut("PATCH");

        $response = (new CreateRequestService())->execute($request);

        $this->assertTrue($response["data"] === $request["body"]);
        $this->assertTrue($response["url"] === $request["url"]);
    }

    /**
     * It should create a patch request with headers
     *
     * @return void
     */
    public function testShouldCreateAPatchRequestWithHeaders()
    {
        $request = $this->makeSut("PATCH", true);

        $response = (new CreateRequestService())->execute($request);

        $this->assertTrue($response["data"] === $request["body"]);
        $this->assertTrue($response["url"] === $request["url"]);
        $this->assertArrayHasKey("authorization", $response["headers"]);
        $this->assertTrue($response["headers"]["authorization"] === $request["headers"]["Authorization"]);
    }

    /**
     * It should create a delete request
     *
     * @return void
     */
    public function testShouldCreateADeleteRequest()
    {
        $request = $this->makeSut("DELETE");

        $response = (new CreateRequestService())->execute($request);

        $this->assertTrue($response["data"] === $request["body"]);
        $this->assertTrue($response["url"] === $request["url"]);
    }

    /**
     * It should create a patch request with headers
     *
     * @return void
     */
    public function testShouldCreateADeleteRequestWithHeaders()
    {
        $request = $this->makeSut("DELETE", true);

        $response = (new CreateRequestService())->execute($request);

        $this->assertTrue($response["data"] === $request["body"]);
        $this->assertTrue($response["url"] === $request["url"]);
        $this->assertArrayHasKey("authorization", $response["headers"]);
        $this->assertTrue($response["headers"]["authorization"] === $request["headers"]["Authorization"]);
    }
}
