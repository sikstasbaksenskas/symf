<?php

namespace App\Strategy;

use Symfony\Component\HttpFoundation\JsonResponse;

class JsonFormat implements FormatInterface
{
    private $key = 'json';

    public function canProcess($type)
    {
        return $type === $this->key;
    }

    public function process($all_orders)
    {
        //json response
        $myresponse = array(
            'success' => true,
            'content' => $all_orders
        );

        return new JsonResponse($myresponse);
    }
}
