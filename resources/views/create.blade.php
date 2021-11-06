@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Déposer une annonce</h1>
        <hr>
        <form method="POST" action="{{ route('ad.store') }}" enctype="multipart/form-data">
          @csrf
            <div class="form-group">
              <label for="title">Titre de l'annonce</label>
              <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" id="title" aria-describedby="title" name="title">
              @if ($errors->has('title'))
                <span class="invalid-feedback">{{ $errors->first('title') }}</span>
              @endif
            </div>
            <div class="form-group">
              <div class="custom-file">
                <input type="file" name="image" class="custom-file-input {{ $errors->has('image') ? 'is-invalid' : '' }}" id="validatedCustomFile">
                <label class="custom-file-label" for="validatedCustomFile">Choisir une image</label>
                @if ($errors->has('image'))
                  <span class="invalid-feedback">{{ $errors->first('image') }}</span>
                @endif
              </div>
            </div>
            <div class="form-group">
              <label for="description">Description de l'annonce</label>
             <textarea name="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" id="title" id="description" cols="30" rows="10"></textarea>
             @if ($errors->has('description'))
               <span class="invalid-feedback">{{ $errors->first('description') }}</span>
             @endif
            </div>
            <div class="form-group">
              <label for="localisation">Localisation</label>
              <input type="text" class="form-control {{ $errors->has('localisation') ? 'is-invalid' : '' }}" id="localisation" name="localisation">
              @if ($errors->has('localisation'))
                <span class="invalid-feedback">{{ $errors->first('localisation') }}</span>
              @endif
            </div>
            <div class="form-group">
              <label for="price">Prix</label>
              <input type="number" class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" id="price" name="price">
              @if ($errors->has('price'))
                <span class="invalid-feedback">{{ $errors->first('price') }}</span>
              @endif
            </div>
            @guest
                <div class="card mb-3">
                  <div class="card-header">Inscrivez-vous pour pouvoir poster une annonce</div>
  
                  <div class="card-body">
  
                          <div class="form-group row">
                              <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
  
                              <div class="col-md-6">
                                  <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
  
                                  @if ($errors->has('name'))
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('name') }}</strong>
                                      </span>
                                  @endif
                              </div>
                          </div>
  
                          <div class="form-group row">
                              <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
  
                              <div class="col-md-6">
                                  <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
  
                                  @if ($errors->has('email'))
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('email') }}</strong>
                                      </span>
                                  @endif
                              </div>
                          </div>
  
                          <div class="form-group row">
                              <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
  
                              <div class="col-md-6">
                                  <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
  
                                  @if ($errors->has('password'))
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('password') }}</strong>
                                      </span>
                                  @endif
                              </div>
                          </div>
  
                          <div class="form-group row">
                              <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
  
                              <div class="col-md-6">
                                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                              </div>
                          </div>
                  </div>
              </div>
            @endguest
            <button type="submit" class="btn btn-primary">Soumettre le formulaire</button>
        </form>
    </div>
@endsection