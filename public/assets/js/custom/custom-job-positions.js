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