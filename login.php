<?php 
    session_start();
    include('server.php'); 
    
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Tu Theatre - เข้าสู่ระบบ</title>
    <link rel="icon" href="img/ico.ico" type="image/ico">
    <link rel="stylesheet" href="bootstrap/css/login_bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit&amp;display=swap">
    <link rel="stylesheet" href="css/login_Contact-Form-Clean.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="css/login_Login-Form-Basic.css">
    <link rel="stylesheet" href="css/login_styles.css">
</head>

<body style="background: #f5f5f5;">
    <div class="d-flex align-items-center align-content-center contact-clean" style="color: var(--gray-dark);">
        <form class="text-dark bounce animated" action="login_db.php" method="post">
            <section class="position-relative py-4 py-xl-5">
                <div class="card">
                    <div class="card-body text-center d-flex flex-column align-items-center">
                    <br>   <br>   <img class="rounded mx-auto d-block" src="img/innovative_letter.png" width="100" height="100" class="rounded d-block" alt=""> <br>   
                    <h3 class="text-center bounce animated" style="font-family: Kanit, sans-serif;">เข้าสู่ระบบ</h3> <br>  
                            <form action="login_db.php" method="post">
 
                            <!-- notification message-->
        <?php if (isset($_SESSION['error'])) : ?>
                    <div class="error">
                    <p style="font-family: Kanit, sans-serif; ">
                            <?php 
                                echo $_SESSION['error'];
                                unset($_SESSION['error']);
                            ?>
                       </p>
                    </div>
        <?php endif ?>

                            <div class="mb-3"><input class="form-control" type="text" name="Email" placeholder="example@cinema.com" required></div>
                            <div class="mb-3"><input class="form-control" type="password" name="password" placeholder="Password" required></div>
                            <div class="mb-3"><button class="btn btn-primary d-block w-100" data-bss-hover-animate="pulse" type="submit" name="login_user">Log in</button required></div>
                            <p>Not yet a member? <a href="register.php">Sign Up</a></p> 
                    </div>
                </div>
            </section>
        </form>
        
    </div>
 
</body>

</html>