<?php

use Carbon\Carbon;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schedule;

// Artisan::command('inspire', function () {
//     $this->comment(Inspiring::quote());
// })->purpose('Display an inspiring quote')->everyFifteenSeconds();

Schedule::call(function () {
    DB::table('listings')->where('status', 'reserved')
        ->where('updated_at', '<', Carbon::now()->subMinutes(3))
        ->update([
            'status' => 'available',
            'updated_at' => Carbon::now(),
        ]);
})->everyTwoMinutes();
