@extends('layouts.app')

@section('content')
    @can('client_add')
        <button class="btn btn-secondary ml-3 mb-3" id="AddClient">{{ _('Add client') }}</button>

        <div class="col-4 @if (!$errors->any()) d-none @endif" id="newClientForm">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @include('client.form.client')
        </div>


        <div class="col-12 mt-5">
            <h1 class="mb-3">{{ __('Clients') }} <span class="badge badge-secondary">{{ $clientsNumber }}</span></h1>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>{{ _('ID') }}</th>
                        <th>{{ _('Name') }}</th>
                        <th>{{ _('Country') }}</th>
                        <th>{{ _('Street') }}</th>
                        <th>{{ _('House number') }}</th>
                        <th>{{ _('Postcode') }}</th>
                        <th>{{ _('City') }}</th>
                        <th>{{ _('Created') }}</th>
                        <th>{{ _('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($clientsNumber > 0)
                        @foreach ($clients as $client)
                            <tr>
                                <td>{{ $client->id }}</td>
                                <td>{{ $client->name }}</td>
                                <td>{{ $client->country ?? '-' }}</td>
                                <td>{{ $client->street ?? '-' }}</td>
                                <td>{{ $client->house_number ?? '-' }}</td>
                                <td>{{ $client->postcode ?? '-' }}</td>
                                <td>{{ $client->city ?? '-' }}</td>
                                <td>{{ $client->created_at }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        @can('client_edit')
                                            <button
                                                type="button"
                                                class="btn btn-secondary"
                                                onclick="document.location.href='{{ route('edit-client', ['id' => $client->id]) }}'">
                                                {{ _('Edit') }}
                                            </button>
                                        @endcan

                                        @can('client_disable')
                                            <button
                                                type="button"
                                                class="btn btn-danger"
                                                onclick="document.location.href='{{ route('disable-client', ['id' => $client->id]) }}'">
                                                {{ _('Disable') }}
                                            </button>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="9" class="text-center">{{ _('No records') }}</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>


    @endcan

    @push('scripts')
        <script src='{{ asset('js/jq.client.js') }}' type='text/javascript'></script>
    @endpush
@endsection


