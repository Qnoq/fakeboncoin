@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-left">
        <div class="col-md-8">
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
            <h1>Fake BonCoin</h1>
            <form class="mb-5" action="{{ route('ads.search') }}" onsubmit="search(event)">
                @csrf
                <div class="input-group">
                    <input type="search" name="query" class="form-control rounded" placeholder="Rechercher" aria-label="Rechercher"
                    aria-describedby="search-addon"/>
                    <button type="submit" class="btn btn-outline-primary">Rechercher</button>
                </div>
            </form>
            <div id="results">
                @foreach ($ads as $ad)
                <div class="card mb-3" style="width: 100%;">
                    @if ($ad->image)
                        <img class="card-img-top" src="{{ asset('storage/' .$ad->image) }}" alt="image">
                    @endif
                    <div class="card-body">
                        <div class="d-flex">
                            <h5 class="card-title">{{ $ad->title }}</h5>
                            <h3 class="ml-auto">{{ $ad->price }}€</h3>
                        </div>
                            <small>{{ Carbon\Carbon::parse($ad->created_at)->diffForHumans() }}</small>
                            <p class="card-text text-info">{{ $ad->localisation }}</p>
                            <p class="card-text">{{ $ad->description }}</p>
                            <p class="card-text">De {{ getAdName($ad->user_id) }}</p>
                            <a href="{{ route('message.create', ['seller_id' => $ad->user_id, 'ad_id' => $ad->id]) }}" class="btn btn-primary">Contacter le vendeur</a>
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