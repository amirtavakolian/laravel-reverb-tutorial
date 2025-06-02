<?php

use App\Events\Example;
use Illuminate\Auth\GenericUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Models\User;

#  🔴 3- read this file now

Route::get('/broadcast', function () {

    // in /broadcast, we listen for 'Example' event
    // you can also listen for 'Example' event from anywhere in your application.

    // you can listen for the events with javascript, livewire, apline or...

    // you can check the console to see the result of the event (for getting the data of that event)
    // which get broadcast

    // ========================================================

    // event(new \App\Events\Example());
    // we normally dispatch using event helper

    // for broadcasting an event to our reverb server that we have configured,
    // we use broadcast helper

    // Example event will broadcast to 'chat' channel

    // the data that we want to broadcast is a string
    // and the data about the user with id 1
    // in a chat app, you can send the data of the messages that users send to each-other

    broadcast(new Example("Someone Joined 😜" . now()->toTimeString(), User::find(1)));
    return view('broadcast');

})->name('broadcast');

// you can even dispatch the event from below method in the controller:
Route::get('/test', [TestController::class, 'test']);


Route::get('/login', function () {
    $user = User::find(1);
    Auth::login($user);
    return redirect()->route('broadcast');
})->name('login');

Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('broadcast');
})->name('logout');
