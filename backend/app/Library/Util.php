<?php

namespace App\Services;
use Illuminate\Support\Carbon;

class Util
{
    public function getFormDatetime($datetime) {
        return Carbon::parse($datetime)->format('Y-m-d\TH:i');
    }

    public function getDisplayDatetime($datetime) {
        return Carbon::parse($datetime)->format('Y/m/d H:i');
    }

    public function getInitialDatetime() {
        return date('Y-m-d') . 'T00:00';
    }

    public function fixStart($start, $end)
    {
        if($start > $end) $start = $end;
        return $start;
    }

    public function fixEnd($start, $end)
    {
        if($start > $end) $end = $start;
        return $end;
    }
}