@extends('layouts.app')

@section('content')
<div class="container">
    <!--Header-->
<div class="w-full m-0 p-0 bg-cover bg-bottom" style="background-image:url('cover.jpg'); height: 10vh; max-height:460px;">
</div>

    <div class="row justify-content-left">
        <div class="col-md-8">
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
            <form class="mb-5" action="{{ route('ads.search') }}" onsubmit="search(event)">
                @csrf
                <div class="input-group">
                    <input type="search" name="query" class="form-control rounded" placeholder="Rechercher" aria-label="Rechercher"
                    aria-describedby="search-addon" />
                    <button type="submit" class="btn btn-outline-primary">Rechercher</button>
                </div>
            </form>
            <div>
                @if ($empty)
                    <div class="flex justify-center">
    
                    <div class="bg-gray-800 text-white font-bold rounded-lg border shadow-lg p-10">
                        Désolé votre recherche n'a donnée aucun résultat.
                    </div>
                    
                  </div>
                @endif  
                @foreach ($ads as $ad)
                <div class="flex h-full bg-white rounded overflow-hidden shadow-lg mb-5">
                    <div class="w-full md:w-2/3 rounded-t">	
                        <img src="{{ asset('storage/' .$ad->image) }}" class="h-full w-full shadow">
                    </div>

                    <div class="w-full md:w-1/3 flex flex-col flex-grow flex-shrink">
                        <div class="flex-1 bg-white rounded-t rounded-b-none overflow-hidden shadow-lg">
                            <p class="w-full text-gray-600 text-xs md:text-sm pt-6 px-6">De {{ getAdName($ad->user_id) }} <a href="{{ route('message.create', ['seller_id' => $ad->user_id, 'ad_id' => $ad->id]) }}"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg></a></p>
                            <div class="w-full font-bold text-xl text-gray-900 px-6">{{ $ad->title }}</div>
                            <p class="text-gray-800 font-serif text-base px-6 mb-5">
                                {{ $ad->description }}
                            </p>
                        </div>

                        <div class="flex-none mt-auto bg-white rounded-b rounded-t-none overflow-hidden shadow-lg p-6">
                            <div class="flex items-center justify-between">
                                <h6 class="text-purple-700">{{ $ad->price }}€</h6>
                                <p class="text-gray-600 text-xs md:text-sm">{{ Carbon\Carbon::parse($ad->created_at)->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
            {{ $ads->links() }}
        </div>
        @if(Auth::check())
            <div class="col-md-4">
                <h1>Messages</h1>
                @foreach ($messages as $message)
                    @if ($message->buyer_id !== auth()->user()->id)
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                            <h6 class="card-subtitle mb-2 text-muted"><small>Message de {{ getBuyerName($message->buyer_id) }} pour l'annonce {{ getAdTitle($message->ad_id) }}</small></h6>
                            <p class="card-text">{{ $message->content }}</p>
                            <a href="{{ route('message.create', ['seller_id' => $ad->user_id, 'ad_id' => $ad->id]) }}" class="card-link">Répondre au message</a>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection