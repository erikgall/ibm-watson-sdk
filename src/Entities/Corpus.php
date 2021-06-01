<?php

namespace EGALL\Watson\Entities;

/**
 * Custom language model corpus entity.
 *
 * @author Erik Galloway <egalloway@claruscare.com>
 */
class Corpus extends Entity
{
    /**
     * Constant representing an analyzed/processed corpus status.
     */
    const ANALYZED = 'analyzed';

    /**
     * Constant representing a processing corpus status.
     */
    const PROCESSING = 'being_processed';

    /**
     * Constant representing an undetermined corpus status.
     */
    const UNDETERMINED = 'undetermined';

    /**
     * The attributes that should be filled during hydration.
     *
     * @var array
     */
    protected $fillable = [
        'out_of_vocabulary_words', 'total_words', 'name', 'status',
    ];

    /**
     * Determine if an error occurred while processing the corpus.
     *
     * @return bool
     */
    public function failed(): bool
    {
        return $this->status === static::UNDETERMINED;
    }

    /**
     * Determine if the corpus has been ingested by IBM Watson.
     *
     * @return bool
     */
    public function isComplete(): bool
    {
        return in_array($this->status, [static::ANALYZED, static::UNDETERMINED]);
    }

    /**
     * Determine if the corpus is currently being processed.
     *
     * @return bool
     */
    public function isProcessing(): bool
    {
        return $this->status === static::PROCESSING;
    }

    /**
     * Determine if the corpus is processed and ready.
     *
     * @return bool
     */
    public function isReady(): bool
    {
        return $this->status === static::ANALYZED;
    }
}
