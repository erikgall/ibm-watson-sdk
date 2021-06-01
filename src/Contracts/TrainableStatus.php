<?php

namespace EGALL\Watson\Contracts;

/**
 * Trainable status entity contract.
 *
 * @author Erik Galloway <egalloway@claruscare.com>
 */
interface TrainableStatus
{
    /**
     * Constant representing a model available status.
     *
     * The model is trained and ready to use.
     */
    public const AVAILABLE = 'available';

    /**
     * Constant representing a model failed status.
     *
     * Training of the model failed.
     */
    public const FAILED = 'failed';

    /**
     * Constant representing a model pending status.
     *
     * The model was created but is waiting either for valid training
     * data to be added or for the service to finish analyzing added data.
     */
    public const PENDING = 'pending';

    /**
     * Constant representing a model ready status.
     *
     * The model contains valid data and is ready to be trained. If the
     * model contains a mix of valid and invalid resources, you need to
     * set the strict parameter to false for the training to proceed.
     */
    public const READY = 'ready';

    /**
     * Constant representing a model training status.
     *
     * The model is currently being trained.
     */
    public const TRAINING = 'training';

    /**
     * Constant representing a model upgrading status.
     *
     * The model is currently being upgraded.
     */
    public const UPGRADING = 'upgrading';
}
