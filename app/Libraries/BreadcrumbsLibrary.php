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

    public function parse(array $type = []): array
    {
        $segments = service('uri')->getSegments();
        $response = [(new FormatLibrary())->toObject([
            'name' => 'Strona główna',
            'path' => '',
            'isLast' => false
        ])];

        foreach ($segments as $index => $segment) {
            $isLast = $index === count($segments) - 1 ? true : false; 

            if (isset($type[$index])) {
                if ($type[$index]['type'] === 'employee') {
                    $response[] = (new FormatLibrary())->toObject([
                        'name' => $type[$index]['user']->name,
                        'path' => 'pracownik/'.$type[$index]['user']->id,
                        'isLast' => $isLast
                    ]);
                } elseif ($type[$index]['type'] === 'company') {
                    $response[] = (new FormatLibrary())->toObject([
                        'name' => ucfirst(strtolower($type[$index]['company']->name)),
                        'path' => 'pracownicy/'.$type[$index]['company']->id,
                        'isLast' => $isLast
                    ]);
                } elseif ($type[$index]['type'] === 'jobPosition') {
                    $response[] = (new FormatLibrary())->toObject([
                        'name' => ucfirst($type[$index]['jobPosition']->name),
                        'path' => 'stanowisko/'.$type[$index]['jobPosition']->id,
                        'isLast' => $isLast
                    ]);
                }
            } else {
                $response[] = (new FormatLibrary())->toObject([
                    'name' => $this->getSegmentDetails($segment)->name,
                    'path' => $segment,
                    'isLast' => $isLast
                ]);
            }
        }

        return $response;
    }
}
