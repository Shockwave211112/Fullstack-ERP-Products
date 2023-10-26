<?php

namespace App\Exceptions;

use Exception;

class PermissionsException extends Exception
{
    /**
     * @param string $message
     * @param int $status
     */
    public function __construct(string $message = 'Permissions logic exception', int $status = 403)
    {
        $this->message = $message;
        $this->status = $status;
    }
}
