<?php declare(strict_types=1);

namespace App\Domains\Timezone\Seeder;

use Illuminate\Database\Query\Expression;
use App\Domains\Timezone\Model\Timezone as Model;
use App\Domains\Shared\Seeder\SeederAbstract;

class Timezone extends SeederAbstract
{
    /**
     * @return void
     */
    public function run()
    {
        $this->insertWithoutDuplicates(Model::class, $this->map($this->json('timezone')), 'zone');
    }

    /**
     * @param array $list
     *
     * @return void
     */
    protected function map(array $list)
    {
        $geojson = $this->geojson();

        return array_map(static fn ($row) => ['geojson' => $geojson] + $row, $list);
    }

    /**
     * @return \Illuminate\Database\Query\Expression
     */
    protected function geojson(): Expression
    {
        return Model::DB()->raw(Model::emptyGeoJSON());
    }
}
