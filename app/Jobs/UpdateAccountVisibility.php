<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Account;

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

        // Trova l'account usando l'ID.
        $account = Account::find($this->account_id);

        // Controlla se l'account esiste prima di tentare di aggiornarlo.
        if ($account) {
            $account->update(['visible' => 0]);
        } else {
            \Log::error("Account con ID {$this->account_id} non trovato.");
        }
    }
}
