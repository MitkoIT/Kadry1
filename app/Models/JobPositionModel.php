<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Libraries\FormatLibrary;

class JobPositionModel extends Model
{
    protected $table = 'job_position';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $allowedFields = [
        'name',
        'company_id',
        'is_deleted',
    ];

    public function getJobPositionDetails(int $jobPositionId): \stdClass
    {
        return $this
            ->select('
                id,
                name,
                is_root AS isRoot
            ')
            ->where('id', $jobPositionId)
            ->first()
        ;
    }

    public function getJobPositions(int $companyId): array
    {
        return (new FormatLibrary())->index(
            $this
                ->select('
                    id,
                    name,
                    is_root AS isRoot
                ')
                ->where('company_id', $companyId)
                ->where('is_deleted', null)
                ->findAll()
            )
        ;
    }

    public function getRootCompanyPosition(int $companyId): \stdClass|null
    {
        return $this
            ->select('
                id,
                name
            ')
            ->where('company_id', $companyId)
            ->where('is_root', true)
            ->where('is_deleted', null)
            ->first()
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

    public function addJobPosition(
        int $companyId,
        array $data
    ): int
    {
        $this->insert([
            'company_id' => $companyId,
            'name' => $data['name']
        ]);

        return $this->insertID();
    }

    public function deleteJobPosition(int $jobPositionId): int
    {
        return $this
            ->set('is_deleted', true)
            ->where('id', $jobPositionId)
            ->update()
        ;
    }

    public function getEmployeesJobPosition(): array
    {
        return $this
            ->select('
                job_position.name,
                is_root As isRoot,
                company_id AS companyId,
                element_id AS elementId,
                user_id AS userId,
                description
            ')
            ->join('job_position_user', 'job_position_user.element_id = job_position.id')
            ->where('job_position.is_deleted', null)
            ->where('job_position_user.is_deleted', null)
            ->findAll()
        ;
    }

    public function getJobPositionEmployees(): array
    {
        return $this
            ->select('
                job_position_user.id,
                company_id AS companyId,
                element_id AS elementId,
                user_id AS userId,
                description
            ')
            ->join('job_position_user', 'job_position_user.element_id = job_position.id')
            ->where('job_position.is_deleted', null)
            ->where('job_position_user.is_deleted', null)
            ->findAll()
        ;
    }

    public function getNodeJobPositions(): array
    {
        return $this
            ->select('
                name,
                is_root AS isRoot,
                company_id AS companyId,
                element_id AS elementId,
                child_id AS childId
            ')
            ->join('job_position_node', 'job_position_node.element_id = job_position.id')
            ->where('job_position.is_deleted', null)
            ->findAll()
        ;
    }
}
