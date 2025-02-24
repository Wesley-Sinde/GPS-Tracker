<?php declare(strict_types=1);

namespace App\Domains\Profile\Test\Controller;

use App\Services\Http\Curl\Curl;

class UpdateTelegram extends ControllerAbstract
{
    /**
     * @var string
     */
    protected string $route = 'profile.update.telegram';

    /**
     * @var string
     */
    protected string $action = 'updateTelegramChatId';

    /**
     * @return void
     */
    public function testGetGuestUnauthorizedFail(): void
    {
        $this->get($this->routeToController())
            ->assertStatus(302)
            ->assertRedirect(route('user.auth.credentials'));
    }

    /**
     * @return void
     */
    public function testGetGuestFail(): void
    {
        $this->post($this->routeToController())
            ->assertStatus(302)
            ->assertRedirect(route('user.auth.credentials'));
    }

    /**
     * @return void
     */
    public function testGetAuthEmptySuccess(): void
    {
        $this->authUser();

        $this->get($this->routeToController())
            ->assertStatus(200);
    }

    /**
     * @return void
     */
    public function testGetAuthSuccess(): void
    {
        $this->authUser();
        $this->factoryCreate();

        $this->get($this->routeToController())
            ->assertStatus(200);
    }

    /**
     * @return void
     */
    public function testPostAuthSuccess(): void
    {
        $this->setCurl();

        $user = $this->authUser();

        $data = $this->factoryMake()->toArray();
        $data['password_current'] = $user->email;

        $this->post($this->routeToController(), $data + $this->action())
            ->assertStatus(302)
            ->assertRedirect(route('dashboard.index'));
    }

    /**
     * @return string
     */
    protected function routeToController(): string
    {
        return $this->route();
    }

    /**
     * @return void
     */
    protected function setCurl(): void
    {
        Curl::fake(file_get_contents(base_path('resources/app/test/server/api.telegram.org.log')));
    }
}
