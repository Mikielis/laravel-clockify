@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="post" action="{{ isset($project) ? route('save-project', ['id' => $timesheet->id]) :  route('add-timesheet') }}">
    @csrf
    <div class="timesheet-form">
        <div>
            <input type="text" placeholder="{{ __('What are you working on?') }}" class="form-control" required>
        </div>
    </div>
</form>
