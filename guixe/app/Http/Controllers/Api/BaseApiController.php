<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;
use Symfony\Component\HttpFoundation\Response;

class BaseApiController extends Controller
{
    public const MESSAGE_SUCCESS = 'SUCCESS';
    public const MESSAGE_ERROR = 'ERROR';

    public function errorResponse ($message = self::MESSAGE_ERROR, $data = [], $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR) {
        $data = !empty($data) ? $data : [];

        return response()->json(
            [
                'data' => $data,
                'msg' => $message,
                'status' => false
            ],
            $statusCode
        );
    }

    public function successResponse($message = self::MESSAGE_SUCCESS, $data = [], TransformerAbstract $transformer = null)
    {
        $data = !empty($data) ? $data : [];
        $data = $this->transform($data, $transformer);

        return response()->json(
            [
                'data' => $data,
                'msg' => $message,
                'status' => true
            ],
            Response::HTTP_OK
        );
    }

    public function successResponsePagination($message = self::MESSAGE_SUCCESS, $pagination = [], TransformerAbstract $transformer = null)
    {
        $data = !empty($pagination->getCollection()) ? $pagination->getCollection() : [];
        $data = $this->transform($data, $transformer);

        return response()->json(
            [
                'data' => $data,
                'per_page' => $pagination->perPage(),
                'last_page' => $pagination->lastPage(),
                'total' => $pagination->total(),
                'msg' => $message,
                'status' => true
            ],
            Response::HTTP_OK
        );
    }

    public function transform($data, $transformer)
    {
        if ($transformer instanceof TransformerAbstract) {
            $fractal = new Manager();

            if ($data instanceof \Illuminate\Database\Eloquent\Collection || is_array($data)) {
                $data = new Collection($data, $transformer);
            }

            if ($data instanceof Model) {
                $data = new Item($data, $transformer);
            }

            $data = $fractal->createData($data)->toArray();
        }
        return $data;
    }
}
