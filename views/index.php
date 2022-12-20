<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magebit - Tests</title>
</head>
<body>
    <div class="main">
        <div class="backside">
			<div>
                <h2>Don't have an account?</h2>
                <img src="images/lineunder.png" alt="lineunder" width="43" height="5">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                <button id="register-form">Sign up</button>
			</div>
			<div>
                <h2>Have an account?</h2>
                <img src="images/lineunder.png" alt="lineunder" width="43" height="5">
				<p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
				<button id="login-form">Sign in</button>
			</div>
        </div>
        <div class="frontside">
            <div class="login">
                <form action="index.php?op=login" method="post">
                    <div class="title">Login<img align="right" src="images/logo.png" alt="logo" width="38" height="28"></div>
                    <img src="images/lineunder.png" alt="lineunder" width="43" height="5">
                    <div class="input-group">
                        <label class="required">Email<img align="right" src="images/ic_mail.png" alt="ic_mail" width="19" height="17"></label><br>
                        <input type="text" name="email">
                    </div>
                    <div class="input-group">
                        <label class="required">Password<img align="right" src="images/ic_lock.png" alt="ic_lock" width="19" height="20"></label><br>
                        <input type="password" name="password">
                    </div>
                    <div class="input-group-buttons">
                        <button type="submit" name="LoginBtn" value="LoginBtn">Login</button>
                        <a href="#">Forgot?</a>
                    </div>
                </form>
            </div>
            <div class="register">
                <form action="index.php?op=register" method="post">
                    <div class="title">Sign Up<img align="right" src="images/logo.png" alt="logo" width="38" height="28"></div>
                    <img src="images/lineunder.png" alt="lineunder" width="43" height="5">
                    <div class="input-group">
                        <label class="required">Name<img align="right" src="images/ic_user.png" alt="ic_user" width="17" height="18"></label><br>
                        <input type="text" name="name" id="name">
                    </div>
                    <div class="input-group">
                        <label class="required">Email<img align="right" src="images/ic_mail.png" alt="ic_mail" width="19" height="17"></label><br>
                        <input type="text" name="email" id="email">
                    </div>
                    <div class="input-group">
                        <label class="required">Password<img align="right" src="images/ic_lock.png" alt="ic_lock" width="19" height="20"></label><br>
                        <input type="password" name="password" id="password">
                    </div>
                    <div class="input-group-buttons">
                        <button type="submit" name="RegisterBtn" value="RegisterBtn">Sign Up</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- ===== [Skripts - "Slider". Ļauj priekšējai sadaļai pārvietoties no vienas puses uz otru, spiežot attiecīgo kategoriju] ===== -->
    <script>
        document.getElementById("register-form").addEventListener("click",function(){
            document.getElementsByClassName("main")[0].classList.add("active");
        });
        document.getElementById("login-form").addEventListener("click",function(){
            document.getElementsByClassName("main")[0].classList.remove("active");
        });
    </script>
</body>
</html>