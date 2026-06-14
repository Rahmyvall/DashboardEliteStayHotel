<?php

namespace App\Observers;

use App\Models\CheckinCheckout;

class CheckinCheckoutObserver
{
    /**
     * Handle the CheckinCheckout "creating" event.
     */
    public function creating(CheckinCheckout $checkinCheckout): void
    {
        if (auth()->check()) {
            $checkinCheckout->created_by = auth()->id();
        }
    }

    /**
     * Handle the CheckinCheckout "updating" event.
     */
    public function updating(CheckinCheckout $checkinCheckout): void
    {
        // Auto set checked_in_by ketika check-in dilakukan
        if ($checkinCheckout->isDirty('waktu_checkin_aktual') && $checkinCheckout->waktu_checkin_aktual) {
            if (auth()->check()) {
                $checkinCheckout->checked_in_by = auth()->id();
            }
            if ($checkinCheckout->status === 'pending') {
                $checkinCheckout->status = 'checked_in';
            }
        }

        // Auto set checked_out_by dan status ketika check-out dilakukan
        if ($checkinCheckout->isDirty('waktu_checkout_aktual') && $checkinCheckout->waktu_checkout_aktual) {
            if (auth()->check()) {
                $checkinCheckout->checked_out_by = auth()->id();
            }

            $checkinCheckout->status = $checkinCheckout->is_late_checkout
                ? 'late_checkout'
                : 'checked_out';
        }
    }

    /**
     * Handle the CheckinCheckout "created" event.
     */
    public function created(CheckinCheckout $checkinCheckout): void
    {
        // Bisa tambahkan logic lain (misal kirim notifikasi)
    }
}