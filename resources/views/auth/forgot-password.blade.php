@extends('layouts.app')

@section('content')
<div class="container py-5" style="max-width: 450px;">
    <h3 class="mb-4 text-center">Réinitialiser le mot de passe</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Adresse email</label>
            <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" required autofocus>
        </div>

        <button type="submit" class="btn btn-success w-100">Envoyer le lien de réinitialisation</button>
    </form>
</div>
@endsection
