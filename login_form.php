<!DOCTYPE html>
<!-- Created by Professor Wergeles for CS2830 at the University of Missouri. Style change and account creation added by Kyle Moore. -->
<html>
<head>
	<title>Database Login</title>
	<link href="style.css" rel="stylesheet" type="text/css">
    <link href="jquery-ui-1.11.4.custom/jquery-ui.min.css" rel="stylesheet" type="text/css">
    <style>
        #logpane{
            text-align: center;
            margin: auto;
            height: 250px;
            border: solid;
            width: 400px;
            background-color: darkgray;
            border-radius: 30px;
        }
    </style>
    <script src="jquery-ui-1.11.4.custom/external/jquery/jquery.js"></script>
    <script src="jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
    <script>
        $(function(){
            $("input[type=submit]").button();
        });
    </script>
</head>
<body>
        <?php
            if ($error) {
                print "<div class=\"ui-state-error\">$error</div>\n";
            }
        ?>
        
        
        <form action="login.php" method="POST">
            <input type="hidden" name="action" value="do_login">
            <br>
            <div id="logpane">
                <h2>Log in. If the account doesn't exist, it will be created.</h2>
                <div>
                    <input type="text" placeholder="Enter Username" name="username" required>
                </div>
                <br>
                <div>
                    <input type="password" placeholder="Enter Password" name="password" required>

                </div>
                <br>
                <div>
                    <button id="help" type="submit" class="buttontype1">Submit</button>
                </div>
            </div>
        </form>
</body>
</html>