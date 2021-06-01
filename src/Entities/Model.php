<?php

namespace EGALL\Watson\Entities;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * Base model entity.
 *
 * @author Erik Galloway <egalloway@claruscare.com>
 */
class Model extends Entity
{
    /**
     * The entity's attributes.
     *
     * @var array
     */
    protected $attributes = [
        'supported_features' => [],
    ];

    /**
     * The attributes that should be filled during hydration.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'language', 'url', 'supported_features', 'description', 'rate',
    ];

    /**
     * Determine if the model can be customized.
     *
     * @return bool
     */
    public function customizable(): bool
    {
        return Arr::get($this, 'supported_features.custom_language_model', false);
    }

    /**
     * Determine if the model is a next gen model.
     *
     * @return bool
     */
    public function isNextGen(): bool
    {
        return ! Str::contains($this->name, 'Model');
    }

    /**
     * Determine if the model supports low latency (next-gen models only).
     *
     * @return bool
     */
    public function lowLatency(): bool
    {
        return Arr::get($this, 'supported_features.low_latency', false);
    }

    /**
     * Determine if the model supports speaker labels.
     *
     * @return bool
     */
    public function speakerLabels(): bool
    {
        return Arr::get($this, 'supported_features.speaker_labels', false);
    }
}
