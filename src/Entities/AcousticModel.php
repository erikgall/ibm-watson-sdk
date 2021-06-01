<?php

namespace EGALL\Watson\Entities;

use EGALL\Watson\Contracts\TrainableStatus;

/**
 * Custom acoustic model entity.
 *
 * @author Erik Galloway <egalloway@claruscare.com>
 */
class AcousticModel extends Entity implements TrainableStatus
{
    use Trainable;

    /**
     * The entity's attributes.
     *
     * @var array
     */
    protected $attributes = [
        'versions' => [],    ];

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
        'customization_id', 'owner', 'name', 'base_model_name', 'status',
        'language', 'versions', 'description', 'progress', 'created', 'updated',
    ];
}
