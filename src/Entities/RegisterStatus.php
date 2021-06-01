<?php

namespace EGALL\Watson\Entities;

/**
 * Callback registration status entity.
 *
 * @author Erik Galloway <egalloway@claruscare.com>
 */
class RegisterStatus extends Entity
{
    /**
     * The attributes that should be filled during hydration.
     *
     * @var array
     */
    protected $fillable = [
        'status', 'url', 'user_secret'
    ];
}