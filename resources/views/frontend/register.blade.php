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
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="plugins/font-awesome/css/font-awesome.min.css">

</head>
<body >
<style>

    input[type="text"], input[type="password"],input[type="email"] {
        font-family: 'Open Sans', sans-serif;
        width:78%;
        padding:0.7em 2em 0.7em 1.7em;
        color:whitesmoke;
        font-size:18px;
        outline: none;
        background: none;
        border:none;
        font-weight:600;
    }
    .a{
        border:1px solid red;
        box-shadow: 0 0 1em red;
        -webkit-box-shadow: 0 0 1em red;
        -o-box-shadow: 0 0 1em red;
        -moz-box-shadow: 0 0 1em red;
    }
    form .input-group:hover{
        border:1px solid #40A9DF;
        box-shadow: 0 0 1em #40A9DF;
        -webkit-box-shadow: 0 0 1em #40A9DF;
        -o-box-shadow: 0 0 1em #40A9DF;
        -moz-box-shadow: 0 0 1em #40A9DF;
    }
    form .input-group{
        border:1px solid #B4B2B2;
        list-style:none;
        margin-bottom:25px;
        width:100%;
        background:none;
        border-radius: 0.3em;
        -webkit-border-radius: 0.3em;
        -o-	border-radius: 0.3em;
        -moz-border-radius: 0.3em;

    }
    .form-control{
        background: none;
        color:whitesmoke;
        font-size: 18px;
    }
    .card{
        background: none;
        box-shadow:none;
    }
    form{
        padding: 5% 0.5em;

    }
    input[type="submit"]{
        width: 100%;

    }
    .textregis{
        color: whitesmoke;
        text-align: center;
        font-size: 50px;
        font-family: Segoe Print;
        font-weight: bold;
        margin-bottom: 10px;

    }

</style>
<!-----start-main---->
<div class="login-form">
    <div class="head">
        <img src="login-asset/images/1.jpg" width="115px" height="115px" alt=""/>

    </div>

    <form id="submit" >
        <div class="card card-info">
            <div class="card-body">
                <div class="textregis">
                    <i >Register</i>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="nav-icon fas fa-ad teal"></i></span>
                    </div>
                    <input type="text" required id="name" name="name" placeholder="Họ tên">

                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                    </div>
                    <input type="email" required id="email" name="email" placeholder="Email">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    </div>
                    <input type="password" required id="password" name="password"  placeholder="Password">
                </div>
                <div class="input-group mb-3 cfpw">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    </div>
                    <input type="password" required id="confirmpassword" name="confirmpassword"  placeholder="Confirm Password">

                </div>
                <span id="errorcf" style="position: relative;
    /* width: 100%; */
    top: -16px;
    /* text-align: center; */
    font-size: 18px;
    color: red;
    color: red;
    left: 4em;
}"></span>
                <div class="input-group mb-3 cmt">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-credit-card"></i></span>
                    </div>
                    <input type="text" id="CMT"  required name="CMT" placeholder="Chứng Minh Thư">

                </div>
                <span id="errorCMT" style="color: red"></span>

                <div class="p-container">

                    <input type="submit"   value="REGISTER" >
                    <div class="clear"> </div>
                </div>
            </div>
            <!-- /.card-body -->
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

   //
    $(document).ready(function () {
        var pass=false;
        var cfpass=false;
        var passport=false;
        // $('#password').focusout(function () {
        //     alert($(this).val())
        // });
        $('#confirmpassword').focusout(function () {
            var cfpw=$(this).val();
            var pw=$('#password').val();
            if(pw != cfpw){
                $('#errorcf').text('Nhập password khong khop');
                $('.cfpw').addClass('a');
                cfpass = true;
            }else{
                $('#errorcf').text('');
                $('.cfpw').removeClass('a');
            }
        });
        $('#CMT').focusout(function () {
            var CMT=$(this).val();


        });
        $('#submit').submit(function (e) {
            e.preventDefault();
            var name=$('#name').val();
            var pw=$('#password').val();
            var cfpw=$('#confirmpassword').val();
            var email=$('#email').val();
            var CMT=$('#CMT').val();
            var _token=$('input[name="_token"]').val();
           if(pass==false&&cfpass==false){
               $.ajax({
               url:'{{asset("postregister")}}',
               type:'POST',
               dataType:'json',
               data:{name:name,pw:pw,email:email,CMT:CMT,_token:_token},
               success:function (data) {
               if (data.success!=''){
               alert(data.success);
               window.location='{{asset('login')}}'
               }
               }
               })
           }else{
               alert('kiem tra')

           }



        })
    });


</script>
</body>
</html>