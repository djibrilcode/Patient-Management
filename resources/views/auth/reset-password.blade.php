@extends('layouts.app')

@section('content')
<div class="container py-5" style="max-width: 450px;">
    <h3 class="mb-4 text-center">Nouveau mot de passe</h3>

    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="mb-3">
            <label for="email" class="form-label">Adresse email</label>
            <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" required autofocus>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Nouveau mot de passe</label>
            <input type="password" class="form-control" name="password" id="password" required>
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmer mot de passe</label>
            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" required>
        </div>

        <button type="submit" class="btn btn-success w-100">Réinitialiser le mot de passe</button>
    </form>
</div>
@endsection
