@extends('layouts.main')

@section('title', 'Adicionar tarefa')

@section('content')
    <form-task checks_id="{{ json_encode($ids) }}"></form-task>
@endsection