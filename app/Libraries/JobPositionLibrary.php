<?php

namespace App\Libraries;

use App\Models\JobPositionModel;
use App\Models\JobPositionUserModel;
use App\Models\JobPositionNodeModel;

class JobPositionLibrary
{
    private JobPositionModel $jobPositionModel;
    private JobPositionUserModel $jobPositionUserModel;
    private JobPositionNodeModel $jobPositionNodeModel;

    public function __construct()
    {
        $this->jobPositionModel = new JobPositionModel();
        $this->jobPositionUserModel = new JobPositionUserModel();
        $this->jobPositionNodeModel = new JobPositionNodeModel();
    }

    public function getJobPositionDetails(int $jobPositionId): \stdClass
    {
        return $this->jobPositionModel
            ->getJobPositionDetails($jobPositionId)
        ;
    }

    public function getJobPositionSchema(
        string $type = null,
        \stdClass $company = null
    ): string
    {
        $nodes = $this->jobPositionNodeModel->assembleNodes(
            $this->jobPositionModel
                ->getJobPositions()
            ,
            $this->jobPositionUserModel
                ->getJobPositionUsers()
            ,
        );

        return json_encode($nodes);
    }

    public function setJobPosition(
        int $jobPositionId,
        array $data,
        array $companies,
        bool $newJobPosition = false
    ): int
    {
        if ($newJobPosition) {
            $newJobPositionId = $this->jobPositionModel->addJobPosition(
                $data['jobPosition']
            );

            $this->jobPositionNodeModel->addJobPosition(
                $jobPositionId,
                $newJobPositionId
            );

            return $newJobPositionId;
        } else {
            return $this->jobPositionModel->setJobPosition(
                $jobPositionId,
                $data['jobPosition']
            );
        }
    }

    public function addJobPositionEmployee(
        int $jobPositionId,
        int $employeeId
    ): int
    {
        return $this->jobPositionUserModel->addJobPositionUser(
            $jobPositionId,
            $employeeId
        );
    }    

    public function deleteJobPositionEmployee(
        int $jobPositionId,
        int $employeeId
    ): int
    {
        return $this->jobPositionUserModel->deleteJobPositionUser(
            $jobPositionId,
            $employeeId
        );
    }

    public function deleteJobPosition(int $jobPositionId): int
    {
        return $this->jobPositionModel
            ->deleteJobPosition($jobPositionId)
        ;
    }
}
