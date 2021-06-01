<?php

namespace EGALL\Watson\Entities;

use EGALL\Watson\Contracts\ProcessableStatus as Status;

/**
 * Processable status entity trait.
 *
 * @author Erik Galloway <egalloway@claruscare.com>
 */
trait Processable
{
    /**
     * Determine if an error occurred while processing the corpus.
     *
     * @return bool
     */
    public function failed(): bool
    {
        return $this->status === Status::UNDETERMINED;
    }

    /**
     * Determine if the corpus has been ingested by IBM Watson.
     *
     * @return bool
     */
    public function isComplete(): bool
    {
        return in_array($this->status, [
            Status::ANALYZED,
            Status::UNDETERMINED,
        ]);
    }

    /**
     * Determine if the corpus is currently being processed.
     *
     * @return bool
     */
    public function isProcessing(): bool
    {
        return $this->status === Status::PROCESSING;
    }

    /**
     * Determine if the corpus is processed and ready.
     *
     * @return bool
     */
    public function isReady(): bool
    {
        return $this->status === Status::ANALYZED;
    }
}
