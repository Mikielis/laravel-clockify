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
        <div class="name">
            <input type="text" name="name" placeholder="{{ __('What are you working on?') }}" class="form-control" required>
            <div id="workNameSuggestions" cladd="d-none"></div>
        </div>
        <div class="project">
            <select type="text" name="project_id" class="form-control" required>
                <option value="" disabled selected>{{ _('Select project') }}</option>
                @foreach ($projects as $client)
                    <optgroup label="{{ $client[0]->client_name }} / {{ $client[0]->client_country }}"></optgroup>
                    @foreach ($client as $project)
                        <option value="{{ $project->id }}">&nbsp; {{ $project->name }}</option>
                    @endforeach
                @endforeach
            </select>
            <button class="btn btn-secondary" id="searchProject"><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
        <div class="billable">
            <i class="fa-solid fa-sterling-sign"></i>
            <input type="text" name="billable" id="billable" class="d-none" required>
        </div>
        <div class="time">
            <input type="text" name="date_from_nice" value="{{ date('H:i') }}" id="dateFromNice" class="form-control"> -
            <input type="text" name="date_to_nice" value="{{ date('H:i') }}" id="dateToNice" class="form-control">
            <input type="datetime-local" name="date_from" id="dateFrom" class="d-none" required>
            <input type="datetime-local" name="date_to" id="dateTo" class="d-none" required>
        </div>
        <div class="calendar">
            <i class="fa-solid fa-calendar-days"></i>
            <span id="calendarDate">{{ _('Today') }}</span>
        </div>
        <div class="submit-button">
            <button class="btn btn-primary">{{ _('Report') }}</button>
        </div>
    </div>
</form>
