<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\Model;

class ModelNotSavedException extends Exception
{
    private Model $model;

    public function __construct(Model $model, string $message = '', ?\Throwable $previous = null)
    {
        parent::__construct($message, 500, $previous);
        $this->model = $model;
    }

    public function getModel(): Model
    {
        return $this->model;
    }
}
