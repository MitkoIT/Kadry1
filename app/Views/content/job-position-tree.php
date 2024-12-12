
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Organization Chart Plugin</title>
  <link rel="icon" href="img/logo.png">
  <link rel="stylesheet" href="https://dabeng.github.io/OrgChart/css/jquery.orgchart.css">
  <link rel="stylesheet" href="https://dabeng.github.io/OrgChart/css/style.css">
  <style type="text/css">
    .orgchart { background: #fff; }
    .orgchart td.left, .orgchart td.right, .orgchart td.top { border-color: #aaa; }
    .orgchart td>.down { background-color: #aaa; }
    .orgchart .middle-level .title { background-color: #006699; }
    .orgchart .middle-level .content { border-color: #006699; }
    .orgchart .product-dept .title { background-color: #009933; }
    .orgchart .product-dept .content { border-color: #009933; }
    .orgchart .rd-dept .title { background-color: #993366; }
    .orgchart .rd-dept .content { border-color: #993366; }
    .orgchart .pipeline1 .title { background-color: #996633; }
    .orgchart .pipeline1 .content { border-color: #996633; }
    .orgchart .frontend1 .title { background-color: #cc0066; }
    .orgchart .frontend1 .content { border-color: #cc0066; }
  </style>
</head>
<body>
  <div id="chart-container"></div>

  <script type="text/javascript" src="https://dabeng.github.io/OrgChart/js/jquery.min.js"></script>
  <script type="text/javascript" src="https://dabeng.github.io/OrgChart/js/jquery.orgchart.js"></script>
  <script type="text/javascript">
    $(function() {

    var datascource = {
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
                { 'name': 'Zai Zai', 'title': 'engineer', 'className': 'frontend1' }
              ]
            }
          ]
        }
      ]
    };

    $('#chart-container').orgchart({
      'data' : datascource,
      'nodeContent': 'title'
    });

  });
  </script>
  </body>
</html>
<div class="horizontal-layout">   
    <div class="infobar-settings-sidebar-overlay"></div>
    <div id="containerbar" class="container-fluid">
        <div class="rightbar">
            <div class="contentbar">
                <div id="tree"></div>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    .orgchart { background: #fff; }
    .orgchart td.left, .orgchart td.right, .orgchart td.top { border-color: #aaa; }
    .orgchart td>.down { background-color: #aaa; }
    .orgchart .middle-level .title { background-color: #006699; }
    .orgchart .middle-level .content { border-color: #006699; }
    .orgchart .product-dept .title { background-color: #009933; }
    .orgchart .product-dept .content { border-color: #009933; }
    .orgchart .rd-dept .title { background-color: #993366; }
    .orgchart .rd-dept .content { border-color: #993366; }
    .orgchart .pipeline1 .title { background-color: #996633; }
    .orgchart .pipeline1 .content { border-color: #996633; }
    .orgchart .frontend1 .title { background-color: #cc0066; }
    .orgchart .frontend1 .content { border-color: #cc0066; }
  </style>
<style type="text/css">
    /*.orgchart .second-menu-icon {
        transition: opacity .5s;
        opacity: 0;
        right: -5px;
        top: -5px;
        z-index: 2;
        position: absolute;
    }
    .orgchart .second-menu-icon::before { background-color: rgba(68, 157, 68, 0.5); }
    .orgchart .second-menu-icon:hover::before { background-color: #449d44; }
    .orgchart .node:hover .second-menu-icon { opacity: 1; }
    .orgchart .node .second-menu {
        display: none;
        position: absolute;
        top: 0;
        right: -70px;
        border-radius: 35px;
        box-shadow: 0 0 10px 1px #999;
        background-color: #fff;
        z-index: 1;
    }
    .orgchart .node .second-menu .avatar {
        width: 60px;
        height: 60px;
        border-radius: 30px;
        float: left;
        margin: 5px;
    }*/

    /*.orgchart .node {
width: 200px !important;
height: 100px !important;
}*/

/*#tree {
  font-family: Arial;
  height: 320px;
  max-width: 1110px;
  border-radius: 5px;
  overflow: auto;
  text-align: center;
}*/
/*[data-n-id] rect {
            fill: #016e25;
        }

        [data-n-id='1'] rect {
            fill: #750000;
        }

        .node.red rect {
            fill: blue;
        }
        
        .field_0 {
            width: 100px;
            font-family: Impact;
            text-transform: uppercase;
            fill: #cfcfcf;
        }

        .field_1 {
            fill: #cfcfcf;
        }

        [data-l-id] path {
            stroke: #750000;
        }

        [data-l-id='[3][4]'] path {
            stroke: #016e25;
        }

        [data-ctrl-ec-id] circle {
            fill: #750000 !important;
        }

        [data-ctrl-ec-id='3'] circle {
            fill: #016e25 !important;
        }*/
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!--<script type="text/javascript" src="<?= base_url('public/assets/js/jquery.min.js') ?>"></script>-->
<!--<script type="text/javascript" src="<?= base_url('public/assets/js/jquery.orgchart.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('public/assets/js/orgchart.js') ?>"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/orgchart/4.0.1/js/jquery.orgchart.min.js"></script>
<script type="text/javascript">
    /*OrgChart.templates.greyTemplate = Object.assign({}, OrgChart.templates.ula);
    OrgChart.templates.greyTemplate.size = [20, 110];

    let chart = new OrgChart("#tree", {
        enableSearch: false,
        mouseScrool: OrgChart.action.scroll,
        nodeWidth: 100,
        nodeHeight: 100,
        nodeBinding: {
            field_0: "name"
        },
        nodes: <?= $data['nodes'] ?>
    });*/

    /*$(function() {

var datascource = {
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
            { 'name': 'Zai Zai', 'title': 'engineer', 'className': 'frontend1' }
          ]
        }
      ]
    }
  ]
};

$('#tree').orgchart({
  'data' : datascource,
  'nodeContent': 'title'
});

});*/

    /*$(function() {

        require('orgchart');

    var datascource = {
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
                { 'name': 'Zai Zai', 'title': 'engineer', 'className': 'frontend1' }
              ]
            }
          ]
        }
      ]
    };

    $('#chart-container').orgchart({
      'data' : datascource,
      'nodeContent': 'title'
    });

  });*/
</script>