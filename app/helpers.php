<?php

use App\Ad;
use App\User;

function getBuyerName($buyer_id)
{
    $user = User::find($buyer_id);
    if(auth()->user()->id == $user->id) {
        return "Vous";
    } else {
        return $user->name;
    }
}

function getAdName($user_id)
{
    $user = User::find($user_id);
    return $user->name;
}

function getAdTitle($ad_id)
{
    $ad = Ad::find($ad_id);
    return $ad->title;
}