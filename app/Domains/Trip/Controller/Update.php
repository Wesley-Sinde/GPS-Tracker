<?php declare(strict_types=1);

namespace App\Domains\Trip\Controller;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class Update extends UpdateAbstract
{
    /**
     * @param int $id
     *
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function __invoke(int $id): Response|RedirectResponse
    {
        $this->load($id);

        if ($response = $this->actions()) {
            return $response;
        }

        $this->requestMergeWithRow();

        $this->meta('title', __('trip-update.meta-title', ['title' => $this->row->name]));

        return $this->page('trip.update', [
            'row' => $this->row,
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

        $this->sessionMessage('success', __('trip-update.success'));

        return redirect()->route('trip.update', $this->row->id);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function delete(): RedirectResponse
    {
        $this->action()->delete();

        $this->sessionMessage('success', __('trip-update.delete-success'));

        return redirect()->route('trip.index');
    }
}
