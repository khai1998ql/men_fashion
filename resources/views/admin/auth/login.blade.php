<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập Admin</title>
    <!-- Dùn lấy icon -->
    <link rel="stylesheet" href="{{ asset('public/frontend/font/fontawesome-free-5.15.1-web/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/font/fontawesome-free-5.15.1-web/css/fontawesome.min.css') }}">
    <!-- Dùn lấy icon -->
    <link rel="stylesheet" href="{{ asset('public/frontend/themify-icons/themify-icons.css') }}">
    <!-- css trang -->
    <link rel="stylesheet" href="{{ asset('public/backend/css/admin.css') }}">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <!-- Font ngoài -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>
<body>
<div class="app_container" id="app_container" style="background: url('{{ asset('public/frontend/images/bg.jpg') }}') no-repeat;">
    <div class="app_container_content">
        <div class="app_container_content_title">Đăng nhập Dashboard</div>
        <form method="POST" action="{{ route('admin.login') }}">
            @csrf
            <input type="email" id="email" name="email" placeholder="Nhập email của bạn!" class="app_container_content_input">

            @error('email')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
            <div class="app_container_content_list">
                <input type="password" id="password" name="password"  placeholder="Nhập mật khẩu!" class="app_container_content_input">
                @error('password')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
                <div class="app_container_content_icon" onclick="changeType()"><span class="ti-eye"></span></div>
            </div>

            <button type="submit" class="app_container_content_submit">Đăng nhập</button>
        </form>
    </div>
</div>
</body>
<!-- Jquery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<!-- Ajjax -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
<script>
    var height = window.innerHeight
        || document.documentElement.clientHeight
        || document.body.clientHeight;
    window.onresize = function(event) {
        height = window.innerHeight
            || document.documentElement.clientHeight
            || document.body.clientHeight;
    };
    // console.log(height);
    $('#app_container').css({'height' : height});
    function changeType(){
        var typeInput = $('#password').attr('type');
        if(typeInput == 'password'){
            $('#password').attr('type','text');
        }else{
            $('#password').attr('type','password');
        }

    }
</script>
</html>
