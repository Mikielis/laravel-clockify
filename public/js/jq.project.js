
$(document).ready(function () {
    Project = {
        elements: {
            addProjectBtn: $('#addProject'),
            projectForm: $('#projectForm'),
            hideProjectBtn: $('#hideProjectForm'),
            deleteRecordModalButton: $('#deleteRecordModalButton'),
        },

        methods: {
            showForm: function () {
                Project.elements.projectForm.removeClass('d-none');
            },
            hideForm: function () {
                Project.elements.projectForm.addClass('d-none');
            },
            disable: function (route) {
                Project.elements.deleteRecordModalButton.replaceWith('<button type="button" class="btn btn-primary" id="deleteRecordModalButton" onclick="document.location.href=\'' + route + '\'">Submit</button>')
            }
        },

        init: function() {
            // Show form
            Project.elements.addProjectBtn.click(Project.methods.showForm);

            // Hide form
            Project.elements.hideProjectBtn.click(Project.methods.hideForm);
        }
    }

    Project.init();

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
});
