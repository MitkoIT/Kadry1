/*
---------------------------------
    : Custom - Table Employees :
---------------------------------
*/
"use strict";

const scriptTag = document.currentScript;
const employeeSelect = document.getElementById('employeeSelect');
const baseUrl = scriptTag.getAttribute('data-base-url');
const companyId = scriptTag.getAttribute('data-company-id');

employeeSelect.addEventListener('change', (event) => {
    const value = event.target.value;
    let url = '';

    if (companyId === '') {
        url = baseUrl+'pracownicy';
        
        if (value === 'Aktywni') {
            url = baseUrl+'pracownicy/aktywni';
        } else if (value === 'Nieaktywni') {
            url = baseUrl+'pracownicy/nieaktywni';
        }
    } else {
        url = baseUrl+'pracownicy/'+companyId;
        
        if (value === 'Aktywni') {
            url = baseUrl+'pracownicy/'+companyId+'/aktywni';
        } else if (value === 'Nieaktywni') {
            url = baseUrl+'pracownicy/'+companyId+'/nieaktywni';
        }
    }
    window.location.href = url;
});

function loadEmployeeToModal(employee) {
    const deactivateEmploeeModalUser = document.getElementById('deactivateEmploeeModalUser');
    const deactivateEmploeeModalId = document.getElementById('deactivateEmploeeModalId');
    
    deactivateEmploeeModalUser.innerText = employee.name;
    deactivateEmploeeModalId.value = employee.id;
}

function deactivateEmployee() {
    const deactivateEmploeeModalId = document.getElementById('deactivateEmploeeModalId');
    const id = deactivateEmploeeModalId.value;
    
    $.ajax({
        url: scriptTag.getAttribute('data-base-url')+'pracownik/'+id+'/zdezaktywuj',
        type: 'PUT',
        success: function (response) {
            console.log(response);
        },
        error: function (error) {
            console.log(error);
        }
    });
}