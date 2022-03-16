@extends('layouts.app')

@section('content')
    @can('project_add')
        <button class="btn btn-secondary btn-sm ml-3 mb-3" id="addProject"><i class="fa-solid fa-plus"></i> {{ _('Add project') }}</button>

        <div class="form @if (!$errors->any()) d-none @endif" id="projectForm">
            <div class="col-4">
                <div class="text-right">
                    <i class="fa-solid fa-rectangle-xmark" id="hideProjectForm"></i>
                </div>

                @include('project.form.errors')

                @include('project.form.project')
            </div>
        </div>

        <div class="col-12 mt-3">
            @include('project.list.full')
        </div>


    @endcan

    @push('scripts')
        <script src='{{ asset('js/jq.project.js') }}' type='text/javascript'></script>
    @endpush
@endsection



