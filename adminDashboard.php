<?php
session_start();
include "connection.php";
if (isset($_SESSION["au"])) {

    ?>
    
    <!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="icon" href="resource/logo.svg" />

</head>

<body>
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-lg-2 border border-1 border-primary border-start-0 border-bottom-0 border-top-0">
                <div class="row p-3">
                    <div class="col-12 text-center">
                        <p class="text-primary-emphasis fw-bold fs-1">Online Store</p>
                    </div>
                    <hr>
                    <div class="col-12 p-3 d-flex justify-content-center">
                        <img src="resource/profile_images/Lahiru_65945e727e684.jpeg" class="rounded-circle mx-3 border border-5 border-info" style="width:150px;
                     height:150px; 
                     object-fit: cover; 
                     object-position: center;
                     box-shadow: 0px 1px 20px 1px skyblue;">
                    </div>
                    <div class="col-12 text-center mb-3">
                        <span class="badge  rounded-5 mb-2 w-100 fs-5 fw-semibold mt-2">Hi, <?php echo $_SESSION["au"]["fname"]; ?></span><br>
                        <span class="w-100 fs-5 fw-semibold mt-2">Admin</span><br>
                        <span class="w-100 fs-5 fw-semibold mt-2"><?php echo $_SESSION["au"]["email"]; ?></span>
                    </div>
                    <div class="col-12 ">
                        <button class="rounded-5 btn fs-5 btn-outline-primary mt-2 p-2 w-100">Dashboard</button>
                        <button class="rounded-5 btn fs-5 btn-outline-primary mt-2 p-2 w-100" onclick="window.location='sellingHistory.php'">Selling History</button>
                        <button class="rounded-5 btn fs-5 btn-outline-primary mt-2 p-2 w-100" onclick="window.location='myProducts.php'">Manage Products</button>
                        <button class="rounded-5 btn fs-5 btn-danger mt-4 p-2 w-100" onclick="adminSignout();">Log Out</button>
                    </div>
                    <div class="col-12 mt-4">

                        <?php
                        date_default_timezone_set("Asia/Colombo");
                        $current_date_time = new DateTime();
                        $current_date = $current_date_time->format('Y-m-d');
                        $current_time = $current_date_time->format('H:i:s');
                        ?>

                        <span class="badge text-white fs-5 fw-bold" id="current-date"><?php echo $current_date; ?></span><br>
                        <span class="badge text-white fs-5 fw-bold" id="current-time">Current Time: <?php echo $current_time; ?> </span>
                    </div>
                </div>
            </div>

            <div class="col-lg-10">
                <div class="row mx-2">
                    <div class="text-center">
                        <h1 class="fw-bold" style="text-shadow: 5px 5px 10px #000000, 4px 13px 22px #000000;">Dashboard</h1>
                    </div>
                    
                    
                    <hr>

                    <!-- Body contetn below header -->
                    <div class="col-12">
                        <div class="row g-1">

                            <div class="col-6 col-lg-2 px-1">
                                <div class="row g-1">
                                    <div class="col-12 border border-1 text-dark text-center rounded" style="height: 100px; background-color: #d8334a;">
                                        <br />
                                        <span class="fs-4 fw-bold"><i class="bi bi-graph-up-arrow fs-3"></i>&nbsp;&nbsp;Daily Earnings</span>

                                        <?php

                                        $today = date("Y-m-d");
                                        $thismonth = date("m");
                                        $thisyear = date("Y");

                                        $a = "0";
                                        $b = "0";
                                        $c = "0";
                                        $e = "0";
                                        $f = "0";

                                        $invoice_rs = Database::search("SELECT * FROM `invoice`");
                                        $invoice_num = $invoice_rs->num_rows;

                                        for ($x = 0; $x < $invoice_num; $x++) {
                                            $invoice_data = $invoice_rs->fetch_assoc();

                                            $f = $f + $invoice_data["qty"]; //total qty

                                            $d = $invoice_data["date"];
                                            $splitDate = explode(" ", $d); //separate the date from time
                                            $pdate = $splitDate["0"]; //sold date

                                            if ($pdate == $today) {
                                                $a = $a + $invoice_data["total"];
                                                $c = $c + $invoice_data["qty"];
                                            }

                                            $splitMonth = explode("-", $pdate); //separate date as year,month & day
                                            $pyear = $splitMonth["0"]; //year
                                            $pmonth = $splitMonth["1"]; //month

                                            if ($pyear == $thisyear) {
                                                if ($pmonth == $thismonth) {
                                                    $b = $b + $invoice_data["total"];
                                                    $e = $e + $invoice_data["qty"];
                                                }
                                            }
                                        }

                                        ?>

                                        <br />
                                        <span class="fs-5">Rs. <?php echo $a; ?> .00</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 col-lg-2 px-1">
                                <div class="row g-1">
                                    <div class="col-12 text-dark text-center rounded" style="height: 100px; background-color: #ed5565;">
                                        <br />
                                        <span class="fs-4 fw-bold"><i class="bi bi-calendar3 fs-3"></i>&nbsp;&nbsp;Monthly Earnings</span>
                                        <br />

                                        <span class="fs-5">Rs. <?php echo $b; ?> .00</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 col-lg-2 px-1">
                                <div class="row g-1">
                                    <div class="col-12   text-dark text-center rounded" style="height: 100px; background-color: #fc6e51;">
                                        <br />
                                        <span class="fs-4 fw-bold"><i class="bi bi-currency-bitcoin fs-3"></i>&nbsp;&nbsp;Today Sellings</span>
                                        <br />
                                        <span class="fs-5"><?php echo $c; ?> Items</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 col-lg-2 px-1">
                                <div class="row g-1">
                                    <div class="col-12  text-dark text-center rounded" style="height: 100px; background-color: #ffce54;">
                                        <br />
                                        <span class="fs-4 fw-bold">Monthly Sellings</span>
                                        <br />
                                        <span class="fs-5"><?php echo $e; ?> Items</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 col-lg-2 px-1">
                                <div class="row g-1">
                                    <div class="col-12  text-dark text-center rounded" style="height: 100px; background-color: #48cfad;">
                                        <br />
                                        <span class="fs-4 fw-bold">Total Sellings</span>
                                        <br />
                                        <span class="fs-5"><?php echo $f; ?> Items</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 col-lg-2 px-1 shadow">
                                <div class="row g-1">
                                    <div class="col-12 text-dark text-center rounded" style="height: 100px; background-color: #4fc1e9;">
                                        <br />
                                        <span class="fs-4 fw-bold">Total Engagements</span>
                                        <br />
                                        <?php
                                        $user_rs = Database::search("SELECT * FROM `user`");
                                        $user_num = $user_rs->num_rows;
                                        ?>
                                        <span class="fs-5"><?php echo $user_num; ?> Members</span>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>

                    <div class="col-12">
                        <hr />
                    </div>


                    <div class="col-12 border border-1 mt-5 col-lg-6 ">
                        <div class="row">
                            <canvas id="lineChart" width="400" height="200"></canvas>
                            <?php
                            $chart_1set_rs = Database::search("SELECT DATE_FORMAT(date, '%M') as month, SUM(qty) as total_quantity FROM invoice GROUP BY DATE_FORMAT(date, '%Y-%m') ORDER BY DATE_FORMAT(date, '%Y-%m')");

                            $months = [];
                            $quantities = [];


                            if ($chart_1set_rs->num_rows > 0) {
                                while ($row = $chart_1set_rs->fetch_assoc()) {
                                    $months[] = $row["month"];
                                    $quantities[] = $row["total_quantity"];
                                }
                            } else {
                                echo "0 results";
                            }

                            $monthsJson = json_encode($months);
                            $quantitiesJson = json_encode($quantities);

                            ?>

                            <script>
                                var months = <?php echo $monthsJson; ?>;
                                var quantities = <?php echo $quantitiesJson; ?>;
                            </script>


                        </div>
                    </div>

                    <div class="col-12 border border-1 col-lg-6 ">
                        <div class="row">
                        <div class="row">

<div class="col-12 text-center">
    <label class="form-label text-primary fw-bold fs-1">Manage All Users</label>
    <hr>
</div>


<div class="col-12 mt-3 mb-3">
    <div class="row">
        <div class="col-2 col-lg-1  py-2 text-end">
            <span class="fs-4 fw-bold text-white">#</span>
        </div>
        
        <div class="col-4 col-lg-2  py-2">
            <span class="fs-4 fw-bold text-white">User Name</span>
        </div>
        <div class="col-4 col-lg-4 d-lg-block py-2">
            <span class="fs-4 fw-bold text-white">Email</span>
        </div>
        <div class="col-2 d-none d-lg-block  py-2">
            <span class="fs-4 fw-bold text-white">Mobile</span>
        </div>
        <div class="col-2 d-none d-lg-block py-2">
            <span class="fs-4 fw-bold text-white">Registered Date</span>
        </div>
        <div class="col-2 col-lg-1"></div>
    </div>
</div>

<?php

$query = "SELECT * FROM `user`";
$pageno;

if (isset($_GET["page"])) {
    $pageno = $_GET["page"];
} else {
    $pageno = 1;
}

$user_rs = Database::search($query);
$user_num = $user_rs->num_rows;

$results_per_page = 20;
$number_of_pages = ceil($user_num / $results_per_page);

$page_results = ($pageno - 1) * $results_per_page; // 0 , 20 , 40
$selected_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

$selected_num = $selected_rs->num_rows;

for ($x = 0; $x < $selected_num; $x++) {
    $selected_data = $selected_rs->fetch_assoc();

?>
    <div class="col-12 mt-3 mb-3">
        <div class="row"  onclick="viewMsgModal('<?php echo $selected_data['email']; ?>');">
            <div class="col-2 col-lg-1  py-2 text-end">
                <span class="fs-4"><?php echo $x + 1; ?></span>
            </div>
           
            <div class="col-4 col-lg-2  py-2">
                <span class="fs-4"><?php echo $selected_data["fname"] . " " . $selected_data["lname"]; ?></span>
            </div>
            <div class="col-4 col-lg-4 d-lg-block py-2">
                <span class="fs-4 "><?php echo $selected_data["email"]; ?></span>
            </div>
            <div class="col-2 d-none d-lg-block  py-2">
                <span class="fs-4"><?php echo $selected_data["mobile"]; ?></span>
            </div>
            <div class="col-2 d-none d-lg-block py-2">
                <?php
                $splitDate = explode(" ", $selected_data["joined_date"]);
                ?>
                <span class="fs-4 "><?php echo $splitDate[0]; ?></span>
            </div>
            <div class="col-2 col-lg-1 py-2 d-grid">
                <?php
                if ($selected_data["status_status_id"] == 1) {
                ?>
                    <button 
                    id="ub<?php echo $selected_data["email"]; ?>" 
                    onclick="blockUser('<?php echo $selected_data['email']; ?>');" 
                    class="btn btn-danger">Block</button>
                <?php
                } else {
                ?>
                    <button 
                    id="ub<?php echo $selected_data["email"]; ?>" 
                    onclick="blockUser('<?php echo $selected_data['email']; ?>');" 
                    class="btn btn-success">Unblock</button>
                <?php
                }
                ?>

            </div>
        </div>
    </div>
    
<?php

}
?>

<!--  -->
<div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
    <nav aria-label="Page navigation example">
        <ul class="pagination pagination-lg justify-content-center">
            <li class="page-item">
                <a class="page-link" href="
                <?php if ($pageno <= 1) {
                    echo ("#");
                } else {
                    echo "?page=" . ($pageno - 1);
                } ?>
                " aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <?php
            for ($x = 1; $x <= $number_of_pages; $x++) {
                if ($x == $pageno) {
            ?>
                    <li class="page-item active">
                        <a class="page-link" href="<?php echo "?page=". ($x); ?>"><?php echo $x; ?></a>
                    </li>
                <?php
                } else {
                ?>
                    <li class="page-item">
                        <a class="page-link" href="<?php echo "?page=". ($x); ?>"><?php echo $x; ?></a>
                    </li>
            <?php
                }
            }
            ?>

            <li class="page-item">
                <a class="page-link" href="
                <?php if ($pageno >= $number_of_pages) {
                    echo ("#");
                } else {
                    echo "?page=" . ($pageno + 1);
                } ?>
                " aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>
<!--  -->

</div>
                        </div>
                    </div>




                </div>
            </div>
        </div>


    </div>
    
    <?php

} else {
    ?>
             <h1 class="text-danger text-center"></h1>  

                <?php
}
?>


    

    <script>
        window.onload = function() {
            var ctx = document.getElementById('lineChart').getContext('2d');

            var chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: months,
                    datasets: [{
                        label: 'Monthly Sales Quantity',
                        data: quantities,
                        borderColor: 'rgb(255, 0, 92)',
                        backgroundColor: 'rgba(254, 0, 187, 0.2)',
                        borderWidth: 2,
                        fill: true,
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        };
    </script>

    <script>
        function updateTime() {
            var now = new Date();
            var hours = now.getHours().toString().padStart(2, '0');
            var minutes = now.getMinutes().toString().padStart(2, '0');
            var seconds = now.getSeconds().toString().padStart(2, '0');

            document.getElementById('current-time').textContent = hours + ':' + minutes + ':' + seconds;
        }

        function updateDate() {
            var now = new Date();
            var year = now.getFullYear();
            var month = (now.getMonth() + 1).toString().padStart(2, '0');
            var day = now.getDate().toString().padStart(2, '0');

            document.getElementById('current-date').textContent = year + '-' + month + '-' + day;
        }

        // Update date and time immediately
        updateDate();
        updateTime();

        // Update time every second
        setInterval(updateTime, 1000);
        // Update date once per day (or when the page loads)
        setInterval(updateDate, 86400000);
    </script>


<script src="script.js"></script>

    <script src="line_chart.js"></script>
</body>

</html>