@extends('layouts.main')

@section('title', 'Tarefas ' . $checklist->checklist_name)



@section('content')

    @if (count($tasks) > 0)

      <div class="container">
        <table class="table m-auto" >
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nome da tarefa</th>
                <th scope="col">Título da tarefa</th>
                <th scope="col">Status da tarefa</th>
                <th scope="col">Responsável pela tarefa</th>
                <th scope="col" rowspan="2">Ações</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($tasks as $task)
                @if ($task->task_status == 0)
                  <tr class="alert alert-danger align-middle">
                    <td scope="row">{{ $task->id }}</td>
                    <td scope="row">{{ $task->task_name }}</td>
                    <td scope="row">{{ $task->task_title }}</td>
                    <td scope="row">Incompleto</td>
                    <td scope="row">{{ $task->responsible_task }}</td>
                    <td scope="row" >
                        <button class="btn btn-secondary">Ver mais</button>
                    </td>
                    <td scope="row">
                      <delete-button
                      id_form="{{ $task->id }}"
                      name_form="{{ $task->task_name }}"
                      type_form="task"
                      ></delete-button>
                    </td>
                  </tr> 
                    @else
                      <tr class="alert alert-success align-middle">
                        <td scope="row">{{ $task->id }}</td>
                        <td scope="row">{{ $task->task_name }}</td>
                        <td scope="row">{{ $task->task_title }}</td>
                        <td scope="row">Completo</td>
                        <td scope="row">{{ $task->responsible_task }}</td>
                        <td scope="row" >
                            <button class="btn btn-secondary">Ver mais</button>
                        </td>
                        <td scope="row">
                          <delete-button
                          id_form="{{ $task->id }}"
                          name_form="{{ $task->task_name }}"
                          type_form="task"
                          ></delete-button>
                        </td>
                      </tr> 
                @endif
              @endforeach
            </tbody>
          </table>
        </div>
    @else 

    <div class="col-md-6 text-center position-absolute top-50 offset-3">
      <p >Não existem tarefas relacionadas a esse hotel</p>
      <a href="/"><p>Voltar</p></a>   
    </div>   
    @endif

    <script>


    </script>
@endsection