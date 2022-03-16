@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="post" action="{{ isset($project) ? route('save-project', ['id' => $project->id]) :  route('add-project') }}">
    @csrf
    <div class="form-group">
        <label for="name">{{ _('Name') }}*</label>
        <input type="text" name="name" value="{{ $project->name ?? '' }}" class="form-control" id="name" placeholder="{{ _('Name') }}" maxlength="255" required>
    </div>
    <div class="form-group">
        <label for="clientId">{{ _('Client') }}*</label>
        <select name="client_id" class="form-control" id="clientId" placeholder="{{ _('Client') }}" required>
            <option value="">{{ _('Select') }}</option>
            @foreach ($clients as $client)
                <option @if (isset($project) && $project->client_id == $client->id) selected @endif value="{{ $client->id }}">{{ $client->country }} > {{ $client->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="dateFrom">{{ _('Date from') }}</label>
        <input type="datetime" name="date_from" value="{{ $project->date_from ?? '' }}" class="form-control" id="dateFrom" placeholder="{{ _('Date from') }}" maxlength="30">
    </div>
    <div class="form-group">
        <label for="dateTo">{{ _('Date to') }}</label>
        <input type="datetime" name="date_to" value="{{ $project->date_to ?? '' }}" class="form-control" id="dateTo" placeholder="{{ _('Date to') }}" maxlength="30">
    </div>
    <div class="form-group">
        <label for="deadline">{{ _('Daadline') }}</label>
        <input type="datetime" name="deadline" value="{{ $project->deadline ?? '' }}" class="form-control" id="deadline" placeholder="{{ _('Deadline') }}">
    </div>
    <div class="form-group">
        <label for="devTimeLimit">{{ _('Dev time limit') }}</label>
        <input type="number" name="dev_time_limit" value="{{ $project->dev_time_limit ?? '' }}" class="form-control" id="devTimeLimit" placeholder="{{ _('Dev time limit') }}" maxlength="30">
    </div>
    <div class="form-group">
        <label for="trelloBoard">{{ _('Trello board') }}</label>
        <input type="text" name="trello_board" value="{{ $project->trello_board ?? '' }}" class="form-control" id="trelloBoard" placeholder="{{ _('Trello board') }}" maxlength="255">
    </div>
    <div class="form-group">
        <label for="note">{{ _('Note') }}</label>
        <textarea name="note" class="form-control" id="note" placeholder="{{ _('Note') }}" maxlength="400">{{ $project->note ?? '' }}</textarea>
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-primary">{{ _('Submit') }}</button>
    </div>
</form>
