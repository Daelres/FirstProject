@extends('layouts.app')

@section('title','Decimal / Binario')

@section('content')
<div class="row justify-content-center">
  <div class="col-md-10 col-lg-8 col-xl-7">
    <div class="d-flex mb-3">
      <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-sm">&larr; Volver</a>
    </div>
    <div class="card shadow-sm">
      <div class="card-header">Conversor Decimal ↔ Binario</div>
      <div class="card-body">
        <form method="post" action="{{ route('binary.view') }}" class="row g-3">
          @csrf
          <div class="col-12">
            <div class="nav nav-pills mb-2">
              <button name="mode" value="toBinary" class="nav-link {{ $mode==='toBinary' ? 'active' : '' }}">Decimal a Binario</button>
              <button name="mode" value="toDecimal" class="nav-link {{ $mode==='toDecimal' ? 'active' : '' }} ms-2">Binario a Decimal</button>
            </div>
          </div>
          @if($mode==='toBinary')
            <div class="col-12">
              <label class="form-label">Decimal</label>
              <input type="number" name="decimal" class="form-control" value="{{ old('decimal') }}" min="0">
              <div class="form-text">Ingresa un entero no negativo.</div>
            </div>
          @else
            <div class="col-12">
              <label class="form-label">Binario</label>
              <input type="text" name="binary" class="form-control" value="{{ old('binary') }}" placeholder="Ej: 10101">
              <div class="form-text">Solo caracteres 0 y 1.</div>
            </div>
          @endif
          <div class="col-12">
            <button class="btn btn-warning">Convertir</button>
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
        @if($error)
          <div class="alert alert-warning mt-3">{{ $error }}</div>
        @endif
        @if(!is_null($result))
          <div class="alert alert-success mt-3">Resultado: <strong><span class="font-monospace">{{ $result }}</span></strong></div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection
