<?php

namespace App\Models;

use CodeIgniter\Model;

class JobPositionBudgetModel extends Model
{
    protected $table = 'job_position_budget';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $allowedFields = [
        'job_position_id',
        'budget_id',
        'is_deleted'
    ];

    public function getJobPositionBudgets(int $jobPositionId): array
    {
        return $this
            ->select('
                budget_id AS id,
                job_position_id AS jobPositionId
            ')
            ->where('job_position_id', $jobPositionId)
            ->where('is_deleted', null)
            ->findAll()
        ;
    }

    public function addJobPositionBudget(
        int $jobPositionId,
        int $budgetId
    ): int
    {
        return $this->insert([
            'job_position_id' => $jobPositionId,
            'budget_id' => $budgetId
        ]);
    }

    public function deleteJobPositionBudget(
        int $jobPositionId,
        int $budgetId
    ): int
    {
        return $this
            ->set(['is_deleted' => 1])
            ->where('job_position_id', $jobPositionId)
            ->where('budget_id', $budgetId)
            ->update()
        ;
    }

    public function getJobPositionsBudgets(): array
    {
        $response = [];
        $budgets = $this
            ->select('
                budget_id AS id,
                job_position_id AS jobPositionId
            ')
            ->join('job_position', 'job_position.id = job_position_budget.job_position_id')
            ->where('job_position_budget.is_deleted', null)
            ->where('job_position.is_deleted', null)
            ->findAll()
        ;

        foreach ($budgets as $budget) {
            $response[$budget->id] = $budget;
        }

        return $response;
    }
}
