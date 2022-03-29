<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="icon" href="/assets/images/map.png">
    <link rel="stylesheet" href="/assets/css/index.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poor+Story&family=Roboto:wght@300;400&display=swap" rel="stylesheet">

</head>

<body>
    <div class="container">
        <div class="img">
            <img src="/assets/images/slider-1.png">
        </div>
        <div class="for_p">
            <p>As well as diluted with a fair amount of empathy, rational thinking largely determines the importance of the
                positions taken by the participants in relation to the tasks assigned.</p>
            <p>As is commonly believed, interactive prototypes are only a method of political participation and are
                associatively distributed across industries.</p>
        </div>
        <form class="for_registration" method="post" action="/send_email.php">
            <input class="input" type="email" name="email" placeholder="E-mail" />
            <button type="submit" class="reg_btn">Registration</button>
        </form>
        <?php if (isset($_GET['success']) && $_GET['success'] == '1') { ?>
            <div class="success">
                <strong class="">Thank You!</strong>
            </div>
        <?php } ?>
    </div>
</body>

</html>
