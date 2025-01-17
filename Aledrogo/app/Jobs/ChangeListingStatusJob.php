<?php

namespace App\Jobs;

use App\Models\Listing;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;

class ChangeListingStatusJob implements ShouldQueue
{
    use Queueable;

    public $listingId;

    /**
     * Create a new job instance.
     */
    public function __construct($listingId)
    {
        $this->listingId = $listingId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Fetch the listing and change its status to 'available'
        $listing = Listing::find($this->listingId);

        if ($listing && $listing->status === 'reserved' || $listing->status === 'pending') {
            DB::table('listings')->where('id', $this->listingId)->update(['status' => 'available']);
            DB::table('transactions')->where('id', $listing->transaction->id)->update(['status' => 'CANCELLED']);
        }
    }
}
