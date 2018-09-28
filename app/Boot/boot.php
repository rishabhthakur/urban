<?php

use App\Settings;

function getNotifications() {
    return Auth::user()->unreadNotifications;
}

function getUnreadMessages() {
    return Auth::user()->unreadNotifications->where('type', 'App\Notifications\NewMessage');
}

function getSettings() {
    return Settings::first();
}
