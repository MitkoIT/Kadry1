
<script>
    $(document).ready(function() {
        notify(<?= json_encode($data['notifications']) ?>);
    });

    function notify(notifications) {
        for (let i = 0; i < notifications.length; i++) {
            if (notifications[i].type === 'save-success') {
                new PNotify({
                    title: 'Zapisano zmiany', text: '', type: 'success'
                });
            }

            if (notifications[i].type === 'added-employee') {
                new PNotify({
                    title: 'Dodano pracownika', text: '', type: 'success'
                });
            }

            if (notifications[i].type === 'deactivated-employee') {
                new PNotify({
                    title: 'Zdezaktywowano pracownika', text: '', type: 'success'
                });
            }

            if (notifications[i].type === 'added-job-position') {
                new PNotify({
                    title: 'Dodano stanowisko', text: '', type: 'success'
                });
            }

            if (notifications[i].type === 'added-employee-to-job-position') {
                new PNotify({
                    title: 'Dodano pracownika do stanowiska', text: '', type: 'success'
                });
            }

            if (notifications[i].type === 'changed-employee-job-position-description') {
                new PNotify({
                    title: 'Zapisano opis pracownika', text: '', type: 'success'
                });
            }

            if (notifications[i].type === 'deleted-employee-from-job-position') {
                new PNotify({
                    title: 'Usunięto pracownika ze stanowiska', text: '', type: 'success'
                });
            }

            if (notifications[i].type === 'added-budget-to-job-position') {
                new PNotify({
                    title: 'Dodano budżet do stanowiska', text: '', type: 'success'
                });
            }

            if (notifications[i].type === 'deleted-budget-from-job-position') {
                new PNotify({
                    title: 'Usunięto budżet ze stanowiska', text: '', type: 'success'
                });
            }

            if (notifications[i].type === 'deleted-job-position') {
                new PNotify({
                    title: 'Usunięto stanowisko', text: '', type: 'success'
                });
            }
        }
    }
</script>