<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>

<head>
    <title>The Login-Animated Website Template | Home :: w3layouts</title>
    <meta charset="utf-8">

    <link href="login-asset/css/style.css" rel='stylesheet' type='text/css' />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!--webfonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:600italic,400,300,600,700' rel='stylesheet' type='text/css'>
    <!--//webfonts-->
</head>
<body>

<!-----start-main---->
<div class="login-form">
    <div class="head">
        <img src="login-asset/images/1.jpg" width="115px" height="115px" alt=""/>

    </div>
    <form id="submit">
        <li>
            <input type="text" required class="text" placeholder="Email" id="email" ><a href="#" class=" icon user"></a>
        </li>
        <li>
            <input type="password" required placeholder="Password" id="password" ><a href="#" class=" icon lock"></a>
        </li>
        <div class="p-container">
            <label style="color: whitesmoke"><input type="checkbox" id="checkbox" value="Remember"   ><i></i>Remember Me</label>
            <input type="submit"  value="SIGN IN" >
            <div class="clear"> </div>
        </div>
        {{csrf_field()}}
    </form>
</div>
<!--//End-login-asset-form-->
<!-----start-copyright---->
{{--<div class="copy-right">--}}
    {{--<p>Template by <a href="http://w3layouts.com">w3layouts</a></p>--}}
{{--</div>--}}
<!-----//end-copyright---->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $('#submit').submit(function (e) {
            e.preventDefault();
            var email=$('#email').val();
            var pw=$('#password').val();
            var _token=$('input[name="_token"]').val();
            var checkbox=$('#checkbox:checked').val();
            $.ajax({
                url:'{{asset('postlogin')}}',
                type: 'POST',
                dataType: 'json',
                data: {email:email,pw:pw,checkbox:checkbox,_token:_token},
                success:function (data) {
                    if (data.link){
                        window.location=data.link;
                        alert('Đăng nhập thành công');
                    }else if(data.error){
                        alert(data.error);
                    }

                }
            })


        })
    });


</script>
</body>
</html>