<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Account;
use Illuminate\Support\Facades\Log;


class UpdateAccountVisibility implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $account_id;
    /**
     * Create a new job instance.
     */
    public function __construct($account_id)
    {
        $this->account_id = $account_id;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        Log::info('UpdateAccountVisibility job started for account ID: ' . $this->account_id);

        $account = Account::find($this->account_id);

        if ($account) {
            $account->update(['visible' => 0]);
            Log::info('Account visibility updated to 0 for account ID: ' . $this->account_id);
        } else {
            Log::error("Account with ID {$this->account_id} not found.");
        }
    }

}
