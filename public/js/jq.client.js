
$(document).ready(function () {
    Client = {
        elements: {
            addClientBtn: $('#AddClient'),
            newClientForm: $('#newClientForm'),
        },

        methods: {
            showForm: function () {
                console.log(4);
                Client.elements.newClientForm.removeClass('d-none');
            },
        },

        init: function() {
            Client.elements.addClientBtn.click(Client.methods.showForm);
        }
    }

    Client.init();
});
