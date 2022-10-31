@extends('layouts.main')

@section('title', 'Welcome')

<style>
    table tbody tr {
        vertical-align: middle;
    }

    table tbody tr td {
        height: 70px;
    }

    .barra {
      width: 100%;
      margin: 5px auto;
      height: 30px;
      border-radius: 10px;
      border: 1px black solid;
      background-color: #eee;
      padding: 5px;
      line-height: 30px;
    }
    .barra div {
      background-color: #0d6efd;
      width: 0%;
      height: 100%;
      border-radius: 10px;
    }
  </style>

@section('content')

    <nav-bar></nav-bar>

    @guest
        <form-user></form-user>
    @endguest

    @auth
        <form-search></form-search>

        @if ($search)
            @if (count($checks) != 0)
                <div class="container col-md-12">
                    <table class="table table-striped m-auto" >
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome do checklist</th>
                            <th scope="col" colspan="3">Ações</th>
                            <th scope="col">Progresso</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($checks as $check)
                            <tr>
                                <td scope="row">{{ $check->id }}</td>
                                <td scope="row">{{ $check->checklist_name }}</td>
                                <td scope="row" >
                                    <a href="/tasks/{{ $check->id }}">
                                        <button class="btn btn-primary">Ver tarefas</button>
                                    </a>
                                </td>
                                <td scope="row">
                                    <a href="{{ route('edit_checklist', ['id' => $check->id]) }}">
                                        <button class="btn btn-secondary">Editar</button>
                                    </a> 
                                </td>
                                <td scope="row">
                                    <delete-button
                                    id_form="{{ $check->id }}"
                                    name_form="{{ $check->checklist_name }}"
                                    type_form="checklist"
                                    ></delete-button>
                                </td>
                                <td>
                                    <div class="barra">
                                        <div style="width: {{ $check->progress }}%"></div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="my-auto mx-5 w-5 text-center">
                    Buscando por: {{ $search }} <br>
                    <a href="/">Limpar filtro</a>
                </div>
                <br>
            @else
                <h1>Não existem checklists com esse nome</h1>
            @endif
        
        @else
        
            @if (count($checks) > 0)
                <div class="container col-md-12">
                    <table class="table table-striped m-auto" >
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome do checklist</th>
                            <th scope="col" colspan="3">Ações</th>
                            <th scope="col">Progresso</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($checks as $check)
                            <tr>
                                <td scope="row">{{ $check->id }}</td>
                                <td scope="row">{{ $check->checklist_name }}</td>
                                <td scope="row">
                                    <a href="/tasks/{{ $check->id }}">
                                        <button class="btn btn-primary">Ver tarefas</button>
                                    </a>
                                </td>
                                <td scope="row" >
                                    <a href="{{ route('edit_checklist', ['id' => $check->id]) }}">
                                        <button class="btn btn-secondary">Editar</button>
                                    </a> 
                                </td>
                                <td scope="row">
                                    <delete-button
                                    id_form="{{ $check->id }}"
                                    name_form="{{ $check->checklist_name }}"
                                    type_form="checklist"
                                    ></delete-button>
                                </td>
                                <td>
                                    <div class="barra text-center">
                                        <div style="width: {{ $check->progress }}%"></div>
                                        {{ $check->progress }}%
                                    </div>
                                    
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else

            <p class="text-center">Não existem checklists cadastrados</p>

            @endif        

        @endif

        <div class="my-3 p-0">
            <p class="text-center">Olá {{ $user->name }}</p>
            <p class="text-center"><a href="{{ route('logout') }}">Deslogar</a></p>
        </div>


    @endauth

    {{-- @foreach ($r as $s)
        {{ $s }}
    @endforeach --}}

    {{-- {{ $test }}
    {{ $c }} --}}
    <br>
    {{-- @foreach ($c as $key => $value)
        {{ $value }}
    @endforeach
        <br><br>
    @foreach ($test as $key => $value)
    {{ $value }} <br>
    @endforeach --}}

@endsection