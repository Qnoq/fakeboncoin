@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Contacter le vendeur</h1>
        @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
        @endif
        @foreach ($messages as $message)
        @if ($message->ad_id == $ad_id)
            <div class="card" style="width: 100%;">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">{{ $message->content }} <br><small>Envoyé par {{ getBuyerName($message->buyer_id) }} pour l'annonce {{ getAdTitle($message->ad_id) }}</small></li>
                </ul>
            </div>
        @endif
        @endforeach
        <form action="{{ route('message.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="content">Votre message</label>
                <textarea name="content" id="content" cols="30" rows="10" class="form-control"></textarea>
            </div>
            <input type="hidden" name="seller_id" value="{{ $seller_id }}">
            <input type="hidden" name="ad_id" value="{{ $ad_id }}">
            <input type="hidden" name="buyer_id" value="{{ auth()->user()->id }}">
            <button type="submit" class="btn btn-success">Envoyer</button>
        </form>
    </div>
@endsection