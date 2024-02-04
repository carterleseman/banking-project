<?php
    session_start();

    // define('ABS_PATH', $_SERVER['DOCUMENT_ROOT']);
    define('ABS_PATH', dirname(__FILE__, 4));

    $pageName = basename(__FILE__);

    $checkingsBalance =& $_SESSION['checkings_balance'];
    $savingsBalance =& $_SESSION['savings_balance'];
    $businessBalance =& $_SESSION['business_balance'];

    $data = [
        'title' => "Transfers &rsaquo; Bank of New York",
        'navigation-items' => [
            [
                'link' => "../accounts.php",
                'label' => "Accounts",
            ],
            [
                'link' => "#",
                'label' => "Transfers",
            ],
            [
                'link' => "../deposit/deposit.php",
                'label' => "Deposit Checks",
            ],
        ],
        'form-items' => [
            'form-headers' => [
                'From',
                'To',
            ],
            'form-entries' => [
                [
                    'desc' => 'Checkings',
                    'balance' => &$checkingsBalance,
                ],
                [
                    'desc' => 'Savings',
                    'balance' => &$savingsBalance,
                ],
                [
                    'desc' => 'Business',
                    'balance' => &$businessBalance,
                ],
            ],
        ],
    ];

    function transferBalance(&$data) {

        // echo '$_POST Array: ';
        // print_r($_POST) . PHP_EOL;

        $ac1 = isset($_POST['account-from']) ? $_POST['account-from'] : null;
        $ac2 = isset($_POST['account-to']) ? $_POST['account-to'] : null;
        $tAmount = isset($_POST['amount']) ? $_POST['amount'] : null;

        // echo '$ac1: ' . $ac1 . PHP_EOL;
        // echo '$ac2: ' . $ac2 . PHP_EOL;
        // echo '$tAmount: ' . $tAmount . PHP_EOL;

        if ($ac1 == $ac2) {
            return "Please select different accounts for transfer.";
        }

        $insufficientBalance = false;

        foreach($data['form-items']['form-entries'] as &$entry) {
            if ($ac1 !== null && $entry['desc'] == $ac1 && $entry['balance'] >= $tAmount) {
                $entry['balance'] -= $tAmount;
            } else if ($ac1 !== null && $entry['desc'] == $ac1 && $entry['balance'] < $tAmount) {
                $insufficientBalance = true;
                break;
            }
            if ($ac2 !== null && $entry['desc'] == $ac2) {
                $entry['balance'] += $tAmount;
            }
        }

        if ($insufficientBalance) {
            return "Insufficient balance for transfer.";
        }

        return true;
    }

    $result = null;

    if(!empty($_POST)) {
        $result = transferBalance($data);
    }

    include_once(ABS_PATH . '/src/views/header.view.php');
?>

    <div class="background-image"></div>
    <main>
        <div class="main-container">
            <div class="form-container">
                <form method="post">
                    <div class="form-input-container">
                        <?php if (is_string($result)) {?>
                            <span class="error-message"><?= $result;?></span>
                        <?php } else if ($result) {?>
                            <span class="success-message">Transfer successful!</span>
                        <?php }?>
                        
                        <label for="account-from">From</label>
                        <select id="account-from" name="account-from">
                            <option value="">Select Account</option>
                            <?php foreach ($data['form-items']['form-entries'] as $entry) {?>
                                <option value="<?= $entry['desc'] ?>"><?= $entry['desc'] . ': $' . number_format($entry['balance'], 2) ?></option>
                            <?php }?>
                        </select>

                        <label for="account-to">To</label>
                        <select id="account-to" name="account-to">
                            <option value="">Select Account</option>
                            <?php foreach ($data['form-items']['form-entries'] as $entry) { ?>
                                <option value="<?= $entry['desc'] ?>"><?= $entry['desc'] . ': $' . number_format($entry['balance'], 2) ?></option>
                            <?php }?>
                        </select>

                        <label for="amount">Amount</label>
                        <input type="number" id="amount" name="amount" min="0.01" step="0.01" placeholder="Enter amount">

                        <input type="submit" value="Transfer">
                    </div>
                </form>
            </div>
        </div>

    </main>
    <footer>

    </footer>
    <script src="<?= ABS_PATH . '/src/scripts/script.js'; ?>"></script>
</body>
</html>