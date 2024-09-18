<!DOCTYPE html>
<html>
<head>
    <title>Email</title>
</head>
<body>    
    <h3><strong>{{$title}}</strong></h3>
    <table class="table border-0">   
        <!-- Họ và tên -->
        @if(isset($full_name))
            <tr>
                <td style="width:130px;text-align:left !important;"><span><strong>Họ và tên: </strong></span></td>
                <td class="text-left"><span>{{$full_name}}</span></td>
            </tr>
        @endif     
        <!-- Ngày sinh -->
        @if(isset($date_of_birth))
            <tr>
                <td style="width:130px;text-align:left !important;"><span><strong>Ngày sinh: </strong></span></td>
                <td class="text-left"><span>{{$date_of_birth}}</span></td>
            </tr>
        @endif    
        <!-- Số điện thoại -->
        @if(isset($phone))
            <tr>
                <td style="width:130px;text-align:left !important;"><span><strong>Số điện thoại: </strong></span></td>
                <td class="text-left"><span>{{$phone}}</span></td>
            </tr>
        @endif
        <!-- Giới tính -->
        @if(isset($gender))
            <tr>
                <td style="width:130px;text-align:left !important;"><span><strong>Giới tính: </strong></span></td>
                <td class="text-left"><span>{{$gender}}</span></td>
            </tr>
        @endif
        <!-- Email -->
        @if(isset($email))
            <tr>
                <td style="width:130px;text-align:left !important;"><span><strong>Email: </strong></span></td>
                <td class="text-left"><span>{{$email}}</span></td>
            </tr>
        @endif
        <!-- Password -->
        @if(isset($password))
            <tr>
                <td style="width:130px;text-align:left !important;"><span><strong>Mật khẩu: </strong></span></td>
                <td class="text-left"><span>{{$password}}</span></td>
            </tr>
        @endif       
        <tr>
            <td style="width:130px;text-align:left !important;"><span><strong>Đăng nhập hệ thống: </strong></span></td>
            <td class="text-left"><a href="{{route('Leads.login')}}">Tại đây</a></td>
        </tr>
    </table>
    <h3>Trân trọng!</h3>
    
</body>
</html>