@extends ('layouts.in')

@section ('body')

<form method="post">
    <input type="hidden" name="_action" value="create" />

    @include ('domains.maintenance-item.molecules.create-update')

    <div class="box p-5 mt-5">
        <div class="text-right">
            <button type="submit" class="btn btn-primary">{{ __('maintenance-item-create.save') }}</button>
        </div>
    </div>
</form>

@stop
