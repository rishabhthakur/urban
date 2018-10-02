<?php

use Urban\Settings;

function getNotifications() {
    return Auth::user()->unreadNotifications;
}

function getUnreadMessages() {
    return Auth::user()->unreadNotifications->where('type', 'Urban\Notifications\NewMessage');
}

function getSettings() {
    return Settings::first();
}
