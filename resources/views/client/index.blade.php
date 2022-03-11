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

            <form method="post" action="{{ route('add-client') }}">
                @csrf
                <div class="form-group">
                    <label for="name">{{ _('Name') }}</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="{{ _('Name') }}" maxlength="255" required>
                </div>
                <div class="form-group">
                    <label for="country">{{ _('Country') }}</label>
                    <select name="country" class="form-control" id="country" placeholder="{{ _('Country') }}">
                        @foreach ($countries as $country)
                            <option>{{ $country }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">{{ _('City') }}</label>
                    <input type="text" name="city" class="form-control" id="name" placeholder="{{ _('City') }}" maxlength="255">
                </div>
                <div class="form-group">
                    <label for="name">{{ _('Postcode') }}</label>
                    <input type="text" name="postcode" class="form-control" id="name" placeholder="{{ _('Postcode') }}" maxlength="10">
                </div>
                <div class="form-group">
                    <label for="name">{{ _('Street') }}</label>
                    <input type="text" name="street" class="form-control" id="name" placeholder="{{ _('Street') }}" maxlength="255">
                </div>
                <div class="form-group">
                    <label for="name">{{ _('House number') }}</label>
                    <input type="text" name="house_number" class="form-control" id="name" placeholder="{{ _('House number') }}" maxlength="10">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">{{ _('Submit') }}</button>
                </div>
            </form>
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


