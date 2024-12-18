<?php

namespace App\Models;

use CodeIgniter\Model;

class BudgetModel extends Model
{
    protected $DBGroup = 'od';
    protected $table = 'd_budzet';
    protected $tabled_firma = 'd_firma';
    protected $tabled_cel = 'd_cel';
    protected $returnType = 'object';

    protected $allowedFields = [ 
        'budzet_nazwa',
        'id_cel',
        'id_firma',
    ]; 


    public function getBudgets(): array
    {
        $response = [];
        $budgets = $this
            ->select('
                id_budzet AS id,
                budzet_nazwa AS name,
                id_cel AS goalId,
                id_firma AS companyId
            ')
            ->findAll()
        ;

        foreach ($budgets as $budget) {
            $response[$budget->id] = $budget;
        }

        return $response;
    }
}
