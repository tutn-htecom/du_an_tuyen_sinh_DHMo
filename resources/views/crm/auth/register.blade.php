<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng nhập</title>
	<!-- include file css -->
	@include('includes.stylesheet')
</head>

<body class="b-crm-login">
	<!-- loadding -->
	@include('includes.loading')
	<!-- content -->
    <section class="sContent">
		<div class="container">
			<div class="row justify-content-sm-center">
				<div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9 d-general">
					<div class="text-center d-logo">
                        <img src="/assets/image/logo.png" alt="" id="crm-logo">
					</div>                    
					<div class="card shadow-lg my-4">
						<div class="card-body py-3">
							<div class="text-center my-4">
                                <h1 class="fs-4 card-title fw-bold mb-4">Đăng ký</h1>
                            </div>
							<div class="form-login px-4">
								<form autocomplete="off">
									{{ csrf_field() }}
									<div class="mb-3">
										<label class="title-14 mb-2 text-dark" for="email">Địa chỉ email</label>
										<input id="email" type="email" class="form-control input-form" name="email" value="" required  autocomplete="off"  placeholder="Nhập">
										<div class="title-14 pt-2 e-error-msg"></div>
									</div>
									<div class="mb-3 d-password">
										<label class="title-14 mb-2 text-muted" for="password">Mật khẩu</label>
										<input id="password" type="password" class="form-control input-form" name="password" required autocomplete="off"  placeholder="Nhập">
										<i class="fa fa-eye" aria-hidden="true" id="icon-show"></i>										
										<div class="title-14 pt-2 p-error-msg"></div>
									</div>
									<div class="align-items-center d-flex d-login my-2">
										<button type="button" class="btn btn-primary ms-auto w-100" id="btnRegister">
											Đăng ký
										</button>										
									</div>		
									<div class="title-14 crm-result"></div>
									<div class="align-items-center text-center my-4">
										<input type="checkbox" name="chkRemember" id="chkRemember"> 
										<span class="tilte-14 px-2">Ghi nhớ đăng nhập</span>
									</div>	
									
								</form>
							</div>
						</div>	
						<div class="text-center mb-5">
							<span class="title-14">Đã có tài khoản? </span>
							<a href="{{ route('crm.login') }}" class="text-primary title-14 lnkReister" style="text-decoration:none;">Đăng nhập</a>
						</div>					
					</div>
				</div>
			</div>
		</div>
	</section>
    <!-- include file js -->
	@include('includes.script')
</body>

</html>