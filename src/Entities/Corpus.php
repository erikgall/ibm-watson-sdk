<?php

namespace EGALL\Watson\Entities;

use EGALL\Watson\Contracts\ProcessableStatus;

/**
 * Custom language model corpus entity.
 *
 * @author Erik Galloway <egalloway@claruscare.com>
 */
class Corpus extends Entity implements ProcessableStatus
{
    use Processable;

    /**
     * The attributes that should be filled during hydration.
     *
     * @var array
     */
    protected $fillable = [
        'out_of_vocabulary_words', 'total_words', 'name', 'status',
    ];
}
