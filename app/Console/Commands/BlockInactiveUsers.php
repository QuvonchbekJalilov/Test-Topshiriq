<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Laravel\Sanctum\PersonalAccessToken;

class BlockInactiveUsers extends Command
{
    protected $signature = 'user:block-inactive';
    protected $description = 'Block users who haven\'t logged in for 3 days';

    public function handle()
    {
        $date = Carbon::now()->subDays(3);
        $inactiveTokens = PersonalAccessToken::where('last_used_at', '<', $date)->get();
        
        foreach ($inactiveTokens as $token) {
            $user = $token->tokenable;
            if ($user && ! $user->is_blocked) {
                $user->update(['is_blocked' => true]);
            }
        }

        $this->info(count($inactiveTokens) . ' users have been blocked due to inactivity.');
    }
}
