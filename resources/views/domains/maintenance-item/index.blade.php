@extends ('layouts.in')

@section ('body')

<form method="get">
    <div class="lg:flex lg:space-x-4">
        <div class="flex-grow mt-2 lg:mt-0">
            <input type="search" class="form-control form-control-lg" placeholder="{{ __('maintenance-item-index.filter') }}" data-table-search="#maintenance-item-list-table" />
        </div>

        <div class="lg:ml-4 mt-2 lg:mt-0 bg-white">
            <a href="{{ route('maintenance-item.create') }}" class="btn form-control-lg">{{ __('maintenance-item-index.create') }}</a>
        </div>
    </div>
</form>

<div class="overflow-auto lg:overflow-visible header-sticky">
    <table id="maintenance-item-list-table" class="table table-report sm:mt-2 font-medium font-semibold text-center whitespace-nowrap" data-table-sort data-table-pagination data-table-pagination-limit="10">
        <thead>
            <tr>
                <th class="text-left">{{ __('maintenance-item-index.name') }}</th>
                <th>{{ __('maintenance-item-index.maintenances_count') }}</th>
                <th>{{ __('maintenance-item-index.created_at') }}</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($list as $row)

            @php ($link = route('maintenance-item.update', $row->id))

            <tr>
                <td><a href="{{ $link }}" class="block text-left">{{ $row->name }}</a></td>
                <td><a href="{{ $link }}" class="block">{{ $row->maintenances_count }}</a></td>
                <td data-table-sort-value="{{ $row->created_at }}"><a href="{{ $link }}" class="block">@dateLocal($row->created_at)</a></td>
            </tr>

            @endforeach
        </tbody>
    </table>
</div>

@stop
