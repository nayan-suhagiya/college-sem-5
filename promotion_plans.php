<?php
include "./navbar_dash.php";
?>
<div id="main-container">
    <div class="container">
        <h1>Choose your Promotion Plans</h1>

        <section class="boxes row ">

            <?php $query = "SELECT * FROM promotion_package";
            $result = mysqli_query($conn, $query);
            $i = 1;
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <div class="col-4 my-2 ">
                    <div class="box blue">
                        <div class="number-bg">6</div>
                        <div class="box-content">
                            <h2> <?= $row["name"] ?></h2>
                            <h4> <?= $row["price"] ?></h4>
                            <h5> <?= $row["description"] ?></h5><a class="button" href="javascript:void(0)"> <span>Continue</span><i class="material-icons"></i></a>
                        </div>
                    </div>
                </div>

            <?php

            }
            ?>
        </section>
    </div>
</div>