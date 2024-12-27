<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="dvnloginbox">

        <img src="Asset/login/dvnLogoWW.png" alt="WnW" class="dvnLogo">

        <p class="dvnText">Login to your account</p>

        <!-- composer require laravel/socialite -->
         <div class="dvnsocialLogin">
            <a href="{{ route('redirect') }}"><img src="Asset/login/dvngoogle.png" alt="google" width="30px"></a>
            <a href="{{ route('auth/facebook') }}"><img src="Asset/login/dvnfacebook.png" alt="fb" width="30px"></a>
         </div>
        
        <div class="dvnloginform">
            <p >or use your email account</p>
            <form method="post" action="homepage">
                @csrf
                <input type="text" name="dvnemail" class="dvnemail" placeholder="email or phone number" required><br>
                <input type="password" name="dvnpassword" class="dvnpassword" placeholder="Password (8 characters)" required><br>
                <input type="submit" value="Login" class="dvnlogin" id="dvnlogin">
            </form>
        </div>

        <p class="dvnNoAcc">Don't have an account ? <a href="register">Register here</a></p>
    </div>
</body>
<script src="js/login.js"></script>
</html>

<!-- note : kalau login facebook ubah 127.0.0.1:8000 jadi localhost:8000 -->