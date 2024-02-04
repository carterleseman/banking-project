<?php
    session_start();

    define('ABS_PATH', dirname(__FILE__, 1));

    $pageName = basename(__FILE__);

    $correctUsername = "short_round";
    $correctPassword = "password";

    if(!empty($_POST)) {
        $enteredUsername = isset($_POST['username']) ? $_POST['username'] : "";
        $enteredPassword = isset($_POST['password']) ? $_POST['password'] : "";

        if ($enteredUsername == $correctUsername && $enteredPassword == $correctPassword) {
            $_SESSION['username'] = $enteredUsername;
            header('Location: home.php');
            exit;
        } else {
            $errorMessage = "Please verify your information and try again.";
        }
    }

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
            
        </div>
    </main>
    <footer>

    </footer>
    <script src="src/scripts/script.js"></script>
</body>
</html>