@extends('layouts.main')

@section('title', 'Editar checklist')

@section('content')
    <form-checklist 
    id_checklist="{{ $check->id }}"
    method_form="put"
    name_form="{{ $check->checklist_name }}"
    ></form-checklist>
@endsection