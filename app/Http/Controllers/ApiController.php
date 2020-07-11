<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Response;

class ApiController extends Controller {

    protected $apiResponse = null;

    /**
     * ApiController constructor.
     */
    public function __construct()
    {
        $this->apiResponse = new ApiResponse();
    }

    /**
     * Respond to client
     *
     * @param array $data
     * @param null $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    public function respond($data = [], $statusCode = null)
    {
        return $this->apiResponse->respond($data, $statusCode);
    }

    /**
     * Respond success
     *
     * @param string $status
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondSuccess($status = "success")
    {
        $data = ['status' => $status];
        return $this->respond($data);
    }

    /**
     * Respond with Error
     *
     * @param $description
     * @param string $code
     * @param null $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondWithError($description, $code = 'general', $statusCode = null)
    {
        $statusCode = is_null($statusCode) ? Response::HTTP_BAD_REQUEST : $statusCode;

        return $this->apiResponse
            ->setStatusCode($statusCode)
            ->addError($description, $code)
            ->respond();
    }

    /**
     * 401 Unauthorized
     *
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondUnauthorized($message = 'Unauthorized request')
    {
        return $this->respondWithError($message, 'unauthorized', Response::HTTP_UNAUTHORIZED);
    }

    /**
     * 404 Not Found
     *
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondNotFound($message = 'Resource not found')
    {
        return $this->respondWithError($message, 'not_found', Response::HTTP_NOT_FOUND);
    }

    /**
     * 500 Internal Server Error
     *
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondInternalServerError($message = 'Internal Server Error')
    {
        return $this->respondWithError($message, 'server_error', Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * 422 Validation Failed
     *
     * @param array $errors
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondValidationFailed($errors)
    {
        return $this->apiResponse
            ->setStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->addErrors($errors)
            ->respond();
    }
}