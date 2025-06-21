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


/*
🔴 1- first:
In public channels everyone can connect/subscribe to that channel and get the data.

In private channels  only the users which have authorized to that channel can
subscribe - connect to that channel get the data

Ex: indirect messages or private chat in Instagram or WhatsApp not everyone can get the data of the chat

*/
Broadcast::channel('users.{id}', function ($user, $id) {
    return $user->id == $id;
});

/*
we always get the current authenticated user (the user who's trying to connect to this private channel)
and we also get any of the parameters that are passed in to the channel name Ex: $id

when we connect to this channel, we're going to replace out {id} with the ID of the
current authenticated user who is trying to connect to the channel.
=> let channel = window.Echo.private('users.1');    number 1 after dot will use instead of {id}

here we want to make sure that the ID of the user matches what we have passed in here.

*/


/*
🔴 3-
we can add more logics to check if we are allowed
to access to this channel or not
*/
Broadcast::channel('chat.room.{roomId}', function ($user, $roomId) {
    if (!$user->canAccessRoom($roomId)) {
        return false;
    }

    return true;
});
