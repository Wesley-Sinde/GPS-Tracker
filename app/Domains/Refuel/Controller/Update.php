<?php declare(strict_types=1);

namespace App\Domains\Refuel\Controller;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use App\Domains\Vehicle\Model\Vehicle as VehicleModel;

class Update extends ControllerAbstract
{
    /**
     * @param int $id
     *
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function __invoke(int $id): Response|RedirectResponse
    {
        $this->row($id);

        if ($response = $this->actions()) {
            return $response;
        }

        $this->requestMergeWithRow();

        $this->meta('title', __('refuel-update.meta-title', ['title' => $this->row->date_at]));

        return $this->page('refuel.update', [
            'row' => $this->row,
            'vehicles' => VehicleModel::query()->byUserId($this->auth->id)->list()->get(),
        ]);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|false|null
     */
    protected function actions(): RedirectResponse|false|null
    {
        return $this->actionPost('update')
            ?: $this->actionPost('delete');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function update(): RedirectResponse
    {
        $this->action()->update();

        $this->sessionMessage('success', __('refuel-update.success'));

        return redirect()->route('refuel.update', $this->row->id);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function delete(): RedirectResponse
    {
        $this->action()->delete();

        $this->sessionMessage('success', __('refuel-update.delete-success'));

        return redirect()->route('refuel.index');
    }
}
