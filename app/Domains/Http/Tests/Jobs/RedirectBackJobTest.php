<?php

namespace App\Domains\Http\Tests\Jobs;

use Illuminate\Http\RedirectResponse;
use App\Domains\Http\Jobs\RedirectBackJob;
use Tests\TestCase;

class RedirectBackJobTest extends TestCase
{
    public function test_redirect_back_job()
    {
        $job = new RedirectBackJob();

        $response = $job->handle();

        $this->assertInstanceOf(RedirectResponse::class, $response);
    }
}
