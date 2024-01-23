<?php

use App\Models\AdminAccess;
use Illuminate\Support\Facades\Auth;

function userAccess($text)
{
    $status = false;
    if (Auth::guard('admin')->user()->role != 'Superadmin' && Auth::guard('admin')->user()->role != 'admin') {
        $access = AdminAccess::where('admin_id', Auth::guard('admin')->user()->id)
            ->pluck('permissions')
            ->toArray();

        if (in_array($text, $access)) {
            $status = true;
        } else {
            $status = false;
        }
    } else {
        $status = true;
    }

    return $status;
}
