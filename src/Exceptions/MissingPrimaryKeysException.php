<?php

namespace Composito\Exceptions;

use Exception;

class MissingPrimaryKeysException extends Exception
{
    /**
     * Create a new exception instance.
     */
    public function __construct()
    {
        parent::__construct("Primary keys must be set.");
    }
}