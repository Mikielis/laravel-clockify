<table class="table table-hover">
    <thead>
    <tr>
        <th>{{ _('Name') }}</th>
        <th>{{ _('Client') }}</th>
        <th>{{ _('From') }}</th>
        <th>{{ _('To') }}</th>
        <th>{{ _('Deadline') }}</th>
        <th>{{ _('Dev hours limit') }}</th>
        <th>{{ _('Trello board') }}</th>
        <th>{{ _('Note') }}</th>
        <th>{{ _('Created') }}</th>
        <th>{{ _('Actions') }}</th>
    </tr>
    </thead>
    <tbody>
    @if ($projectsNumber > 0)
        @foreach ($projects as $project)
            <tr>
                <td>{{ $project->name }}</td>
                <td>
                    <button onclick="document.location.href='{{ route('edit-client', ['id' => $project->client_id]) }}'" class="btn btn-secondary btn-sm"><i class="fa-solid fa-pen-to-square"></i> {{ $project->client_name }}</button>
                </td>
                <td>{{ $project->date_from ?? '-' }}</td>
                <td>{{ $project->date_to ?? '-' }}</td>
                <td>{{ $project->deadline ?? '-' }}</td>
                <td>{{ $project->dev_time_limit ?? '-' }}</td>
                <td>
                    @if ($project->trello_board)
                        <button onclick="window.open('{{ $project->trello_board }}')" class="btn btn-secondary btn-sm"><i class="fa-brands fa-trello"></i> {{ _('Open') }}</button>
                    @else
                        -
                    @endif
                </td>
                <td>
                    @if ($project->note)
                        <button type="button" class="btn btn-secondary btn-sm" data-toggle="tooltip" data-placement="bottom" title="{{ $project->note }}"><i class="fa-solid fa-eye"></i> {{ __('Read') }}</button>
                    @else
                        -
                    @endif
                </td>
                <td>{{ $project->created_at }}</td>
                <td>
                    <div class="btn-group btn-group-sm" role="group">
                        @can('client_edit')
                            <button
                                type="button"
                                class="btn btn-secondary"
                                onclick="document.location.href='{{ route('edit-project', ['id' => $project->id]) }}'">
                                <i class="fa-solid fa-pen-to-square"></i> {{ _('Edit') }}
                            </button>
                        @endcan

                        @can('client_disable')
                            <button
                                type="button"
                                class="btn btn-danger"
                                data-toggle="modal"
                                data-target="#deleteConfirmModal"
                                onclick="Project.methods.disable('{{ route('disable-project', ['id' => $project->id]) }}')">
                                <i class="fa-solid fa-trash"></i> {{ _('Disable') }}
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
