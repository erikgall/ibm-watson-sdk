<?php

namespace EGALL\Watson\Entities;

use EGALL\Watson\Contracts\TrainableStatus as Status;

/**
 * Trainable status entity trait.
 *
 * @author Erik Galloway <egalloway@claruscare.com>
 */
trait Trainable
{
    /**
     * Determine if the model training failed.
     *
     * @return bool
     */
    public function failed(): bool
    {
        return $this->status === Status::FAILED;
    }

    /**
     * Determine if the model is available and ready for use.
     *
     * @return bool
     */
    public function isAvailable(): bool
    {
        return $this->status === Status::AVAILABLE;
    }

    /**
     * Determine if the model status is currently pending.
     *
     * @return bool
     */
    public function isPending(): bool
    {
        return $this->status === Status::PENDING;
    }

    /**
     * Determine if the model is ready for use (w/ possible warnings/errors).
     *
     * @return bool
     */
    public function isReady(): bool
    {
        return $this->status === Status::READY;
    }

    /**
     * Determine if the model is currently being trained.
     *
     * @return bool
     */
    public function isTraining(): bool
    {
        return $this->status === Status::TRAINING;
    }

    /**
     * Determine if the model is currently upgrading.
     *
     * @return bool
     */
    public function isUpgrading(): bool
    {
        return $this->status === Status::UPGRADING;
    }
}
