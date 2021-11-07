<?php

use App\Ad;
use App\User;
use Illuminate\Support\Facades\Auth;

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
    if(Auth::check())
    {
        if(auth()->user()->id == $user->id) {
            return "Vous";
        } else {
            return $user->name;
        }
    } else {
        return $user->name;
    }
}

function getAdTitle($ad_id)
{
    $ad = Ad::find($ad_id);
    return $ad->title;
}

function getSellerName($seller_id)
{
    $user = User::find($seller_id);
    if(auth()->user()->id == $user->id) {
        return "Vous";
    } else {
        return $user->name;
    }
}