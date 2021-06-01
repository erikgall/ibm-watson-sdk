<?php

namespace EGALL\Watson\Contracts;

/**
 * Processable status entity contract.
 *
 * @author Erik Galloway <egalloway@claruscare.com>
 */
interface ProcessableStatus
{
    /**
     * Constant representing an analyzed/processed corpus status.
     */
    public const ANALYZED = 'analyzed';

    /**
     * Constant representing a processing corpus status.
     */
    public const PROCESSING = 'being_processed';

    /**
     * Constant representing an undetermined corpus status.
     */
    public const UNDETERMINED = 'undetermined';
}
