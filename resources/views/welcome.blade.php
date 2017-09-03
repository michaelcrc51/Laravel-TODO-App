<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel: Todo App</title>

        <!-- Bootstrap CSS CDN -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
        <style type="text/css">
            .space {
                margin-bottom: 1em;
            }
        </style>
    </head>
    <body>
        <div class="container-narrow">
            <h2>Laravel/Ajax Todo App</h2>
            <button type="button" id="btn-add" class="btn btn-primary btn-xs space">Add New Task</button>
            <div>
                <!-- Table to load data -->
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Task</th>
                            <th>Description</th>
                            <th>Date Created</th>
                            <th>Completed?</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="tasks-list" name="tasks-list">
                        @foreach($tasks as $task)
                            <tr id="task{{$task->id}}">
                                <td>{{$task->id}}</td>
                                <td>{{$task->task}}</td>
                                <td>{{$task->description}}</td>
                                <td>{{$task->created_at}}</td>
                                @if($task->done == 0)
                                    <td>NO</td>
                                    @else
                                    <td>YES</td>
                                 @endif
                                <td>
                                    <button class="btn btn-warning btn-xs btn-detail open-modal" value="{{$task->id}}">Edit</button>
                                    <button class="btn btn-danger btn-xs btn-delete delete-task" value="{{$task->id}}">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- End of table section -->
                <!-- Detail Modal Section -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span> </button>
                                <h4 class="modal-title" id="myModalLabel">Task Editor</h4>
                            </div>
                            <div class="modal-body">
                                <form id="frmTasks" name="frameTasks" class="form-horizontal" novalidate="">
                                    <div class="form-group error">
                                        <label for="task" class="col-sm-3 control-label">Task</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control has-error" id="task" name="task" placeholder="Task" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="description" class="col-sm-3" control-label>Description</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="description" name="description" placeholder="description" value="">
                                        </div>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" id="isComplete" name="isComplete" value="">
                                            Mark Task Complete? (Leave unchecked to make a task not complete again)
                                        </label>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn-primary" id="btn-save" value="add">Save Changes</button>
                                <input type="hidden" id="task_id" name="task_id" value="0">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <meta name="_token" content="{!! csrf_token() !!}" />
        <footer class="footer">
            <div class="container">
                <p class="text-muted">Access Laravel shared hosing instructions here: <a href="shared.blade.php">Laravel in a shared environment (NO CLI)</a> </p>
            </div>
        </footer>
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
        <script src="{{asset('js/todo.js')}}"></script>
    </body>
</html>
