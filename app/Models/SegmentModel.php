<?php

namespace App\Models;

use CodeIgniter\Model;

class SegmentModel extends Model
{
    protected $table = 'segments';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'path',
        'name'
    ];

    public function getSegmentDetails(string $segment): \stdClass
    {
        return $this
            ->where('path', $segment)
            ->first()
        ;
    }
}
