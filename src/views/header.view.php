<?php
    $config = parse_ini_file(ABS_PATH . '/config.ini', true);
    $environment = $config['ENVIRONMENT'];
    $URL_BASE = $config[$environment]['URL_BASE'];

    define('URL_PATH', $URL_BASE);

    $favicon = URL_PATH . "/assets/bony-logo-pixel.gif";
    $notIndexPHP = $pageName !== 'index.php';

    $header = [
        'logo' => [
            'img' => URL_PATH . "/assets/geh3j86629971.gif",
            'alt' => "Bank of New York",
        ],
        'button' => [
            'login' => "Login",
            'logout' => "Logout",
        ],
    ];
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['title']?></title>
    <link rel="icon" href="<?= $favicon?>" type="image/x-icon">
    <link rel="stylesheet" href="<?= URL_PATH . '/styles/style.css'?>">
</head>
<body>
    <header>
        <div class="header-container">
            <div ><?php if ($notIndexPHP) {
                echo '<a href="' . URL_PATH . '/home.php">'; }?>
                <img id="header-logo" src="<?= $header['logo']['img']?>" alt="<?= $header['logo']['img']?>"><?php ?>
            <?php if ($notIndexPHP) {
                echo '</a>'; 
                echo '<style>.navigation { display: block; }</style>';
            }?>
            </div>
            <nav class="navigation">
                <ul>
                    <?php foreach($data['navigation-items'] as $key => $item) {?>
                        <li><a href="<?= $item['link']?>"><?= $item['label']?></a></li>
                        <?php if($key < count($data['navigation-items']) - 1) {?>
                            <li><span><?= '|'?></span></li>
                        <?php }?>
                    <?php }?>
                </ul>
            </nav>
            <?php if (isset($_SESSION['username'])) {?>
                <form method="post" action="<?= URL_PATH . '/src/scripts/logout.php'?>">
                    <button id="login-btn">Logout</button>
                </form>
            <?php } else {?>
                <button id="login-btn" onclick="toggleLoginDropdown();">Login</button> 
            <?php }?>
            <div class="form-container">
                <form method="post" id="loginDropdown" class="login-dropdown" action="<?= URL_PATH . '/index.php'?>">
                    <div class="form-input-container">
                        <?php if (isset($errorMessage)) {?>
                            <span class="error-message"><?= $errorMessage;?></span>
                        <?php }?>
                        <input type="text" name="username" id="username" value="short_round" placeholder="Username" required>
                        <input type="password" name="password" id="password" value="password" placeholder="Password" required>
                        <input type="submit" value="Login">
                        <p>Forgot your <a href="#">credentials?</a></p>
                    </div>
                </form>
            </div>
        </div>
    </header>

