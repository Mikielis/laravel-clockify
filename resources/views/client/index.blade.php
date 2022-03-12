@extends('layouts.app')

@section('content')
    @can('client_add')
        <button class="btn btn-secondary btn-sm ml-3 mb-3" id="addClient"><i class="fa-solid fa-plus"></i> {{ _('Add client') }}</button>

        <div class="form @if (!$errors->any()) d-none @endif" id="clientForm">
            <div class="col-4">
                <div class="text-right">
                    <i class="fa-solid fa-rectangle-xmark" id="hideClientForm"></i>
                </div>

                @include('client.form.errors')

                @include('client.form.client')
            </div>
        </div>

        <div class="col-12 mt-3">
            @include('client.list.full')
        </div>


    @endcan

    @push('scripts')
        <script src='{{ asset('js/jq.client.js') }}' type='text/javascript'></script>
    @endpush
@endsection


