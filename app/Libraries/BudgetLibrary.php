<?php

namespace App\Libraries;

use App\Models\BudgetModel;

class BudgetLibrary
{
    private BudgetModel $budgetModel;

    public function __construct()
    {
        $this->budgetModel = new BudgetModel();
    }

    public function getBudgets(): array
    {
        return $this->budgetModel
            ->getBudgets()
        ;
    }
}
