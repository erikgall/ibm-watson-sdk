<?php

namespace EGALL\Watson\Entities;

/**
 * Custom Language model entity.
 *
 * @author Erik Galloway <egalloway@claruscare.com>
 */
class LanguageModel extends Entity
{
    /**
     * The entity's attributes.
     *
     * @var array
     */
    protected $attributes = [
        'versions' => [],
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'created' => 'datetime',
        'updated' => 'datetime',
    ];

    /**
     * The attributes that should be filled during hydration.
     *
     * @var array
     */
    protected $fillable = [
        'customization_id', 'owner', 'name', 'base_model_name', 'status', 'language',
        'dialect', 'versions', 'description','progress', 'created', 'updated',
    ];

    /**
     * Get the (customization) ID attribute.
     *
     * @return string|null
     */
    public function getIdAttribute()
    {
        return $this->customization_id;
    }
}
