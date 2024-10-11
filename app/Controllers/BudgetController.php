<?php

namespace App\Controllers;

use App\Models\BudgetModel;


class BudgetController extends BaseController
{
    public function getBudgets(): string
    {
        helper(['form']);

        $budgetModel = new BudgetModel();
        $data = [
            'budget_data' => $budgetModel
                ->getAllBudgets(),
            'header'    => 'Budżety'
        ];

        return view('Base/header', [
                'title' => 'Panel Administracyjny'
            ]).
            //view('Panels/side-bar').
            view('Panels/main-budget', $data).
            view('Base/footer');
    }

    public function getBudgetByName()
    {

        helper(['form']);
        $rules = [
            'budzet'  => 'required|min_length[2]|max_length[128]'
        ]; 

        if ($this->validate($rules)) { 
            $budgetModel = new BudgetModel();
            $data['budget_data'] = $budgetModel
                ->getBudgetByFirstLetter(
                $this->request->getVar('budzet')
            );
            $data['header'] = 'Wyniki Wyszukiwania';

            return view('Base/header', [
                'title' => 'Panel Administracyjny'
            ]).
           // view('Panels/side-bar').
            view('Panels/main-budget', $data).
            view('Base/footer');            

        } else {
            return redirect()->to('budget');
        }
    }

}
