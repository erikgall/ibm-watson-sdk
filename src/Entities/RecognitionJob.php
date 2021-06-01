<?php

namespace EGALL\Watson\Entities;

/**
 * Recognition/transcription job entity.
 *
 * @author Erik Galloway <egalloway@claruscare.com>
 */
class RecognitionJob extends Entity
{
    /**
     * Constant representing the completed status.
     */
    public const COMPLETED = 'completed';

    /**
     * Constant representing the failed status.
     */
    public const FAILED = 'failed';

    /**
     * Constant representing the processing status.
     */
    public const PROCESSING = 'processing';

    /**
     * Constant representing the waiting status.
     */
    public const WAITING = 'waiting';

    /**
     * The entity's attributes.
     *
     * @var array
     */
    protected $attributes = [
        'results' => [],
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
        'id', 'status', 'created', 'updated', 'url', 'user_token', 'results',
    ];

    /**
     * Determine if the job has failed.
     *
     * @return bool
     */
    public function failed(): bool
    {
        return $this->status === static::FAILED;
    }

    /**
     * Determine if the job is complete.
     *
     * @return bool
     */
    public function isComplete(): bool
    {
        return $this->status === static::COMPLETED;
    }

    /**
     * Determine if the job is currently processing.
     *
     * @return bool
     */
    public function isProcessing(): bool
    {
        return $this->status === static::PROCESSING;
    }

    /**
     * Determine if the job is currently waiting.
     *
     * @return bool
     */
    public function isWaiting(): bool
    {
        return $this->status === static::WAITING;
    }
}
