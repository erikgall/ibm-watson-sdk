<?php

namespace EGALL\Watson\Entities;

/**
 * Custom language model word entity.
 *
 * @author Erik Galloway <egalloway@claruscare.com>
 */
class Word extends Entity
{
    /**
     * The entity's attributes.
     *
     * @var array
     */
    protected $attributes = [
        'sounds_like' => [],
        'source'      => [],
    ];

    /**
     * The attributes that should be filled during hydration.
     *
     * @var array
     */
    protected $fillable = [
        'word', 'sounds_like', 'display_as', 'count', 'source',
    ];
}
