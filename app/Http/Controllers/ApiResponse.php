<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response as IlluminateResponse;

/**
 * A useful interface for creating a templated API response
 * that follow the JSON API specs to send back to a client
 */
class ApiResponse extends JsonResponse
{

    protected $errors = [];
    protected $data = [];
    protected $statusCode = IlluminateResponse::HTTP_OK;

    /**
     * Adds an error to be returned
     *
     * @param $code Application-specific error code.
     * @param string $description Description for the error
     * @return $this
     */
    public function addError($description, $code)
    {
        $error = [$code => $description];

        if($code){
            $error['code'] = $code;
        }

        $this->errors[] = $error;
        return $this;
    }

    /**
     * Adds an array of errors to the response
     *
     * @param array $errors Errors to add
     * @return ApiResponse
     */
    public function addErrors($errors)
    {
        $this->errors = $errors;
        return $this;
    }

    /**
     * Builds the response to be returned to the client
     *
     * @param array $data Array of data to send back optionally
     * @param integer $statusCode HTTP status code
     * @return JsonResponse
     */
    public function respond($data = [], $statusCode = NULL)
    {
        // StatusCode passed in? Set it
        if (!is_null($statusCode)) {
            $this->setStatusCode($statusCode);
        }

        if (!empty($data)) {
            $this->data = $data;
        }

        // Check if a status code has been set. We NEED one of these, and we want to force the dev to give us one
        if (($this->getStatusCode() == IlluminateResponse::HTTP_OK) && (!empty($this->getErrors()))) {
            abort(500, 'Response can not have status code of 200 and contain errors at the same time.');
        }

        // Build the returning array
        $responseArray = [];

        if (!empty($this->errors)) {
            $responseArray['errors'] = $this->errors;
        } else {
            $responseArray = $data;
        }

        $this->setStatusCode($this->statusCode);
        $this->setContent(json_encode($responseArray));

        return $this;
    }

    /**
     * Gets the status code for this response
     *
     * @return integer
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * Gets the errors for this response
     *
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

}