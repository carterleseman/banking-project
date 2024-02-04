<?php
    session_start();

    define('ABS_PATH', dirname(__FILE__, 1));

    $pageName = basename(__FILE__);

    $username = $_SESSION['username'];

    $data = [
        'title' => "Home &rsaquo; Bank of New York",
        'navigation-items' => [
            [
                'link' => "personal/accounts/accounts.php",
                'label' => "Accounts",
            ],
            [
                'link' => "personal/accounts/transfer/transfer.php",
                'label' => "Transfers",
            ],
            [
                'link' => "personal/accounts/deposit/deposit.php",
                'label' => "Deposit Checks",
            ],
        ],
    ];

    include_once(ABS_PATH . '/src/views/header.view.php');
?>

    <div class="background-image"></div>
    <main>
        <div class="main-container">
            <h1><?= "Welcome, $username!"?></h1>
        </div>

    </main>
    <?php include_once(ABS_PATH . '/src/views/footer.view.php');?>
</body>
</html>