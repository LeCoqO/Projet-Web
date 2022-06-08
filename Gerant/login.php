<?php
ob_start();
session_start();
?>


<html lang="fr">

<head>
    <title>Login</title>
</head>

<body>
    <h2>LOGIN</h2>
    <div class="container form-signin">

        <?php
        $msg = '';

        if (
            isset($_POST['login']) && !empty($_POST['username'])
            && !empty($_POST['password'])
        ) {

            if (
                $_POST['username'] == 'root' &&
                $_POST['password'] == 'cqfd14sAfe'
            ) {
                $_SESSION['valid'] = true;
                $_SESSION['timeout'] = time();
                $_SESSION['username'] = 'Proprio';

                echo 'You have entered valid use name and password';
                header('Location: AccueilGerant.php');  //la page où tu veux atterrir
            } else {
                $msg = 'Wrong username or password';
            }
        }
        ?>
    </div>

    <div class="container">

        <form class="form-signin" role="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);
                                                        ?>" method="post">
            <h4 class="form-signin-heading"><?php echo $msg; ?></h4>
            <input type="text" class="form-control" name="username" placeholder="username = tutorialspoint" required autofocus></br>
            <input type="password" class="form-control" name="password" placeholder="password = 1234" required>
            <button class="btn btn-lg btn-primary btn-block" type="submit" name="login">Login</button>
        </form>
    </div>

</body>

</html>