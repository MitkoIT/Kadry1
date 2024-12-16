<div class="modal fade" id="jobPositionModal" tabindex="-1" role="dialog" aria-labelledby="deactivateEmploeeModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Stanowisko: <span id="jobPositionModalPosition"></span></h5>
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary-rgba" data-dismiss="modal">Zamknij</button>
                <a
                    id="editJobPosition"
                    class="btn btn-primary-rgba"
                    href="<?= base_url() ?>"
                    >Edytuj stanowisko
                </a>
                <a
                    id="newJobPosition"
                    class="btn btn-primary-rgba"
                    href="<?= base_url() ?>"
                    >Dodaj podległe stanowisko
                </a>
            </div>
        </div>
    </div>
</div>
<div class="horizontal-layout">   
    <div class="infobar-settings-sidebar-overlay"></div>
    <div id="containerbar" class="container-fluid">
        <div class="rightbar">
            <div class="contentbar">
                <div id="diagram-job-positions-container"></div>
            </div>
        </div>
    </div>
</div>
<script>
    const nodes = <?= $data['nodes'] ?>;
</script>
<script
    src="<?= base_url('public/assets/js/custom/custom-job-positions.js') ?>"
    data-base-url="<?= base_url() ?>"
    >
</script>