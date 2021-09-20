<?php

namespace App\Services;
use Illuminate\Support\Carbon;

class Util
{
    public function getFormDateTime($datetime) {
        return Carbon::parse($datetime)->format('Y-m-d\TH:i');
    }

    public function getDisplayDateTime($datetime) {
        return Carbon::parse($datetime)->format('Y-m-d H:i');
    }

    public function getInitialDateTime() {
        return date('Y-m-d') . 'T00:00';
    }
}