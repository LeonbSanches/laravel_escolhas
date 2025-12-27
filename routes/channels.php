<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

// Canal público para escolhas (dashboard público)
Broadcast::channel('escolhas', function () {
    return true; // Canal público, todos podem escutar
});
