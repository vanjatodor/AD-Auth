<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppController extends ApiController
{
    /**
     * Initialize the app
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function initialize()
    {
        $data = [
            'user' => auth()->user(),
            'appConfig' => [],
        ];

        return $this->respond($data);
    }
}