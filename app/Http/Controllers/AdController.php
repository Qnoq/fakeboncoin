<?php

namespace App\Http\Controllers;

use App\Ad;
use App\Http\Requests\AdStore;
use App\Message;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdController extends Controller
{
    use RegistersUsers;

    //
    public function index()
    {
        $ads = DB::table('ads')->orderBy('created_at', 'DESC')->paginate(6);
        if(Auth::check()) {
            $messages = Message::where('seller_id', "=", auth()->user()->id)->get();
        } else {
            $messages = '';
        }

        return view('ads', compact('ads', 'messages'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(AdStore $request)
    {
        $validated = $request->validated();

        if(!Auth::check()) {
            $request->validate([
                'name' => 'required|unique:users',
                'email' => 'required|email|unique:users',
                'password' => 'required|confirmed',
                'password_confirmation' => 'required',
                'image' => 'sometimes|image|max:2000'
            ]);

            $user = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
            ]);

            $this->guard()->login($user);
        }

        $imageName = $request->image->store('images', 'public');

        $ad = new Ad();
        $ad->title = $validated['title'];
        $ad->image = $imageName;
        $ad->description = $validated['description'];
        $ad->price = $validated['price'];
        $ad->localisation = $validated['localisation'];
        $ad->user_id = auth()->user()->id;
        $ad->save();

        return redirect()->route('ad.index')->with('success', 'Votre annonce a été postée.');
    }

    public function search(Request $request)
    {
        $empty = False;
        $query = request()->input('query');

        if(Auth::check()) {
            $messages = Message::where('seller_id', "=", auth()->user()->id)->get();
        } else {
            $messages = '';
        }
        
        $ads = Ad::where('title', 'like', "%$query%")
            ->orWhere('description', 'like', "%$query%")
            ->paginate(5);
        
        if($ads->isEmpty())
        {
            $empty = True;
        }

        return view('search', compact('ads', 'messages', 'empty'));
    }
}
