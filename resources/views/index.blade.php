@php $page = 'index'; @endphp

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Task Management App - Dashboard</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<meta name="csrf-token" content="{{ csrf_token() }}">
    
    @include('components.head')
	
</head>
<body>
	<div class="wrapper">
		@include('components.header')

		@include('components.sidebar')

		<div class="main-panel">
			<div class="content">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Dashboard</h4>
					</div>
					<div class="row justify-content-center">
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-round">
								<div class="card-body ">
									<div class="row align-items-center">
										<div class="col-icon">
											<div class="icon-big text-center icon-primary bubble-shadow-small">
												<i class="fas fa-briefcase"></i>
											</div>
										</div>
										<div class="col col-stats ml-3 ml-sm-0">
											<div class="numbers">
												<p class="card-category">Projects</p>
												<h4 class="card-title">{{ $data['projects']->count() }}</h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-round">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col-icon">
											<div class="icon-big text-center icon-info bubble-shadow-small">
												<i class="fa fa-tasks"></i>
											</div>
										</div>
										<div class="col col-stats ml-3 ml-sm-0">
											<div class="numbers">
												<p class="card-category">Tasks</p>
												<h4 class="card-title">{{ $data['all_tasks']->count() }}</h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title">Recent Tasks</div>
									</div>
								</div>
								<div class="card-body">
									<h4 class="font-weight-bold py-2">Drag rows to reorder</h4>
									<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover">
											<thead>
												<tr>
                                                    <th>#</th>
													<th>S/N</th>
													<th>Name</th>
                                                    <th>Project</th>
                                                    <th>Priority</th>
													<th>Date Created</th>
													<th>Actions</th>
												</tr>
											</thead>
											<tbody>
                                                @php $count = 1; @endphp
                                                @foreach($data['tasks'] as $task)
                                                <tr class="row1" data-id="{{ $task->id }}">
                                                    <td><i class="fa fa-sort"></i></td>
                                                    <td>{{ $count }}</td>
                                                    <td>{{ $task->name }}</td>
                                                    @php $proj = App\Models\Project::where('id', $task->project_id)->first(); @endphp
                                                    <td>{{ $proj->title }}</td>
                                                    <td>{{ $task->priority }}</td>
                                                    <td>{{ $task->created_at }}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal{{$task->id}}">
                                                            Edit
                                                        </button>
                                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{ $task->id }}">
                                                          Delete
                                                        </button>

                                                        <!-- Edit Modal -->
                                                        <div class="modal fade" id="editModal{{$task->id}}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="editModalLabel">Edit Task</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form method="post" action="{{ route('tasks.update') }}">
                                                                        @csrf
                                                                        <input type="hidden" name="task_id" value="{{ $task['id'] }}">
                                                                        <input type="hidden" name="action" value="edit">
                                                                        <div class="form-group">
                                                                            <label>Task Name</label>
                                                                            <input type="text" class="form-control" name="name" value="{{ $task->name }}" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Project</label>
                                                                            <select name="project_id" class="form-control">
                                                                                <option value="" disabled selected>Select an option</option>
                                                                                @foreach($data['projects'] as $project)
                                                                                  <option value="{{ $project->id }}" @if($task->project_id == $project->id) selected @endif>{{ $project->title }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Priority</label>
                                                                            <input type="number" class="form-control" name="priority" value="{{ $task->priority }}" required>
                                                                        </div>
                                                                    
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <input type="submit" class="btn btn-primary" value="Save Changes" name="update_task">
                                                                </div>
                                                                </form>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Delete Modal -->
                                                        <div class="modal fade" id="deleteModal{{ $task->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="deleteModalLabel">Delete Task</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Are you sure you want to delete this task?</p>
                                                                    <form method="post" action="{{ route('tasks.update') }}">
                                                                        @csrf
                                                                        <input type="hidden" name="task_id" value="{{ $task->id }}">
                                                                        <input type="hidden" name="action" value="delete">
                                                                    
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                    <input type="submit" class="btn btn-primary" value="Authorize" name="update_task">
                                                                </div>
                                                                </form>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </td>
                                                </tr>
												@php $count++; @endphp
                                                @endforeach
                                            </tbody>
                                        </table>

                                    </div>

									@if($data['all_tasks']->count() == 0)
                                    <a href="/tasks" class="btn btn-primary">Create New</a>
                                    @else
                                    <a href="/tasks" class="btn btn-primary">See More</a>
                                    @endif

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
		</div>

	</div>
</div>

@include('components.foot')

<script>
	$(document).ready(function() {
		$('#basic-datatables').DataTable({
			"ordering": false,
			"paging": false,
			"info": false,
			"searching": false
		});
	});
</script>

<script type="text/javascript">
    $(function () {
      $( "#basic-datatables" ).sortable({
        items: "tr",
        cursor: 'move',
        opacity: 0.6,
        update: function(e) {
            updateTaskOrder();
        }
      });

        function updateTaskOrder() {
            var priority = [];
            var token = $('meta[name="csrf-token"]').attr('content');
            $('tr.row1').each(function(index, element) {
            priority.push({
                id: $(this).attr('data-id'),
                priority: index
            });
            });

            $.ajax({
            type: "POST",
            dataType: "json",
            url: "{{ url('tasks/updateOrder') }}",
            data: {
                priority: priority,
                _token: token
            },
                success: function(response) {
                    if(response['status'] == 'success') {
                        window.location.reload();
                    }
                    else {
                        console.log('re-order not successful.');
                    }
                }
           });
        }
    });
</script>

</body>
</html>