
<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
  @include('partials.metas')
  
  <!-- PAGE TITLE HERE -->
  <title>Admin Dashboard</title>
  
  <!-- FAVICONS ICON -->
  @include('partials.styles')
    
</head>

<body class="vh-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-5">
                    <div class="form-input-content text-center error-page">
                        <h1 class="error-text  fw-bold">403</h1>
                        <h4><i class="fa fa-times-circle text-danger"></i> Forbidden Error!</h4>
                        <p>{{ $exception }}</p>
						<div>
                            <a class="btn btn-primary" href="{{ url('/dashboard') }}">Back to Dashboard</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!--**********************************
	Scripts
***********************************-->
<!-- Required vendors -->
@include('partials.scripts')
</body>
</html>