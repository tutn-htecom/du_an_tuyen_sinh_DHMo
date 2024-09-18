<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tuyển sinh - Đại học Mở HCM | @yield('title')</title>
	<!-- include file css -->
	@include('includes.stylesheet')
</head>

<body class="body-regiter-profile">
    <section class="h-100 sContent">
		<div class="container h-100">
			<div class="row justify-content-sm-center h-100">
				<div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9 d-general">
					<div class="text-center my-5 d-logo">
                        <img src="/assets/image/logo.png" alt="" id="logo-register-profile">
					</div>
                    <div class="text-center mb-3  d-logo text-light">
                        <span style="color:#fff">
                        Chào mừng bạn đến với trang đăng ký hồ sơ tuyển sinh của trường Đại học Mở TP.Hồ Chí Minh
                        </span>
					</div>
					<div class="card shadow-lg">
						<div class="card-body py-5">
							<div class="text-center">
                                <h1 class="fs-4 card-title fw-bold mb-4">Đăng nhập để theo dõi kết quả hồ sơ</h1>
                            </div>
							<div class="form-login px-4">
								<form autocomplete="off">
									<div class="mb-3">
										<label class="mb-2 text-dark" for="email">Địa chỉ email</label>
										<input id="email" type="email" class="form-control" name="email" value="" required  autocomplete="off"  placeholder="Nhập">
										<div class="error-message"></div>
									</div>
									<div class="mb-3">
										<label class="mb-2 text-muted" for="password">Mật khẩu</label>
										<input id="password" type="password" class="form-control" name="password" required autocomplete="off"  placeholder="Nhập">
										<div class="error-message"></div>
									</div>
									<div class="align-items-center d-flex d-login">
										<button type="button" class="btn btn-primary ms-auto w-100" id="btnLogin">
											Đăng nhập
										</button>
									</div>
									<p class="form-text text-dark my-3 text-center" id="divOr">                                    
										<span class="titleOr">Hoặc</span>                                    
									</p>
									<div class="align-items-center d-flex d-regiter">
										<button type="button" class="btn btn-warning ms-auto w-100"  id="btnRegister">
											Đăng ký hồ sơ	
										</button>
									</div>
									
								</form>
							</div>
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