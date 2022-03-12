@extends('layouts.app')

@section('content')
    @can('client_edit')
        <div class="col-4">
            <h1 class="mb-3">{{ _('Edit client') }}</h1>
            @include('client.form.client')
        </div>
    @endcan
@endsection


