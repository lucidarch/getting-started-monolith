<?php

namespace App\Domains\Http\Jobs;

use Lucid\Units\Job;

class RedirectBackJob extends Job
{
    /**
     * @var bool
     */
    private $withInput;

    /**
     * Create a new job instance.
     *
     * @param bool $withInput
     */
    public function __construct($withInput = false)
    {
        $this->withInput = $withInput;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $back = back();

        if ($this->withInput) {
            $back->withInput();
        }

        return $back;
    }
}
