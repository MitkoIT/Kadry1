<div class="modal fade" id="jobPositionModal" tabindex="-1" role="dialog" aria-labelledby="deactivateEmploeeModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Stanowisko: <span id="jobPositionModalPosition">{position}</span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input
                    type="hidden"
                    id="deactivateEmploeeModalId"
                    value=""
                />
                <p class="text-muted">Czy napewno chcesz zdezaktywować pracownika <span id="deactivateEmploeeModalUser">{name}</span>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary-rgba" data-dismiss="modal">Zamknij</button>
                <button type="button" class="btn btn-primary-rgba" onclick="deactivateEmployee()" data-dismiss="modal">Dodaj podległe stanowisko</button>
            </div>
        </div>
    </div>
</div>
<div class="horizontal-layout">   
    <div class="infobar-settings-sidebar-overlay"></div>
    <div id="containerbar" class="container-fluid">
        <div class="rightbar">
            <div class="contentbar">
                <div id="chart-container"></div>
            </div>
        </div>
    </div>
</div>
  <style type="text/css">

#chart-container {
  position: relative;
  overflow: auto;
  text-align: center;
  background: #fff;
}
    .chart-container { width: 100%; height: 100%; }
    .orgchart { background: #fff; }
    .orgchart .hierarchy::before,
    .orgchart .hierarchy::after {
        border-top: 1px solid #000;
    }
    .orgchart .node:before,
    .orgchart .node:after {
        background: #000 !important;
    }
    .orgchart .edge { display: none; }
    /*.orgchart td.left, .orgchart td.right, .orgchart td.top { border-color: #aaa; }
    .orgchart td>.down { background-color: #aaa; }
    /*.orgchart .middle-level .title { background-color: #006699; }
    .orgchart .middle-level .content { border-color: #006699; }
    .orgchart .product-dept .title { background-color: #009933; }
    .orgchart .product-dept .content { border-color: #009933; }
    .orgchart .rd-dept .title { background-color: #993366; }
    .orgchart .rd-dept .content { border-color: #993366; }
    .orgchart .pipeline1 .title { background-color: #996633; }
    .orgchart .pipeline1 .content { border-color: #996633; }
    .orgchart .frontend1 .title { background-color: #cc0066; }
    .orgchart .frontend1 .content { border-color: #cc0066; }

    .orgchart .title { background-color: red !important; }*/
  </style>
  

  <script type="text/javascript" src="https://dabeng.github.io/OrgChart/js/jquery.min.js"></script>
  <script type="text/javascript" src="https://dabeng.github.io/OrgChart/js/jquery.orgchart.js"></script>
  <script type="text/javascript">
    $(function() {

    var datascource = <?= $data['nodes'] ?>;/*{
      'name': 'Lao Lao',
      'title': 'general manager',
      'children': [
        { 'name': 'Bo Miao', 'title': 'department manager', 'className': 'middle-level',
          'children': [
            { 'name': 'Li Jing', 'title': 'senior engineer', 'className': 'product-dept' },
            { 'name': 'Li Xin', 'title': 'senior engineer', 'className': 'product-dept',
              'children': [
                { 'name': 'To To', 'title': 'engineer', 'className': 'pipeline1' },
                { 'name': 'Fei Fei', 'title': 'engineer', 'className': 'pipeline1' },
                { 'name': 'Xuan Xuan', 'title': 'engineer', 'className': 'pipeline1' }
              ]
            }
          ]
        },
        { 'name': 'Su Miao', 'title': 'department manager', 'className': 'middle-level',
          'children': [
            { 'name': 'Pang Pang', 'title': 'senior engineer', 'className': 'rd-dept' },
            { 'name': 'Hei Hei', 'title': 'senior engineer', 'className': 'rd-dept',
              'children': [
                { 'name': 'Xiang Xiang', 'title': 'UE engineer', 'className': 'frontend1' },
                { 'name': 'Dan Dan', 'title': 'engineer', 'className': 'frontend1' },
                { 'name': 'Dan Dan', 'title': 'engineer', 'className': 'frontend1' },
                { 'name': 'Dan Dan', 'title': 'engineer', 'className': 'frontend1' },
                { 'name': 'Dan Dan', 'title': 'engineer', 'className': 'frontend1' },
                { 'name': 'Dan Dan', 'title': 'engineer', 'className': 'frontend1' },
                { 'name': 'Dan Dan', 'title': 'engineer', 'className': 'frontend1' },
                { 'name': 'Zai Zai', 'title': 'engineer<input class="abc" type="hidden" value="123"/>', 'className': 'frontend1',
                  children: [
                    { 'name': 'Lang Lang', 'title': 'intern', 'className': 'frontend1' },
                    { 'name': 'Kui Kui', 'title': 'intern', 'className': 'frontend1' }
                  ]
                }
              ]
            }
          ]
        }
      ]
    };*/

    $('#chart-container').orgchart({
      'data' : datascource,
      'nodeContent': 'title',
    });

    $(".node").on("click", function() {
        $('#jobPositionModal').modal('show');

        const jobPositionModalPosition = document.getElementById('jobPositionModalPosition');
        const jobPositionId = $(this).find(".jobPositionId").val();

        $.ajax({
            url: '<?= base_url('api/v1/job-position/') ?>'+jobPositionId,
            type: 'GET',
            success: function(response) {
                console.log(response);
                jobPositionModalPosition.innerHTML = response.data.name;
            },
            error: function(error) {
                console.log(error);
            }
        });
    });

  });
  </script>