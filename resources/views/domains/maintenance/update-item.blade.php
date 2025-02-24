@extends ('domains.maintenance.update-layout')

@section ('content')

<form method="post" data-maintenance-update-item>
    <input type="hidden" name="_action" value="updateItem" />

    <div class="overflow-auto lg:overflow-visible header-sticky">
        <table id="maintenance-item-list-table" class="table table-report sm:mt-2 font-medium font-semibold text-center whitespace-nowrap" data-table-sort data-table-pagination data-table-pagination-limit="10">
            <thead>
                <tr>
                    <th class="text-left">{{ __('maintenance-update-item.name') }}</th>
                    <th>{{ __('maintenance-update-item.quantity') }}</th>
                    <th>{{ __('maintenance-update-item.amount') }}</th>
                    <th>{{ __('maintenance-update-item.tax_percent') }}</th>
                    <th>{{ __('maintenance-update-item.subtotal') }}</th>
                    <th>{{ __('maintenance-update-item.tax_amount') }}</th>
                    <th>{{ __('maintenance-update-item.total') }}</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @foreach ($itemsPivot as $each)

                <tr>
                    <td><x-select name="maintenance_item_id[]" :options="$items" value="id" text="name" :selected="$each->maintenance_item_id" :placeholder="__('maintenance-update-item.item')" required data-maintenance-update-item-maintenance_item_id></x-select></td>
                    <td><input type="number" name="quantity[]" value="{{ $each->quantity }}" class="form-control" step="any" min="0" required data-maintenance-update-item-quantity /></td>
                    <td><input type="number" name="amount[]" value="{{ $each->amount }}" class="form-control" step="any" min="0" required data-maintenance-update-item-amount /></td>
                    <td><input type="number" name="tax_percent[]" value="{{ $each->tax_percent }}" class="form-control" step="any" min="0" required data-maintenance-update-item-tax_percent /></td>
                    <td><input type="number" name="subtotal[]" value="{{ $each->subtotal }}" class="form-control" step="any" min="0" readonly data-maintenance-update-item-subtotal /></td>
                    <td><input type="number" name="tax_amount[]" value="{{ $each->tax_amount }}" class="form-control" step="any" min="0" readonly data-maintenance-update-item-tax_amount /></td>
                    <td><input type="number" name="total[]" value="{{ $each->total }}" class="form-control" step="any" min="0" readonly data-maintenance-update-item-total /></td>

                    <td class="w-1">
                        <a href="#" data-maintenance-update-item-add>@icon('plus', 'w-4 h-4')</a>
                        <span class="mx-2"></span>
                        <a href="#" data-maintenance-update-item-remove>@icon('minus', 'w-4 h-4')</a>
                    </td>
                </tr>

                @endforeach

                <tr>
                    <td><x-select name="maintenance_item_id[]" :options="$items" value="id" text="name" :placeholder="__('maintenance-update-item.item')" data-maintenance-update-item-maintenance_item_id></x-select></td>
                    <td><input type="number" name="quantity[]" value="" class="form-control" step="any" min="0" data-maintenance-update-item-quantity /></td>
                    <td><input type="number" name="amount[]" value="" class="form-control" step="any" min="0" data-maintenance-update-item-amount /></td>
                    <td><input type="number" name="tax_percent[]" value="" class="form-control" step="any" min="0" data-maintenance-update-item-tax_percent /></td>
                    <td><input type="number" name="subtotal[]" value="" class="form-control" step="any" min="0" readonly data-maintenance-update-item-subtotal /></td>
                    <td><input type="number" name="tax_amount[]" value="" class="form-control" step="any" min="0" readonly data-maintenance-update-item-tax_amount /></td>
                    <td><input type="number" name="total[]" value="" class="form-control" step="any" min="0" readonly data-maintenance-update-item-total /></td>

                    <td class="w-1">
                        <a href="#" data-maintenance-update-item-add>@icon('plus', 'w-4 h-4')</a>
                        <span class="mx-2"></span>
                        <a href="#" data-maintenance-update-item-remove>@icon('minus', 'w-4 h-4')</a>
                    </td>
                </tr>

                <tr class="hidden" data-maintenance-update-item-template>
                    <td><x-select name="maintenance_item_id[]" :options="$items" value="id" text="name" :placeholder="__('maintenance-update-item.item')" data-maintenance-update-item-maintenance_item_id></x-select></td>
                    <td><input type="number" name="quantity[]" value="" class="form-control" step="any" min="0" data-maintenance-update-item-quantity /></td>
                    <td><input type="number" name="amount[]" value="" class="form-control" step="any" min="0" data-maintenance-update-item-amount /></td>
                    <td><input type="number" name="tax_percent[]" value="" class="form-control" step="any" min="0" data-maintenance-update-item-tax_percent /></td>
                    <td><input type="number" name="subtotal[]" value="" class="form-control" step="any" min="0" readonly data-maintenance-update-item-subtotal /></td>
                    <td><input type="number" name="tax_amount[]" value="" class="form-control" step="any" min="0" readonly data-maintenance-update-item-tax_amount /></td>
                    <td><input type="number" name="total[]" value="" class="form-control" step="any" min="0" readonly data-maintenance-update-item-total /></td>

                    <td class="w-1">
                        <a href="#" data-maintenance-update-item-add>@icon('plus', 'w-4 h-4')</a>
                        <span class="mx-2"></span>
                        <a href="#" data-maintenance-update-item-remove>@icon('minus', 'w-4 h-4')</a>
                    </td>
                </tr>
            </tbody>

            <tfoot class="bg-white">
                <tr>
                    <th></th>
                    <th data-maintenance-update-item-total-quantity>{{ $total['quantity'] }}</th>
                    <th data-maintenance-update-item-total-amount>@unitHumanRaw('money', $total['amount'])</th>
                    <th></th>
                    <th data-maintenance-update-item-total-subtotal>@unitHumanRaw('money', $total['subtotal'])</th>
                    <th data-maintenance-update-item-total-tax_amount>@unitHumanRaw('money', $total['tax_amount'])</th>
                    <th data-maintenance-update-item-total-total>@unitHumanRaw('money', $total['total'])</th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="box p-5 mt-5">
        <div class="text-right">
            <button type="submit" class="btn btn-primary" data-click-one>{{ __('maintenance-update-item.save') }}</button>
        </div>
    </div>
</form>

@include ('domains.maintenance.molecules.update-item-modal')

@stop
