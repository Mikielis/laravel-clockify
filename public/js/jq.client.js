
$(document).ready(function () {
    Client = {
        elements: {
            addClientBtn: $('#addClient'),
            clientForm: $('#clientForm'),
            hideClientBtn: $('#hideClientForm'),
            deleteRecordModalButton: $('#deleteRecordModalButton'),
        },

        methods: {
            showForm: function () {
                Client.elements.clientForm.removeClass('d-none');
            },
            hideForm: function () {
                Client.elements.clientForm.addClass('d-none');
            },
            disable: function (route) {
                Client.elements.deleteRecordModalButton.replaceWith('<button type="button" class="btn btn-primary" id="deleteRecordModalButton" onclick="document.location.href=\'' + route + '\'">Submit</button>')
            }
        },

        init: function() {
            // Show form
            Client.elements.addClientBtn.click(Client.methods.showForm);

            // Hide form
            Client.elements.hideClientBtn.click(Client.methods.hideForm);
        }
    }

    Client.init();
});
