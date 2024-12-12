<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Libraries\FormatLibrary;

class JobPositionModel extends Model
{
    protected $table = 'job_position';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $allowedFields = ['name'];

    public function getJobPositionDetails(int $jobPositionId): \stdClass
    {
        return $this
            ->select('
                id,
                name
            ')
            ->where('id', $jobPositionId)
            ->first()
        ;
    }

    public function getJobPositions(): array
    {
        return (new FormatLibrary())->index(
            $this
                ->select('
                    id,
                    name
                ')
                ->findAll()
            )
        ;
    }

    public function setJobPosition(
        int $jobPositionId,
        array $data
    ): int
    {
        $this
            ->set('name', $data['name'])
            ->where('id', $jobPositionId)
            ->update()
        ;

        return $jobPositionId;
    }

    public function addJobPosition(array $data): int
    {
        $this->insert($data);

        return $this->insertID();
    }
}
