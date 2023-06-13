
@extends('layout')

@section('content')

    <h1>{{ $title }}</h1>
    <hr>

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            Lūdzu, novērsiet radušās kļūdas!
        </div>
    @endif

    <form method="post" action="{{ $genres->exists ? '/genres/patch/' . $genre->id : '/genres/put' }}">
        @csrf

        <div class="mb-3">
            <label for="genres-name" class="form-label">Žanra nosaukums</label>

            <input 
                type="text" 
                id="genres-name" 
                name="name"
                class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $genres->name) }}"
            >

            @error('name')
                <p class="invalid-feedback">{{ $errors->first('name') }}</p>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">{{ $genres->exists ? 'Atjaunot' : 'Pievienot' }}</button>

    </form>

@endsection
