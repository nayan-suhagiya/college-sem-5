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
                            <h2>
                                <?= $row["name"] ?>
                            </h2>
                            <h4>
                                <?= $row["price"] ?>
                            </h4>
                            <h5>
                                <?= $row["description"] ?>
                            </h5>
                            <button class="button" data-bs-toggle="modal"
                                data-bs-target="#exampleModal<?= $row["package_id"] ?>">
                                <span>Continue</span><i class="material-icons"></i>
                            </button>
                        </div>
                    </div>
                </div>


                <?php
                $user_id = $_SESSION["user_id"];

                if ($user_id) {
                    $q = "SELECT * FROM blog_posts WHERE user_id=$user_id";
                    $rq = mysqli_query($conn, $q);

                }
                ?>

                <div class="modal fade text-dark" id="exampleModal<?= $row["package_id"] ?>" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">
                                    Select post!
                                </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <?php
                                while ($data = mysqli_fetch_assoc($rq)) {
                                    if ($data["comment_count"] == null) {
                                        $data["comment_count"] = 0;
                                    }
                                    ?>

                                    <div class="col-sm-12">
                                        <div class="card mb-3">
                                            <div class="row g-0">
                                                <div class="col-md-4">
                                                    <img src="<?= $data["image"] ?>" onerror="this.src='assets/site_logo.png'"
                                                        class="img-fluid rounded-start" alt="...">
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="card-body">
                                                        <h5 class="card-title">
                                                            <?= $data["title"] ?>
                                                        </h5>
                                                        <p class="card-text">
                                                            <i class="bi bi-heart-fill"></i> <span>
                                                                <?= $data["like_count"] ?>
                                                            </span>
                                                            <i class="bi bi-chat-dots"></i> <span>
                                                                <?= $data["comment_count"] ?>
                                                            </span>
                                                        </p>
                                                        <?php
                                                        $queryArr = array(
                                                            "post_id" => $data["post_id"],
                                                            "user_id" => $user_id,
                                                            "package_id" => $row["package_id"]
                                                        );

                                                        $queryObj = json_encode($queryArr);

                                                        $passed_string = base64_encode($queryObj);
                                                        ?>

                                                        <p class="text-primary">
                                                            <a href="add_campaign.php?data=<?= $passed_string ?>">Continue
                                                                with this post...</a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                }
                                ?>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <?php

            }
            ?>
        </section>
    </div>
</div>
<div class="bg"></div>
<div class="bg bg2"></div>
<div class="bg bg3"></div>