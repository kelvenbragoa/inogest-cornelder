<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Inogest MassMeters, sistema de gestão">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="gestão, management, erp, human resource, inogest, inovatis, tecnologia, mozambique">

	<link rel="shortcut icon" href="storage/img/sys/logoinogesticon.png" />

	<title>Inogest</title>

	<link href="{{asset('template/css/app.css')}}" rel="stylesheet">
</head>

<body>
	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<h1 class="h2">{{__('text.welcome_back')}}</h1>
                            <h1 class="h2">Inogest - Inovatis</h1>
							<p class="lead">
								{{__('text.enter_your_account')}}
							</p>
						</div>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-4">
									<div class="text-center">
										<img src="storage/img/sys/logoinogestt.png" alt="inogest" class="img-fluid" width="350" height="250" />
									</div>
									<form method="POST" action="{{ route('login') }}">
                                        @csrf
										<div class="mb-3">
											<label class="form-label">{{__('text.email_address')}}</label>
											<input class="form-control form-control-lg @error('email') is-invalid @enderror" type="email" name="email" placeholder="{{__('text.enter_email')}}" required />
                                            @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
										</div>
										<div class="mb-3">
											<label class="form-label">{{__('text.password')}}</label>
											<input class="form-control form-control-lg @error('password') is-invalid @enderror" type="password" name="password" placeholder="{{__('text.enter_password')}}" required/>
											@error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <!--<small>
                                                <a href="pages-reset-password.html">Forgot password?</a>
                                            </small>-->
										</div>
										<!--<div>
											<label class="form-check">
                                            <input class="form-check-input" type="checkbox" value="remember-me" name="remember-me" checked>
                                            <span class="form-check-label">
                                            Remember me next time
                                            </span>
                                        </label>
										</div>-->
										<div class="text-center mt-3">
											<button type="submit" class="btn btn-lg btn-primary">{{__('text.sing_in')}}</a>
											<!-- <button type="submit" class="btn btn-lg btn-primary">Sign in</button> -->
										</div>
									</form>
									<!--<a href="{{ route('register') }}">Register</a>-->
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</main>

	<script src="js/app.js"></script>

</body>

</html>


