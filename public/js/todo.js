$(document).ready(function () {
    var url = '/tasks';

    //display modal form for task editing
    $('.open-modal').click(function () {
        var task_id = $(this).val();
        $.get(url + '/' + task_id, function (data) {
            //success data
            console.log(data);
            $('#task_id').val(data.id);
            $('#task').val(data.task);
            $('#description').val(data.description);
            $('#btn-save').val("update");
            $('#done').val(data.done);
//            $('#myModal').modal('show');
            $('#myModal').modal('show');
        });
    });

    //display modal form for creating a NEW task
    $('#btn-add').click(function () {
        $('#btn-save').val('add');
        $('#frmTasks').trigger('reset');
        $('#myModal').modal('show');
        $('#myModal').on('shown.bs.modal', function () {
        });
    });

    //Delete a task and remove it from the list
    $('.delete-task').click(function (){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        var task_id = $(this).val();

        $.ajax({
            type: "DELETE",
            url: url + '/' +task_id,
            success: function (data) {
                console.log(data);
                $('#task' + task_id).remove();
            },
            error: function (data) {
                console.log('Error: ', data);
            }
        });
    });

    //Create a new task or UPDATE an existing task
    $('#btn-save').click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        e.preventDefault();
        if ($('#isComplete').is(":checked")){
            $compl = 1;
        }else{
            $compl = 0;
        }
        var formData = {
            task: $('#task').val(),
            description: $('#description').val(),
            done: $compl
        };

        //This section used to determine add or update
        var state = $('#btn-save').val();
        var type = "POST"; //creates ne resource
        var task_id = $('#task_id').val();
        var my_url = url;
        if (state == "update") {
            type = "PUT"; //updates and existing resource
            my_url += '/' + task_id;
        }
        $.ajax({
            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',
            success: function (data) {
//                console.log(data);
                var task = '<tr id="task' + data.id + '"><td>' + data.id + '</td><td>'
                    + data.task + '</td><td>' + data.description
                    + '</td><td>' + data.created_at + '</td><td>' + data.done + '</td>';
                task += '<td><button class="btn btn-warning btn-xs btn-detail open-modal" value="' + data.id + '">Edit</button>';
                task += '<button class="btn btn-danger btn-xs btn-delete delete-task" value="' + data.id + '">Delete</button></td></tr>';
//                console.log(task);
                if (state == "add"){ //for a NEW task
                    $('#tasks-list').append(task);
                }else{
                    $('#task' + task_id).replaceWith(task);
                }
                $('#frmTasks').trigger('reset');
                $('#myModal').modal('hide');
                location.reload();
            },
            error: function (data) {
                console.log('Error: ', data);
            }
        })
    });
});