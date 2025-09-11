@extends('layouts.app')

@section('title', 'Calculadora')

@section('header')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb mb-2">
      <li class="breadcrumb-item"><a class="text-white text-decoration-underline" href="{{ route('home') }}">Inicio</a></li>
      <li class="breadcrumb-item active text-white-50" aria-current="page">Calculadora</li>
    </ol>
  </nav>
  <h1 class="h3 mb-0">Calculadora</h1>
  <p class="lead mb-0">Suma, resta, multiplica y divide rápidamente</p>
@endsection

@section('content')
<div class="row justify-content-center">
  <div class="col-md-10 col-lg-8 col-xl-7">
    <div class="d-flex mb-3">
      <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-sm">&larr; Volver</a>
    </div>
    <div class="card shadow-sm">
      <div class="card-header">Calculadora</div>
      <div class="card-body">
        <form method="post" action="{{ route('calculator.view') }}" class="row g-3 align-items-end">
          @csrf
          <div class="col-12 col-md-4">
            <label class="form-label">Valor 1</label>
            <div class="input-group">
              <span class="input-group-text">A</span>
              <input type="number" class="form-control" name="a" placeholder="0" value="{{ $old['a'] ?? old('a') }}">
            </div>
          </div>
          <div class="col-12 col-md-4">
            <label class="form-label">Operación</label>
            <div class="btn-group w-100" role="group">
              <input type="radio" class="btn-check" name="op" id="op-sum" value="sum" {{ (($old['op'] ?? old('op'))==='sum')?'checked':'' }}>
              <label class="btn btn-outline-primary" for="op-sum">+
                <span class="visually-hidden">Suma</span></label>
              <input type="radio" class="btn-check" name="op" id="op-sub" value="sub" {{ (($old['op'] ?? old('op'))==='sub')?'checked':'' }}>
              <label class="btn btn-outline-primary" for="op-sub">−
                <span class="visually-hidden">Resta</span></label>
              <input type="radio" class="btn-check" name="op" id="op-mul" value="mul" {{ (($old['op'] ?? old('op'))==='mul')?'checked':'' }}>
              <label class="btn btn-outline-primary" for="op-mul">×
                <span class="visually-hidden">Multiplicación</span></label>
              <input type="radio" class="btn-check" name="op" id="op-div" value="div" {{ (($old['op'] ?? old('op'))==='div')?'checked':'' }}>
              <label class="btn btn-outline-primary" for="op-div">÷
                <span class="visually-hidden">División</span></label>
            </div>
          </div>
          <div class="col-12 col-md-4">
            <label class="form-label">Valor 2</label>
            <div class="input-group">
              <span class="input-group-text">B</span>
              <input type="number" class="form-control" name="b" placeholder="0" value="{{ $old['b'] ?? old('b') }}">
            </div>
          </div>
          <div class="col-12">
            <button class="btn btn-primary">Calcular</button>
          </div>
        </form>
        @if ($errors->any())
          <div class="alert alert-danger mt-3 alert-dismissible fade show" role="alert">
            <ul class="mb-0">
              @foreach ($errors->all() as $e)
                <li>{{ $e }}</li>
              @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
        @if(isset($error) && $error)
          <div class="alert alert-warning mt-3">{{ $error }}</div>
        @endif
        @if(!is_null($result ?? null))
          <div class="alert alert-success mt-3">Resultado: <strong>{{ $result }}</strong></div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection
