<?php

namespace App\Libraries;

class FormatLibrary
{
    public function toObject(array $data): \stdClass
    {
        return json_decode(
            json_encode(
                $data
            ),
            false
        );
    }

    public function index(array $data): array
    {
        $response = [];

        foreach ($data as $element) {
            $response[$element->id] = $element;
        }

        return $response;
    }
}
