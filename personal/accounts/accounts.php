<?php
    session_start();

    // define('ABS_PATH', $_SERVER['DOCUMENT_ROOT']);
    define('ABS_PATH', dirname(__FILE__, 3));

    $pageName = basename(__FILE__);

    $initCheckingsBalance = 10000;
    $initSavingsBalance = 2000;
    $initBusinessBalance = 4000;

    isset($_SESSION['checkings_balance']) ?: $_SESSION['checkings_balance'] = $initCheckingsBalance;
    isset($_SESSION['savings_balance']) ?: $_SESSION['savings_balance'] = $initSavingsBalance;
    isset($_SESSION['business_balance']) ?: $_SESSION['business_balance'] = $initBusinessBalance;

    $data = [
        'title' => "Accounts &rsaquo; Bank of New York",
        'navigation-items' => [
            [
                'link' => "#",
                'label' => "Accounts",
            ],
            [
                'link' => "transfer/transfer.php",
                'label' => "Transfers",
            ],
            [
                'link' => "deposit/deposit.php",
                'label' => "Deposit Checks",
            ],
        ],
        'table-items' => [
            'table-headers' => [
                'Account',
                'Balance',
            ],
            'table-entries' => [
                [
                    'desc' => 'Checkings',
                    'balance' => $_SESSION['checkings_balance'],
                ],
                [
                    'desc' => 'Savings',
                    'balance' => $_SESSION['savings_balance'],
                ],
                [
                    'desc' => 'Business',
                    'balance' => $_SESSION['business_balance'],
                ],
            ],
        ],
    ];

    include_once(ABS_PATH . '/src/views/header.view.php');
?>

    <div class="background-image"></div>
    <main>
        <div class="main-container">
            <div class="table-container">
                <table>
                    <tr>
                        <?php foreach($data['table-items']['table-headers'] as $header) {?>
                            <th><?= $header?></th>
                        <?php }?>
                    </tr>
                    <?php
                        foreach ($data['table-items']['table-entries'] as $entry) {
                            echo '<tr>';
                            echo '<td>' . $entry['desc'] . '</td>';
                            echo '<td>' . '$' . number_format($entry['balance'], 2) . '</td>';
                            echo '</tr>';
                        }
                    ?>
                </table>
        </div>

    </main>
    <footer>

    </footer>
    <script src="<?= ABS_PATH . '/src/scripts/script.js'; ?>"></script>
</body>
</html>