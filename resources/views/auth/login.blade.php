@extends('layouts.guest')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-xl-5 col-lg-6 col-md-7 mx-auto mt-5">
      <div class="card radius-10">
        <div class="card-body p-4">
          <div class="text-center">
            <h4>Iniciar Sesión</h4>
          </div>

          {{-- Mostrar mensaje de error general --}}
          @if(session('error'))
            <div class="alert alert-danger">
              {{ session('error') }}
            </div>
          @endif

          <form class="form-body row g-3" action="{{ route('login') }}" method="POST">
            @csrf

            {{-- Correo --}}
            <div class="col-12">
              <label for="inputEmail" class="form-label">Correo</label>
              <input 
                type="email" 
                class="form-control @error('email') is-invalid @enderror" 
                id="inputEmail" 
                name="email" 
                value="{{ old('email') }}" 
                required
              >
              @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>

            {{-- Contraseña --}}
            <div class="col-12">
              <label for="inputPassword" class="form-label">Contraseña</label>
              <input 
                type="password" 
                class="form-control @error('password') is-invalid @enderror" 
                id="inputPassword" 
                name="password" 
                required
              >
              @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>

            {{-- Términos y Condiciones --}}
            <div class="col-12">
              <div class="form-check">
                <input 
                  class="form-check-input" 
                  type="checkbox" 
                  value="1" 
                  id="flexCheckChecked" 
                  name="terms" 
                  {{ old('terms') ? 'checked' : '' }} 
                  required
                >
                <label class="form-check-label" for="flexCheckChecked">
                  Acepto los Términos y Condiciones
                </label>
              </div>
              @error('terms')
                <span class="text-danger">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>

            {{-- Botón de login --}}
            <div class="col-12">
              <div class="d-grid">
                <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
