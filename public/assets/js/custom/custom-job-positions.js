/*
---------------------------------
    : Custom - Job Positions :
---------------------------------
*/
"use strict";

const scriptTag = document.currentScript;
const baseUrl = scriptTag.getAttribute('data-base-url');
const companyId = scriptTag.getAttribute('data-company-id');

$(function() {
    $('#diagram-job-positions-container').orgchart({
        'data' : nodes,
        'nodeContent': 'title',
        'pan': false
    });

    $(".node").on("click", function() {
        $('#jobPositionModal').modal('show');

        const jobPositionModalPosition = document.getElementById('jobPositionModalPosition');
        const jobPositionId = $(this).find(".jobPositionId").val();
        const editJobPosition = document.getElementById('editJobPosition');
        const newJobPosition = document.getElementById('newJobPosition');

        $.ajax({
            url: baseUrl+'api/v1/job-position/'+jobPositionId,
            type: 'GET',
            success: function(response) {
                editJobPosition.href = baseUrl+'stanowisko/'+companyId+'/'+jobPositionId;
                newJobPosition.href = baseUrl+'stanowisko/'+companyId+'/'+jobPositionId+'/nowy';
                jobPositionModalPosition.innerHTML = response.data.name;
            },
            error: function(error) {
                editJobPosition.href = baseUrl+'stanowiska';
                newJobPosition.href = baseUrl+'stanowiska';
                jobPositionModalPosition.innerHTML = '';
                console.log(error);
            }
        });
    });
});

$('#diagramEmployeeId').select2({});
$("#diagramEmployeeId").on("change", function() {
    const employeeId = $(this).val();

    $('.node').each(function() {
        $(this).find('.title').removeClass('employee-found');
        $(this).find('.content').removeClass('employee-found');
    });

    $('.node').each(function() {
        if ($(this).find('.employee-id-'+employeeId).length) {
            $(this).find('.title').addClass('employee-found');
            $(this).find('.content').addClass('employee-found');
        }
    });
});