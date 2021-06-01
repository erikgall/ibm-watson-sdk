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
    const ANALYZED = 'analyzed';

    /**
     * Constant representing a processing corpus status.
     */
    const PROCESSING = 'being_processed';

    /**
     * Constant representing an undetermined corpus status.
     */
    const UNDETERMINED = 'undetermined';
}
