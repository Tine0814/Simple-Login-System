<?php 
session_start();
if(!isset($_SESSION["user"])){
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background: #06283D;
}

h2 {
    position: relative;
    font-size: 7rem;
    color: #06283D;
    -webkit-text-stroke: 1px #275362;
    text-transform: uppercase;
}

h2::before {
    position: absolute;
    content: attr(data-text);
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    color: #8C0000;
    -webkit-text-stroke: 0px #275362;
    border-right: 2px solid #8C0000;
    overflow: hidden;
    animation: animateOne 5s linear infinite;
}

h1 {
    position: relative;
    margin-left: 2rem;
    font-size: 2rem;
    letter-spacing: 10px;
    color: #070d1d;
    width: 100%;
    text-transform: uppercase;
    -webkit-box-reflect: below 1px linear-gradient(transparent, #0004);
    line-height: 2rem;
    outline: none;
    animation: animateTwo 5s linear infinite;
}

@keyframes animateOne {

    0%,
    10%,
    100% {
        width: 0;
    }

    70%,
    90% {
        width: 100%;
    }
}

@keyframes animateTwo {

    0%,
    20%,
    50% {
        color: #070d1d;
        box-shadow: none;
    }

    100% {
        color: #fff;
        text-shadow: 0 0 10px #03bcf4,
            0 0 20px #03bcf4,
            0 0 40px #03bcf4,
            0 0 80px #03bcf4,
            0 0 160px #03bcf4;
    }
}

.block {
    display: grid;
    grid-gap: 5rem;
}
</style>

<body>
    <?php $user = $_SESSION['user']; ?>
    <div class="block">
        <div>
            <h1 contenteditable="true"> <?php echo $user['name']?>
            </h1>
        </div>
        <div>
            <h1>logout after 5econds</h1>
        </div>
    </div>
    <script>
    setTimeout(function() {
        window.location.href = 'logout.php'; // the redirect goes here

    }, 5000); // 5 seconds
    </script>
</body>

</html>