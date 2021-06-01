<?php

namespace EGALL\Watson\Entities;

use EGALL\Watson\Contracts\ProcessableStatus;

/**
 * Custom language model grammar entity.
 *
 * @author Erik Galloway <egalloway@claruscare.com>
 */
class Grammar extends Entity implements ProcessableStatus
{
    use Processable;

    /**
     * The attributes that should be filled during hydration.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'out_of_vocabulary_words', 'status',
    ];
}
