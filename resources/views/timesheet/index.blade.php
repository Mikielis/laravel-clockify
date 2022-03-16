@extends('layouts.app')

@section('content')
    @can('timesheet_add')
        <div class="form" id="timesheetForm">
            <div class="col-12">
                @include('timesheet.form.errors')

                @include('timesheet.form.timesheet')
            </div>
        </div>

        <div class="col-12 mt-3">
            @include('timesheet.list.full')
        </div>
    @endcan

    @push('scripts')
        <script src='{{ asset('js/jq.timesheet.js') }}' type='text/javascript'></script>
    @endpush
@endsection



