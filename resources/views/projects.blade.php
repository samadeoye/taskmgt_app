@php $page = 'projects'; @endphp

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Task Management App - Projects</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    
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
						<h4 class="page-title">Projects</h4>
					</div>

                    <div class="row justify-content-center">
						<div class="col-md-6">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if(Session::has('suc_msg'))
                            <div class="alert alert-success">{{ Session::get('suc_msg') }}</div>
                            @endif
                            @if(Session::has('err_msg'))
                            <div class="alert alert-danger">{{ Session::get('err_msg') }}</div>
                            @endif
                            
							<div class="card">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title">Add a Project</div>
									</div>
								</div>
								<div class="card-body">
                                    <form method="post" action="{{ route('projects.run') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label>Project Title</label>
                                            <input type="text" class="form-control" name="title" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-primary" value="Save Project">
                                        </div>
                                    </form>
								</div>
							</div>
						</div>
					</div>
					
                    <div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title">All Projects</div>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover">
											<thead>
												<tr>
													<th>S/N</th>
													<th>Title</th>
													<th>Date Created</th>
													<th>Status</th>
													<th>Actions</th>
												</tr>
											</thead>
											<tfoot>
												<tr>
													<th>S/N</th>
													<th>Title</th>
													<th>Date Created</th>
													<th>Status</th>
													<th>Actions</th>
												</tr>
											</tfoot>
											<tbody>
                                                @php $count = 1; @endphp
                                                @foreach($projects as $project)
                                                <tr>
                                                    <td>{{ $count }}</td>
                                                    <td>{{ $project->title }}</td>
                                                    <td>{{ $project->created_at }}</td>
                                                    <td>
                                                        @if($project->status == 1)
                                                        <span class="badge badge-success">Active</span>
                                                        @else
                                                        <span class="badge badge-danger">Inactive</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal{{$project->id}}">
                                                            Edit
                                                        </button>
                                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{ $project->id }}">
                                                          Delete
                                                        </button>

                                                        <!-- Edit Modal -->
                                                        <div class="modal fade" id="editModal{{$project->id}}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="editModalLabel">Edit Project</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form method="post" action="{{ route('projects.update') }}">
                                                                        @csrf
                                                                        <input type="hidden" name="project_id" value="{{ $project['id'] }}">
                                                                        <input type="hidden" name="action" value="edit">
                                                                        <div class="form-group">
                                                                            <label>Project Title</label>
                                                                            <input type="text" class="form-control" name="title" value="{{ $project->title }}" required>
                                                                        </div>
                                                                    
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <input type="submit" class="btn btn-primary" value="Save Changes" name="update_project">
                                                                </div>
                                                                </form>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Delete Modal -->
                                                        <div class="modal fade" id="deleteModal{{ $project->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="deleteModalLabel">Delete Project</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Are you sure you want to delete this project?</p>
                                                                    <form method="post" action="{{ route('projects.update') }}">
                                                                        @csrf
                                                                        <input type="hidden" name="project_id" value="{{ $project->id }}">
                                                                        <input type="hidden" name="action" value="delete">
                                                                    
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                    <input type="submit" class="btn btn-primary" value="Authorize" name="update_project">
                                                                </div>
                                                                </form>
                                                                </div>
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
            "ordering": false
		});
	});
</script>

</body>
</html>