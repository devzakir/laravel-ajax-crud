$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// Create Task
$('#createTaskForm').submit(function (e) {
    e.preventDefault();

    let msg = $('#createTaskMessage');
    // Form data
    let input = $('#createTaskForm input[name="name"]');
    let formData = {
        name: $(input).val()
    }

    $.ajax({
        type: 'POST',
        url: '/task/store',
        data: formData,
        success: function (data) {
            // reqest message clear
            $(msg).html('');

            // Show success message
            $(msg).append('<div class="alert alert-success"> Task Created Successfully </div>');

            // input value clear
            $(input).val('');

            // append result
            $('#taskTableBody').prepend(`
                <tr data-id="` + data.id + `">
                    <td> ` + data.id + ` </td>
                    <td> ` + data.name + ` </td>
                    <td style="width:150px">
                        <a href="#" data-toggle="modal" data-target="#editTask" class="btn btn-sm btn-primary edit">Edit</a>
                        <a href="#" data-toggle="modal" data-target="#deleteTask"  class="btn btn-sm btn-danger delete">Delete</a>
                    </td>
                </tr>
            `);
        },
        error: function (error) {
            $(msg).html('');

            $(msg).append('<ul id="errorMessage" class="alert alert-danger"></ul>')

            $.each(error.responseJSON.errors, function (index, value) {
                console.log(value[0]);
                $(msg).find('#errorMessage').append(`
                    <li>` + value[0] + ` </li>
                `);
            });
        }
    })
});

// Edit Task
$(document).on('click', '.edit', function () {
    let task = $(this).closest('tr').data('id');
    let modal = $('#editTaskForm');

    $.ajax({
        type: 'GET',
        url: 'task/edit/' + task,
        success: function (data) {
            $(modal).find('#editInput').val(data.name);
            $(modal).attr('data-id', data.id);
        },
        error: function (error) {
            console.log(error);
        }
    });
});

// Update Task
$('#editTaskForm').submit(function (e) {
    e.preventDefault();

    let msg = $('#editTaskMessage');
    let id = $('#editTaskForm').data('id');
    // Form data
    let input = $('#editTaskForm #editInput');
    let formData  = {
        name: $(input).val()
    }

    console.log(id);
    console.log($('#editTaskForm').data('id'));

    $.ajax({
        type: 'POST',
        url: '/task/update/'+ id,
        data: formData,
        success: function(data){
            // reqest message clear
            $(msg).html('');

            // Show success message
            $(msg).append('<div class="alert alert-success"> Task updated successfully </div>');

            // input value clear
            $(input).val('');

            // append result


            let taskRow = $('#taskTableBody').find('tr[data-id="'+id+'"]');
            $(taskRow).find('td.task-name').text(data.name);
        },
        error: function(error){
            $(msg).html('');

            $(msg).append('<ul id="errorMessage" class="alert alert-danger"></ul>')

            $.each(error.responseJSON.errors, function(index, value){
                console.log(value[0]);
                $(msg).find('#errorMessage').append(`
                    <li>`+ value[0] +` </li>
                `);
            });
        }
    })
});


// Delete Popup
$(document).on('click', '.delete', function () {
    let task = $(this).closest('tr').data('id');
    let modal = $('#deleteTaskForm');

    // Delete Confirmation
    $('#deleteTaskForm button[type="submit"]').click({
        id: task
    }, call_ajax);

    // Ajax call using function
    function call_ajax(event) {
        let msg = $('#deleteTaskMessage');
        let id = event.data.id;
        $.ajax({
            type: 'POST',
            url: '/task/delete/' + id,
            success: function (data) {
                // reqest message clear
                $(msg).html('');

                $('#deleteTaskForm').find('h4').remove();
                $('#deleteTaskForm').find('button[type="submit"]').remove();

                // Show success message
                $(msg).append('<div class="alert alert-success"> Task deleted successfully </div>');

                let taskRow = $('#taskTableBody').find('tr[data-id="' + id + '"]');
                $(taskRow).remove();
                console.log('task deleted');
            },
            error: function (error) {

            }
        })
    }
});


$('#deleteTaskForm').submit(function (e) {
    e.preventDefault();
});

// create modal set to default
$('#createTask').on('hidden.bs.modal', function (e) {
    $('#createTaskForm').find('#createTaskMessage').html('');
})

// edit modal set to default
$('#editTask').on('hidden.bs.modal', function (e) {
    $('#editTaskForm').find('#editTaskMessage').html('');
})

// delete modal set to default
$('#deleteTask').on('hidden.bs.modal', function (e) {
    modal = $('#deleteTaskForm');
    $(modal).find('#deleteTaskMessage').html('');
    $(modal).find('.modal-body').html('').append(`
        <div id="deleteTaskMessage"></div>
        <h4>Are you you want to delete this?</h4>
    `);
    $(modal).find('.modal-footer').html('').append(`
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger">Yes, Delete</button>
    `);
})
