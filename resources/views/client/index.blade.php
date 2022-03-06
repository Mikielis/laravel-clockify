@extends('layouts.app')

@section('content')
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

    @push('scripts')
        <script src='{{ asset('js/jq.client.js') }}' type='text/javascript'></script>
    @endpush
@endsection


