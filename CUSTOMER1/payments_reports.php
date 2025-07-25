<?php
session_start();
include('config/config.php');
include('config/checklogin.php');
check_login();
require_once('partials/_head.php');
?>

<body>
    <?php require_once('partials/_sidebar.php'); ?>

    <div class="main-content">
        <?php require_once('partials/_topnav.php'); ?>

        <div style="background-image: url(../admin/assets/img/theme/restro00.jpg); background-size: cover;" class="header pb-8 pt-5 pt-md-8">
            <span class="mask bg-gradient-dark opacity-8"></span>
            <div class="container-fluid">
                <div class="header-body"></div>
            </div>
        </div>

        <div class="container-fluid mt--8">
            <div class="row">
                <div class="col">
                    <div class="card shadow">
                        <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center">
                            <h3 class="mb-0 text-primary">Payment Reports</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-striped table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-success">Payment Code</th>
                                        <th>Payment Method</th>
                                        <th class="text-success">Order Code</th>
                                        <th>Amount Paid</th>
                                        <th class="text-success">Date Paid</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $customer_id = $_SESSION['customer_id'];
                                    $ret = "SELECT * FROM rpos_payments WHERE customer_id ='$customer_id' ORDER BY `created_at` DESC ";
                                    $stmt = $mysqli->prepare($ret);
                                    $stmt->execute();
                                    $res = $stmt->get_result();
                                    while ($payment = $res->fetch_object()) {
                                    ?>
                                        <tr>
                                            <th class="text-success"><?php echo $payment->pay_code; ?></th>
                                            <td><?php echo $payment->pay_method; ?></td>
                                            <td class="text-success"><?php echo $payment->order_code; ?></td>
                                            <td>₹<?php echo $payment->pay_amt; ?></td>
                                            <td class="text-success"><?php echo date('d/M/Y g:i', strtotime($payment->created_at)) ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <?php require_once('partials/_footer.php'); ?>
        </div>
    </div>

    <?php require_once('partials/_scripts.php'); ?>
</body>

</html>
