<?php declare(strict_types=1);

namespace App\Domains\Refuel\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Domains\Refuel\Model\Builder\Refuel as Builder;
use App\Domains\Refuel\Model\Collection\Refuel as Collection;
use App\Domains\Refuel\Test\Factory\Refuel as TestFactory;
use App\Domains\CoreApp\Model\ModelAbstract;
use App\Domains\Vehicle\Model\Vehicle as VehicleModel;

class Refuel extends ModelAbstract
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'refuel';

    /**
     * @const string
     */
    public const TABLE = 'refuel';

    /**
     * @const string
     */
    public const FOREIGN = 'refuel_id';

    /**
     * @param array $models
     *
     * @return \App\Domains\Refuel\Model\Collection\Refuel
     */
    public function newCollection(array $models = []): Collection
    {
        return new Collection($models);
    }

    /**
     * @param \Illuminate\Database\Query\Builder $query
     *
     * @return \App\Domains\Refuel\Model\Builder\Refuel
     */
    public function newEloquentBuilder($query): Builder
    {
        return new Builder($query);
    }

    /**
     * @return \App\Domains\Refuel\Test\Factory\Refuel
     */
    protected static function newFactory(): TestFactory
    {
        return TestFactory::new();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(VehicleModel::class, VehicleModel::FOREIGN)->withTimezone();
    }
}
