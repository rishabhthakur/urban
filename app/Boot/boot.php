<?php

use App\Settings;

function getNotifications() {
    return Auth::user()->unreadNotifications;
}

function getSettings() {
    return Settings::first();
}
