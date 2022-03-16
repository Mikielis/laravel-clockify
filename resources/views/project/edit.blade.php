@extends('layouts.app')

@section('content')
    @can('project_edit')
        <div class="col-4">
            @include('project.form.project')
        </div>
    @endcan
@endsection


