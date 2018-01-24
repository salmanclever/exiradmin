@if ($crud->hasAccess('update'))
    @if (!$crud->model->translationEnabled())

        <!-- Single edit button -->
        <a href="{{ url($crud->route.'/'.$entry->getKey().'/addgroup') }}" class="btn btn-xs btn-default"><i class="fa  fa-user-plus"></i> {{ trans('backpack::crud.add_group') }}</a>

    @else

        <!-- Edit button group -->
        <div class="btn-group">
            <a href="{{ url($crud->route.'/'.$entry->getKey().'/addgroup') }}" class="btn btn-xs btn-default"><i class="fa fa-edit"></i> {{ trans('backpack::crud.add_group') }}</a>
            <button type="button" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-right">
                <li class="dropdown-header">{{ trans('backpack::crud.add_group') }}:</li>
                @foreach ($crud->model->getAvailableLocales() as $key => $locale)
                    <li><a href="{{ url($crud->route.'/'.$entry->getKey().'/group') }}?locale={{ $key }}">{{ $locale }}</a></li>
                @endforeach
            </ul>
        </div>

    @endif
@endif