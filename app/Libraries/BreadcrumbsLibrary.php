<?php

namespace App\Libraries;

use App\Models\SegmentModel;
use App\Libraries\FormatLibrary;

class BreadcrumbsLibrary
{
    private SegmentModel $segmentModel;

    public function __construct()
    {
        $this->segmentModel = new SegmentModel();
    }

    protected function getSegmentDetails(string $segment): \stdClass
    {
        return $this
            ->segmentModel
            ->getSegmentDetails($segment)
        ;
    }

    public function parse(): array
    {
        $segments = service('uri')->getSegments();
        $response = [(new FormatLibrary())->toObject([
            'name' => 'Strona główna',
            'path' => '',
            'isLast' => false
        ])];

        foreach ($segments as $index => $segment) {
            $isLast = $index === count($segments) - 1 ? true : false; 

            $response[] = (new FormatLibrary())->toObject([
                'name' => $this->getSegmentDetails($segment)->name,
                'path' => $segment,
                'isLast' => $isLast
            ]);
        }

        return $response;
    }
}
