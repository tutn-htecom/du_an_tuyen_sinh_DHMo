$(document).ready(function () {
    $('#btnLogin').on('click', function (e) {
        login(e);
    });
    $('#btnRegister').on('click', function (e) {  
        register(e);
    });
    function login(e){
        e.preventDefault();
        let url = '/api/auth/login'
        let data = {
            "email": $('#email').val().trim(),
            "password": $('#password').val().trim(),
        }           
        let method = 'POST'
        let redirect = '/crm';        
        if(data.email.length > 0 && data.password.length > 0) {
            error('.e-error-msg', 'error-msg', 'Vui lòng đầy đủ email', data.email);           
            error('.p-error-msg', 'error-msg', 'Vui lòng đầy đủ password', data.password); 
            $post(url,data,method,redirect);               
        } else {     
            //Get lỗi email
            error('.e-error-msg', 'error-msg', 'Vui lòng đầy đủ email', data.email);         
            //Get lỗi password
            error('.p-error-msg', 'error-msg', 'Vui lòng đầy đủ password', data.password);           
        } 
    }

    function register(e){
        e.preventDefault();
        let url = '/api/auth/register'
        let data = {
            "email": $('#email').val().trim(),
            "password": $('#password').val().trim(),
        }           
        let method = 'POST'
        let redirect = '/crm/login';
        if(data.email.length > 0 && data.password.length > 0) {
            error('.e-error-msg', 'error-msg', 'Vui lòng đầy đủ email', data.email);           
            error('.p-error-msg', 'error-msg', 'Vui lòng đầy đủ password', data.password); 
            $post(url,data,method,redirect); 
        } else {     
            //Get lỗi email
            error('.e-error-msg', 'error-msg', 'Vui lòng đầy đủ email', data.email);         
            //Get lỗi password
            error('.p-error-msg', 'error-msg', 'Vui lòng đầy đủ password', data.password);           
        } 
    }

    // Show - Hide mật khẩu

    $('#icon-show').on('click', function () {
        // Kiểm tra nếu phím nhấn là "Enter" (mã phím là 13)
        const passwordField = document.getElementById('password');
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);        
        // Toggle the eye icon
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });
    
    // Sự kiện Enter ở input
    $('#email').on('keypress', function (event) {
            // Kiểm tra nếu phím nhấn là "Enter" (mã phím là 13)
            if (event.key === "Enter") {
                if(window.location.pathname == '/crm/register') {
                    register(event);
                }
                if(window.location.pathname == '/crm/login') {
                    login(event);
                }
                
            }
    });
    
    $('#password').on('keypress', function (event) {
        // Kiểm tra nếu phím nhấn là "Enter" (mã phím là 13)
         // Kiểm tra nếu phím nhấn là "Enter" (mã phím là 13)
         if (event.key === "Enter") {            
            if(window.location.pathname == '/crm/register') {
                register(event);
            }
            if(window.location.pathname == '/crm/login') {
                login(event);
            }
            // Thực hiện thêm hành động nào đó ở đây
        }
    });
});