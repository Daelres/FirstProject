@extends('layouts.app')

@section('title', 'Inicio')

@section('header')
  <div>
    <h1 class="h3 mb-1">Bienvenido</h1>
    <p class="lead mb-0">Explora las herramientas del taller</p>
  </div>
  <div class="mt-3 mt-md-0">
    <a href="{{ route('calculator.view') }}" class="btn btn-light btn-sm text-primary fw-semibold">Probar calculadora</a>
  </div>
@endsection

@section('content')
<div class="row g-4">
  <div class="col-12 col-lg-4">
    <div class="card h-100 shadow-sm">
      <div class="card-body">
        <h5 class="card-title">Calculadora</h5>
        <p class="card-text text-muted">Suma, resta, multiplica y divide con validación de entradas.</p>
        <a href="{{ route('calculator.view') }}" class="btn btn-primary">Ir a Calculadora</a>
      </div>
    </div>
  </div>
  <div class="col-12 col-lg-4">
    <div class="card h-100 shadow-sm">
      <div class="card-body">
        <h5 class="card-title">Conversor de Moneda</h5>
        <p class="card-text text-muted">Convierte entre USD, EUR, COP y MXN con tasas fijas.</p>
        <a href="{{ route('currency.view') }}" class="btn btn-success">Ir a Conversor</a>
      </div>
    </div>
  </div>
  <div class="col-12 col-lg-4">
    <div class="card h-100 shadow-sm">
      <div class="card-body">
        <h5 class="card-title">Decimal ↔ Binario</h5>
        <p class="card-text text-muted">Convierte números entre bases 10 y 2 fácilmente.</p>
        <a href="{{ route('binary.view') }}" class="btn btn-warning">Ir a Conversor</a>
      </div>
    </div>
  </div>
  <div class="col-12">
    <div class="card shadow-sm">
      <div class="card-body d-flex flex-column flex-md-row align-items-md-center justify-content-between">
        <div>
          <h5 class="card-title mb-1">Lista de Tareas</h5>
          <p class="card-text text-muted mb-0">Gestiona tus pendientes: agrega, completa, elimina o limpia todo.</p>
        </div>
        <a href="{{ route('todos.view') }}" class="btn btn-outline-dark mt-3 mt-md-0">Abrir Lista</a>
      </div>
    </div>
  </div>
</div>
@endsection
