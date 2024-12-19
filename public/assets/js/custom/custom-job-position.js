/*
---------------------------------
    : Custom - Job Positions :
---------------------------------
*/
"use strict";

const scriptTag = document.currentScript;
const baseUrl = scriptTag.getAttribute('data-base-url');
const companyId = scriptTag.getAttribute('data-company-id');
const jobPostionId = scriptTag.getAttribute('data-job-position-id');

$('#addNodeEmployeeModalSelect').select2({
    dropdownParent: $("#addNodeEmployeeModal")
});

$('#addNodeBudgetModalSelect').select2({
    dropdownParent: $("#addNodeBudgetModal")
});

function addNodeEmployee() {
    const employeeId = $('#addNodeEmployeeModalSelect').val();

    $.ajax({
        url: baseUrl+'api/v1/job-position/'+jobPostionId+'/employees/'+employeeId,
        type: 'POST',
        success: function () {
            window.location.reload();
        },
        error: function (error) {
            console.log(error);
        }
    });
}

function addNodeBudget() {
    const budgetId = $('#addNodeBudgetModalSelect').val();

    $.ajax({
        url: baseUrl+'api/v1/job-position/'+jobPostionId+'/budgets/'+budgetId,
        type: 'POST',
        success: function () {
            window.location.reload();
        },
        error: function (error) {
            console.log(error);
        }
    });
}

function loadEmployeeToNodeEmployeeModal(employee) {
    const deleteNodeEmployeeModalUser = document.getElementById('deleteNodeEmployeeModalUser');
    const deleteNodeEmployeeModalId = document.getElementById('deleteNodeEmployeeModalId');
    
    deleteNodeEmployeeModalUser.innerText = employee.name;
    deleteNodeEmployeeModalId.value = employee.id;
}

function loadBudgetToNodeBudgetModal(budget) {
    const deleteNodeBudgetModalBudget = document.getElementById('deleteNodeBudgetModalBudget');
    const deleteNodeBudgetModalId = document.getElementById('deleteNodeBudgetModalId');
    
    deleteNodeBudgetModalBudget.innerText = budget.name;
    deleteNodeBudgetModalId.value = budget.id;
}

function deleteNodeEmployee() {
    const deleteNodeEmployeeModalId = document.getElementById('deleteNodeEmployeeModalId');
    const employeeId = deleteNodeEmployeeModalId.value;
    
    $.ajax({
        url: baseUrl+'api/v1/job-position/'+jobPostionId+'/employees/'+employeeId,
        type: 'DELETE',
        success: function () {
            window.location.reload();
        },
        error: function (error) {
            console.log(error);
        }
    });
}

function deleteNodeBudget() {
    const deleteNodeBudgetModalId = document.getElementById('deleteNodeBudgetModalId');
    const budgetId = deleteNodeBudgetModalId.value;
    
    $.ajax({
        url: baseUrl+'api/v1/job-position/'+jobPostionId+'/budgets/'+budgetId,
        type: 'DELETE',
        success: function () {
            window.location.reload();
        },
        error: function (error) {
            console.log(error);
        }
    });
}

function deleteJobPosition() {
    $.ajax({
        url: baseUrl+'api/v1/job-position/'+jobPostionId,
        type: 'DELETE',
        success: function () {
            window.location.href = baseUrl+'stanowiska/'+companyId;
        },
        error: function (error) {
            console.log(error);
        }
    });
}

function openChangeNodeEmployeeDescriptionModal(data) {
    const nodeEmployeeId = document.getElementById('nodeEmployeeId');
    const nodeEmployeeName = document.getElementById('nodeEmployeeName');
    const nodeEmployeeDescription = document.getElementById('nodeEmployeeDescription');
    $('#changeNodeEmployeeDescriptionModal').modal('show');

    nodeEmployeeId.value = data.id;
    nodeEmployeeName.innerHTML = data.name;
    nodeEmployeeDescription.value = data.description;
}

function saveNodeEmployeeDescription() {
    const nodeEmployeeId = document.getElementById('nodeEmployeeId');
    const nodeEmployeeDescription = document.getElementById('nodeEmployeeDescription');

    $.ajax({
        url: baseUrl+'api/v1/job-position/'+jobPostionId+'/employees/'+nodeEmployeeId.value,
        type: 'PUT',
        data: {
            description: nodeEmployeeDescription.value
        },
        success: function () {
            window.location.reload();
        },
        error: function (error) {
            console.log(error);
        }
    })
}