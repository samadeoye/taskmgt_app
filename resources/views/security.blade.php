@php $page = 'security'; @endphp

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Task Management App - Security</title>
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
						<h4 class="page-title">Security</h4>
					</div>

					<div class="row justify-content-center">
						<div class="col-md-6">
							<div class="card">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title">Update Password</div>
									</div>
								</div>
								<div class="card-body">
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

                                    <form method="post" action="{{ route('security.run') }}">
                                        @csrf
										<label>Old Password</label>
										<div class="input-group mb-3">
										  <input type="password" class="form-control" name="old_password" required>
										    <div class="input-group-text show-password">
												<i class="flaticon-interface"></i>
											</div>
										</div>
										<label>New Password</label>
										<div class="input-group mb-3">
										  <input type="password" class="form-control" name="password" required>
										    <div class="input-group-text show-password">
												<i class="flaticon-interface"></i>
											</div>
										</div>
										<label>Confirm New Password</label>
										<div class="input-group mb-3">
										  <input type="password" class="form-control" name="password_confirmation" required>
										    <div class="input-group-text show-password">
												<i class="flaticon-interface"></i>
											</div>
										</div>
										<div class="input-group mb-3">
											<input type="submit" class="btn btn-primary" value="Save Changes">
										</div>
									</form>
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

</body>
</html>