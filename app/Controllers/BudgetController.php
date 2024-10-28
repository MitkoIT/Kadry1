<?php

namespace App\Controllers;

use App\Models\BudgetModel;
use App\Models\UserModel;


class BudgetController extends BaseController
{
    public function getBudgets(): string
    {
        helper(['form']);

        $budgetModel = new BudgetModel();
        $data = [
            'budget_data' => $budgetModel
                ->getAllBudgetsWithCompany(),
            'header'    => 'Budżety'
        ];

        return view('Base/header', [
                'title' => 'Panel Administracyjny'
            ]).
            view('Panels/side-bar').
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
                ->getBudgetByFirstLetterWithCompany(
                $this->request->getVar('budzet')
            );
            $data['header'] = 'Wyniki Wyszukiwania';

            return view('Base/header', [
                'title' => 'Panel Administracyjny'
            ]).
            view('Panels/side-bar').
            view('Panels/main-budget', $data).
            view('Base/footer');            

        } else {
            return redirect()->to('budget');
        }
    }

    public function editBudgetDataForEdit(int $budgetId)
    {
        helper(['form']);
        $budgetModel = new BudgetModel();

        $data = [
            'budget_data' => $budgetModel->getBudgetByIdWithCompany($budgetId),
        ];

        //tutaj pobrac pracownikow i wlasciciela i zastepce budzetu


        return view('Base/header', [
            'title' => 'Budżet - Zarządzanie'
        ]).
        view('Panels/side-bar').
        view('Panels/main-budget-edit', $data).
        view('Base/footer');       
    }

    public function editBudgetDataForAdd()
    {
        helper(['form']);
        $budgetModel = new BudgetModel();
        $userModel = new UserModel();

        $data = [
            'header'         => 'Dodaj Budżet',
            'company_list'   => $budgetModel->getAllBudgetCompanys(),
            'target_list'    => $budgetModel->getAllBudgetTargets(),
            'user_data'      => $userModel->getAllUsers()
        ];

        
        return view('Base/header', [
            'title' => 'Budżet - Dodaj'
        ]).
        view('Panels/side-bar').
        view('Panels/main-budget-add', $data).
        view('Base/footer');       
    }

}
