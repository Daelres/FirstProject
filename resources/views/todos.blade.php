@extends('layouts.app')

@section('title','Lista de Tareas')

@section('content')
<div class="row justify-content-center">
  <div class="col-md-10 col-lg-8 col-xl-7">
    <div class="d-flex mb-3">
      <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-sm">&larr; Volver</a>
    </div>
    <div class="card shadow-sm">
      <div class="card-header d-flex justify-content-between align-items-center">
        <span>Lista de Tareas</span>
        @php $total = count($todos); $done = collect($todos)->where('done', true)->count(); $pct = $total ? intval($done*100/$total) : 0; @endphp
      </div>
      <div class="card-body">
        @if($total)
          <div class="mb-3">
            <div class="d-flex justify-content-between small mb-1"><span>Progreso</span><span>{{ $pct }}%</span></div>
            <div class="progress" style="height:8px;">
              <div class="progress-bar bg-success" role="progressbar" style="width: {{ $pct }}%" aria-valuenow="{{ $pct }}" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
        @endif
        <form method="post" action="{{ route('todos.view') }}" class="d-flex gap-2">
          @csrf
          <input type="hidden" name="action" value="add">
          <input type="text" name="title" class="form-control" placeholder="Nueva tarea">
          <button class="btn btn-primary">Agregar</button>
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
        <ul class="list-group mt-3">
          @forelse($todos as $i => $t)
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <div class="form-check">
                <form method="post" action="{{ route('todos.view') }}">
                  @csrf
                  <input type="hidden" name="action" value="toggle">
                  <input type="hidden" name="index" value="{{ $i }}">
                  <input class="form-check-input" type="checkbox" id="todo-{{ $i }}" onchange="this.form.submit()" {{ $t['done'] ? 'checked' : '' }}>
                  <label class="form-check-label ms-2 {{ $t['done'] ? 'text-decoration-line-through text-muted' : '' }}" for="todo-{{ $i }}">{{ $t['title'] }}</label>
                </form>
              </div>
              <form method="post" action="{{ route('todos.view') }}">
                @csrf
                <input type="hidden" name="action" value="delete">
                <input type="hidden" name="index" value="{{ $i }}">
                <button class="btn btn-sm btn-outline-danger">Eliminar</button>
              </form>
            </li>
          @empty
            <li class="list-group-item text-muted">No hay tareas, agrega una arriba.</li>
          @endforelse
        </ul>
        @if(count($todos) > 0)
          <form method="post" action="{{ route('todos.view') }}" class="mt-3">
            @csrf
            <input type="hidden" name="action" value="clear">
            <button class="btn btn-sm btn-outline-warning">Limpiar todo</button>
          </form>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection
