<?php declare(strict_types=1);

namespace App\Domains\Alarm\Service\Type\Format;

abstract class Polygon extends FormatAbstract
{
    /**
     * @return void
     */
    public function validate(): void
    {
        $geojson = $this->config()['geojson'];

        if (empty($geojson)) {
            $this->validateException(__('alarm-type-polygon.error.geojson'));
        }

        if (empty($geojson['type']) || ($geojson['type'] !== 'FeatureCollection')) {
            $this->validateException(__('alarm-type-polygon.error.geojson-format'));
        }

        if (empty($geojson['features']) || (count($geojson['features']) !== 1)) {
            $this->validateException(__('alarm-type-polygon.error.geojson-format'));
        }

        $feature = $geojson['features'][0];

        if (empty($feature['type']) || ($feature['type'] !== 'Feature')) {
            $this->validateException(__('alarm-type-polygon.error.geojson-format'));
        }

        if (empty($feature['geometry'])) {
            $this->validateException(__('alarm-type-polygon.error.geojson-format'));
        }

        $geometry = $feature['geometry'];

        if (empty($geometry['type']) || ($geometry['type'] !== 'Polygon')) {
            $this->validateException(__('alarm-type-polygon.error.geojson-format'));
        }

        if (empty($geometry['coordinates'])) {
            $this->validateException(__('alarm-type-polygon.error.geojson-format'));
        }

        $coordinates = $geometry['coordinates'];

        if ((is_array($coordinates) === false) || (count($coordinates) !== 1)) {
            $this->validateException(__('alarm-type-polygon.error.geojson-format'));
        }
    }

    /**
     * @return array
     */
    public function config(): array
    {
        if (is_array($this->config['geojson'] ?? '') === false) {
            $this->config['geojson'] = json_decode($this->config['geojson'] ?? '[]', true);
        }

        return [
            'geojson' => $this->config['geojson'],
        ];
    }
}
