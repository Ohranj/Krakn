<?php

namespace App\Exceptions;

use Exception;
use App\Traits\JsonResponseTrait;
use Illuminate\Support\Facades\Log;

class ReportInvalidRequestException extends Exception
{
    use JsonResponseTrait;

    /**
     * 
     */
    public function __construct(
        protected string $text,
        protected array $errors = [],
        protected int $status = 422
    ) {}

    /**
     * 
     */
    public function report()
    {
        Log::info($this->text);
    }
}
