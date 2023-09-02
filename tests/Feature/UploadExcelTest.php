<?php

namespace Tests\Feature;

use App\Http\Middleware\BasicAuth;
use App\Jobs\ParseExcelJob;
use App\Models\ApiToken;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Request;
use Tests\TestCase;

class UploadExcelTest extends TestCase
{

    public function testBasic()
    {
        $apiKey = ApiToken::find(1)->token;
        $request = Request::create('/excel/upload', 'POST', ['file' => asset('test.xlsx')]);
        $request->headers->set('Authorization', $apiKey);

        $response = $this->app->handle($request);
        $this->assertEquals(200, $response->getStatusCode());
        Queue::assertPushed(ParseExcelJob::class);
    }
}
