<?php

namespace App\Controllers;

use App\Models\BudgetModel;
use App\Models\UserModel;
use App\Models\BudgetOwnerModel;
use App\Models\BudgetSemiownerModel;


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
        $userModel = new UserModel();
        $budgetOwnerModel = new BudgetOwnerModel();
        $budgetSemiownerModel = new BudgetSemiownerModel();

        $data = [
            'budget_data' => $budgetModel->getBudgetByIdWithCompany($budgetId),
            'company_list'   => $budgetModel->getAllBudgetCompanys(),
            'target_list'    => $budgetModel->getAllBudgetTargets(),
            'user_data'      => $userModel->getAllUsers(),
            'owner_id'       => $budgetOwnerModel->getBudgetOwnerByBudgetId($budgetId),
            'semiowner_id'   => $budgetSemiownerModel->getBudgetSemiownerByBudgetId($budgetId),
            'validation'     =>  $this->validator
        ];

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
            'user_data'      => $userModel->getAllUsers(),
            'validation'     =>  $this->validator
        ];

        
        return view('Base/header', [
            'title' => 'Budżet - Dodaj'
        ]).
        view('Panels/side-bar').
        view('Panels/main-budget-add', $data).
        view('Base/footer');       
    }

    public function setBudgetDataForAdd()
    {
        helper(['form']);

        $rules = [
            'cel'   => 'required',
            'owner' => 'required',
            'semiowner' => 'required',
            'name'  => [
                'rules' => 'required|min_length[2]|Max_length[128]',
                'label' => 'Name',
                'errors' => [
                    'required' => 'Musisz wprowadzić nazwę nowego budżetu.',
                    'min_length' => 'Minimum 2 znaki w Nazwie',
                    'max_length' => 'Maksimum 255 znaków w Imię i Nazwisko.'
                ]
            ], 
        ]; 
          
        if ($this->validate($rules)) {
            $budgetModel = new BudgetModel();
            $budgetOwnerModel = new BudgetOwnerModel();
            $budgetSemiownerModel = new BudgetSemiownerModel();
            $data = [
                'budzet_nazwa'  => $this->request->getPost('name'),
                'id_cel'        => $this->request->getPost('cel'),
                'id_firma'      => $this->request->getPost('firma')
            ];

            $budgetId = $budgetModel->getNextId();

            $budgetModel->insert($data);
            $budgetOwnerModel->insert(
                $ownerData = [
                    'id_budzet' => $budgetId,
                    'id_wlasciciel' => $this->request->getPost('owner')
                ]
            );

            $budgetSemiownerModel->insert(
                $semiownerData = [
                    'id_budzet' => $budgetId,
                    'id_zastepca' => $this->request->getPost('semiowner')
                ]
            );


            session()->setFlashdata('success', 'Budżet został dodany poprawnie.');
            return redirect()->to('budget-allbudgets');
        } else {
            return $this->editBudgetDataForAdd();
        }
    }
}
