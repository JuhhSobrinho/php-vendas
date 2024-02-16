<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <link rel="stylesheet" href="css/Style.css">
</head>

<body>
    <form class="box" method="POST" action="processa.php">
        <img src="img/cara (1).png" width="80px" height="80px">
        <p></p>
        <input type="text" name="User" placeholder="Username">
        <input type="password" name="Pass" placeholder="Password">
        <p></p>
        <div class="botoes">
            <input type="submit" name="Submit" value="Login">
            <input type="submit" name="Submit" value="SignUp">
            <input type="hidden" name="action" id="action" value="">
        </div>
    </form>

    <script>
        document.querySelector('input[value="Login"]').addEventListener('click', function() {
            document.getElementById('action').value = 'login';
        });

        document.querySelector('input[value="SignUp"]').addEventListener('click', function() {
            document.getElementById('action').value = 'signup';
        });
    </script>
</body>
