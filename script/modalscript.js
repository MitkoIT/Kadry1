
const modal = document.getElementById('deactiveModal');
    modal.addEventListener('show.bs.modal', function (event) {
        // Get the button that triggered the modal
        const button = event.relatedTarget;

        // Extract data from data-* attributes
        const userId = button.getAttribute('data-userid');
        const userName = button.getAttribute('data-username');
        const path = button.getAttribute('data-path');

        // Update the modal's content
        const userNameSpan = modal.querySelector('#user-name');
        userNameSpan.textContent = userName;

        // Set the confirmation button's onclick action
        const confirmButton = modal.querySelector('#confirm-deactivate');
        confirmButton.onclick = function() {
            window.location = path + userId;
        };
    });
