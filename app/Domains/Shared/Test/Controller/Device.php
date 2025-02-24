<?php declare(strict_types=1);

namespace App\Domains\Shared\Test\Controller;

use App\Domains\Device\Model\Device as Model;
use App\Domains\Trip\Model\Trip as TripModel;

class Device extends ControllerAbstract
{
    /**
     * @var string
     */
    protected string $route = 'shared.device';

    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return Model::class;
    }

    /**
     * @return void
     */
    public function testPostGuestNotAllowedFail(): void
    {
        $this->post($this->routeToController())
            ->assertStatus(405);
    }

    /**
     * @return void
     */
    public function testGetGuestSuccess(): void
    {
        $this->get($this->routeToController())
            ->assertStatus(200);
    }

    /**
     * @return void
     */
    public function testGetGuestTripsSuccess(): void
    {
        $this->factoryCreate(TripModel::class, [
            'shared' => true,
            'shared_public' => true,
        ]);

        $this->get($this->routeToController())
            ->assertStatus(200);
    }

    /**
     * @return void
     */
    public function testGetSharedDisabledFail(): void
    {
        $this->get($this->routeToController(false))
            ->assertStatus(404);
    }

    /**
     * @param bool $shared = true
     *
     * @return string
     */
    protected function routeToController(bool $shared = true): string
    {
        return $this->route(null, $this->factoryCreate(data: ['shared' => $shared])->code);
    }
}
