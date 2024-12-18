<?php

namespace App\Libraries;

use App\Models\JobPositionModel;
use App\Models\JobPositionUserModel;
use App\Models\JobPositionNodeModel;
use App\Models\JobPositionBudgetModel;

class JobPositionLibrary
{
    private JobPositionModel $jobPositionModel;
    private JobPositionUserModel $jobPositionUserModel;
    private JobPositionNodeModel $jobPositionNodeModel;
    private JobPositionBudgetModel $jobPositionBudgetModel;

    public function __construct()
    {
        $this->jobPositionModel = new JobPositionModel();
        $this->jobPositionUserModel = new JobPositionUserModel();
        $this->jobPositionNodeModel = new JobPositionNodeModel();
        $this->jobPositionBudgetModel = new JobPositionBudgetModel();
    }

    public function getJobPositionDetails(int $jobPositionId): \stdClass
    {
        return $this->jobPositionModel
            ->getJobPositionDetails($jobPositionId)
        ;
    }

    public function getJobPositionUsersDetails(int $jobPositionId): array
    {
        return $this->jobPositionUserModel
            ->getJobPositionUsersDetails($jobPositionId)
        ;
    }

    public function getJobPositionSchema(\stdClass $company): string
    {
        $nodes = $this->jobPositionNodeModel->assembleNodes(
            $this->jobPositionModel
                ->getRootCompanyPosition(
                    $company->id
                )
            ,
            $this->jobPositionModel
                ->getJobPositions(
                    $company->id
                )
            ,
            $this->jobPositionUserModel
                ->getJobPositionUsers()
            ,
        );

        return json_encode($nodes);
    }

    public function setJobPosition(
        int $companyId,
        int $jobPositionId,
        array $data,
        array $companies,
        bool $newJobPosition = false
    ): int
    {
        if ($newJobPosition) {
            $newJobPositionId = $this->jobPositionModel->addJobPosition(
                $companyId,
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

    public function addJobPositionBudget(
        int $jobPositionId,
        int $budgetId
    ): int
    {
        return $this->jobPositionBudgetModel->addJobPositionBudget(
            $jobPositionId,
            $budgetId
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

    public function deleteJobPositionBudget(
        int $jobPositionId,
        int $budgetId
    ): int
    {
        return $this->jobPositionBudgetModel->deleteJobPositionBudget(
            $jobPositionId,
            $budgetId
        );
    }

    public function deleteJobPosition(int $jobPositionId): int
    {
        return $this->jobPositionModel
            ->deleteJobPosition($jobPositionId)
        ;
    }

    public function updateJobPositionEmployeeDescription(
        int $jobPositionId,
        int $employeeId,
        string $description
    ): int
    {
        return $this->jobPositionUserModel
            ->updateJobPositionUserDescription(
                $jobPositionId,
                $employeeId,
                $description
            )
        ;
    }

    protected function getNodeJobPosition(): array
    {
        $response = [];

        $jobPositions = $this->jobPositionModel
            ->getNodeJobPositions()
        ;

        foreach ($jobPositions as $jobPosition) {
            $response[$jobPosition->childId] = $jobPosition;
        }

        return $response;
    }

    protected function getJobPositionEmployees(): array
    {
        $response = [];

        $employees = $this->jobPositionModel
            ->getJobPositionEmployees()
        ;

        foreach ($employees as $employee) {
            $response[$employee->elementId][] = $employee;
        }

        return $response;
    }

    protected function parseEmployeeSchema(array $data): array
    {
        $response = [];
        $nodeJobPositions = $this->getNodeJobPosition();
        $employeesJobPositions = $this->getJobPositionEmployees();

        foreach ($data as $element) {
            $parent = null;

            if (!$element->isRoot &&
                !empty($nodeJobPositions[$element->elementId])) {
                $employees = [];

                foreach ($employeesJobPositions[$nodeJobPositions[$element->elementId]->elementId] as $employee) {
                    $employees[$employee->userId] = $employee;
                }

                $parent = (new FormatLibrary())->toObject([
                    'name' => $nodeJobPositions[$element->elementId]->name,
                    'employees' => $employees
                ]);
            }

            $response[$element->userId][] = [
                'params' => (new FormatLibrary())->toObject([
                    'isTopLevel' => $element->isRoot
                ]),
                'parent' => $parent,
                'child' => (new FormatLibrary())->toObject([
                    'name' => $element->name,
                    'isRoot' => $element->isRoot,
                    'description' => $element->description
                ])
            ];
        }

        return $response;
    }

    public function getEmployeesSchema()
    {
        return $this->parseEmployeeSchema(
            $this->jobPositionModel->getEmployeesJobPosition()
        );
    }

    public function getJobPositionBudgets(int $jobPositionId): array
    {
        return $this->jobPositionBudgetModel
            ->getJobPositionBudgets($jobPositionId)
        ;
    }
}
