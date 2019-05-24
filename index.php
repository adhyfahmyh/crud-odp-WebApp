<!DOCTYPE html>
<html>
<head>
	<title>LOGIN PAGE</title>
	<meta charset="utf-8">
	<link rel="icon" type="image/png" href="">
	<link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
	<body class="gambar">
        <div class="content">
            <div class="head">
                <h3 class="s_title"><strong>SIGN IN</strong></h3>
            </div>
            <div class="form">          
                <form action="config.php?op=in" method="post" onSubmit="return validasi()">
                    <div class="grup">
                        <label> Username:  </label>
                        <input type="text"  name="username" id="username" placeholder="Your username">
                    </div>
                    <div class="grup">
                        <label> Password:  </label>
                        <input type="password" name="password" id="password"  placeholder="Your password">
                    </div>
                    <div class="showpassword">
                        <input type="checkbox" onclick="showpassword()"><label>&nbsp;Show Password</label>
                    </div>
                    <div class="grup">
                        <input type="submit" value="SIGN IN" class="tombol">
                    </div>
                </form>
            </div>
        </div>

    </body>
    <script type="text/javascript">
        function validasi() {
            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;
            var failed = "FAILED!";      
            if(username == "" && password==""){
                alert(failed+"\n\nPlease fill in Username and Password");
                return false;
            }
            else{
                return true;
            }
        }
        function showpassword() {
            var x = document.getElementById("password");
            if (x.type == "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</html>