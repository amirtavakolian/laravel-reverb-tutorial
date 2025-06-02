<?php

use Illuminate\Support\Facades\Broadcast;

//  🔴 1- first read this file

/*

dont forget to run => npm run dev & php artisan reverb:start

let's create a broadcast channel and broadcast an event
that happens in our app to that channel.

open channels.php file:
Let's say that we're building a global chat application that anyone can join
without needing to be authenticated.
So it's just a public channel that anyone can listen into.

*/

Broadcast::channel('chat', function ($user) {
    // Update the chat channel authorization
    // we don't need any user here because we're using a public channel
});

/*
now we want to broadcast to this channel 👆

We'll always get the current user who is trying to authenticate for this channel
with $user parameter of the clouser 👇

Broadcast::channel('chat', function ($user){

});

but in our case, we have a public channel => so we don't need any user.

So we just define the channel out like above with nothing inside that at all.
let's broadcast an event to this channel

------------------------------------

you can have events and listeners in your app without broadcasting them,
but event can broadcast things if you tell them that you want them to broadcast something

create an event => php artisan make:event Example

*/
