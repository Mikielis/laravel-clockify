@extends('layouts.app')

@section('content')
    @can('client_add')
        <button class="btn btn-secondary ml-3 mb-3" id="AddClient">{{ _('Add client') }}</button>

        <div class="col-4 @if (!$errors->any()) d-none @endif" id="newClientForm">

            @include('client.form.errors')
            
            @include('client.form.client')
        </div>


        <div class="col-12 mt-5">
            <h1 class="mb-3">{{ __('Clients') }} <span class="badge badge-secondary">{{ $clientsNumber }}</span></h1>

            @include('client.list.full')
        </div>


    @endcan

    @push('scripts')
        <script src='{{ asset('js/jq.client.js') }}' type='text/javascript'></script>
    @endpush
@endsection


