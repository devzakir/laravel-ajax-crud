<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>Laravel & Ajax CRUD Application!</title>
  </head>
  <body>
    <header class="mt-5 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1> Laravel & Ajax CRUD Application! </h1>
                    <hr>
                </div>
            </div>
        </div>
    </header>
    <section class="body">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="mb-0">Alll Task</h3>
                            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#createTask">Create Task</a>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th> ID </th>
                                        <th> Task Name </th>
                                        <th style="width:150px"> Action </th>
                                    </tr>
                                </thead>
                                <tbody id="taskTableBody">
                                    @foreach($tasks as $task)
                                    <tr data-id="{{ $task->id }}">
                                        <td> {{ $task->id }} </td>
                                        <td class="task-name"> {{ $task->name }} </td>
                                        <td style="width:150px">
                                            <a href="#" data-toggle="modal" data-target="#editTask" class="btn btn-sm btn-primary edit">Edit</a>
                                            <a href="#" data-toggle="modal" data-target="#deleteTask"  class="btn btn-sm btn-danger delete">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

  <!-- Create Modal -->
  <div class="modal fade" id="createTask" tabindex="-1" role="dialog" aria-labelledby="createTaskTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
          <form id="createTaskForm">
            <div class="modal-header">
            <h5 class="modal-title" id="createTaskTitle">Create Task</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div id="createTaskMessage"></div>
                <div class="form-group">
                    <label for="">Enter task name</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter task name">
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Create Task</button>
            </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Edit Modal -->
  <div class="modal fade" id="editTask" tabindex="-1" role="dialog" aria-labelledby="editTaskTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
          <form id="editTaskForm">
            <div class="modal-header">
            <h5 class="modal-title" id="editTaskTitle">Edit Task</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div id="editTaskMessage"></div>
                <div class="form-group">
                    <label for="">Enter task name</label>
                    <input type="text" id="editInput" class="form-control" name="name" placeholder="Enter task name">
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Update Task</button>
            </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Delete Modal -->
  <div class="modal fade" id="deleteTask" tabindex="-1" role="dialog" aria-labelledby="deleteTaskTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
          <form id="deleteTaskForm">
            <div class="modal-header">
            <h5 class="modal-title" id="deleteTaskTitle">Delete Task</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body text-center">
                <div id="deleteTaskMessage"></div>
                <h4>Are you you want to delete this?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger">Yes, Delete</button>
            </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  {{-- <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="{{ asset('js') }}/main.js"></script>
  </body>
</html>
