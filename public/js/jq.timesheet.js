
$(document).ready(function () {
    Timesheet = {
        elements: {
            addTimesheetBtn: $('#addTimesheet'),
            timesheetForm: $('#timesheetForm'),
            hideTimesheetBtn: $('#hideTimesheetForm'),
            deleteRecordModalButton: $('#deleteRecordModalButton'),
        },

        methods: {
            showForm: function () {
                Timesheet.elements.timesheetForm.removeClass('d-none');
            },
            hideForm: function () {
                Timesheet.elements.timesheetForm.addClass('d-none');
            },
            disable: function (route) {
                Timesheet.elements.deleteRecordModalButton.replaceWith('<button type="button" class="btn btn-primary" id="deleteRecordModalButton" onclick="document.location.href=\'' + route + '\'">Submit</button>')
            }
        },

        init: function() {
            // Show form
            Timesheet.elements.addTimesheetBtn.click(Timesheet.methods.showForm);

            // Hide form
            Timesheet.elements.hideTimesheetBtn.click(Timesheet.methods.hideForm);
        }
    }

    Timesheet.init();

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
});
