@extends('layouts.app')

@section('title','Conversor de Moneda')

@section('content')
<div class="row justify-content-center">
  <div class="col-md-10 col-lg-8 col-xl-7">
    <div class="d-flex mb-3">
      <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-sm">&larr; Volver</a>
    </div>
    <div class="card shadow-sm">
      <div class="card-header">Conversor de Moneda</div>
      <div class="card-body">
        <form method="post" action="{{ route('currency.view') }}" class="row g-3">
          @csrf
          <div class="col-12 col-md-6">
            <label class="form-label">Monto</label>
            <div class="input-group">
              <span class="input-group-text">$</span>
              <input type="number" step="any" name="amount" class="form-control" value="{{ old('amount') }}" placeholder="0.00">
            </div>
          </div>
          <div class="col-6 col-md-3">
            <label class="form-label">De</label>
            <select name="from" class="form-select">
              @foreach($rates as $code => $rate)
                <option value="{{ $code }}" {{ old('from')===$code ? 'selected' : '' }}>{{ $code }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-6 col-md-3">
            <label class="form-label">A</label>
            <select name="to" class="form-select">
              @foreach($rates as $code => $rate)
                <option value="{{ $code }}" {{ old('to')===$code ? 'selected' : '' }}>{{ $code }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-12">
            <button class="btn btn-success">Convertir</button>
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
        @if(!is_null($output))
          <div class="alert alert-success mt-3">Resultado: <strong>{{ number_format($output, 4) }}</strong></div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection
