<?php declare(strict_types=1);

namespace App\Domains\MaintenanceItem\Controller;

use App\Domains\CoreApp\Controller\ControllerWebAbstract;
use App\Domains\MaintenanceItem\Model\MaintenanceItem as Model;
use App\Exceptions\NotFoundException;

abstract class ControllerAbstract extends ControllerWebAbstract
{
    /**
     * @var ?\App\Domains\MaintenanceItem\Model\MaintenanceItem
     */
    protected ?Model $row;

    /**
     * @param int $id
     *
     * @return void
     */
    protected function row(int $id): void
    {
        $this->row = Model::query()->byId($id)->byUserId($this->auth->id)->firstOr(static function () {
            throw new NotFoundException(__('maintenance-item.error.not-found'));
        });
    }
}
