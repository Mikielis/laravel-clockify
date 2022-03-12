@extends('layouts.app')

@section('content')
    @can('client_edit')
        <div class="col-4">
            @include('client.form.client')
        </div>
    @endcan
@endsection


