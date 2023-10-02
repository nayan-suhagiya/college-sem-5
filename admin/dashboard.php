<?php
include "./sidebar.php";
?>
<main id="main" class="main">
  <section class="section dashboard">
    <h1 class="text-center my-4 ">Welcome Admin Portal</h1>
    <div class="row">
      <!-- Left side columns -->
      <div class="col-lg-12">
        <div class="row">
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card  revenue-card">
              <a href="./userInfo.php" class="text-decoration-none">
                <div class="card-body">
                  <h5 class="card-title text-dark ">Total User </h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people "></i>
                    </div>
                    <div class="ps-3">
                      <h6>
                        <?php
                        $query = "select * from  Users where user_type='client'";
                        $result = mysqli_query($conn, $query);
                        $rowCount = mysqli_num_rows($result);
                        echo ($rowCount);
                        ?>
                      </h6>

                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>
          <div class="col-xxl-4 col-xl-12">
            <div class="card info-card  customers-card">
              <a href="./category.php" class="text-decoration-none">
                <div class="card-body">
                  <h5 class="card-title text-dark ">Total Category</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi  bi-boxes"></i>
                    </div>
                    <div class="ps-3">
                      <h6>
                        <?php
                        $query = "select * from  categories";
                        $result = mysqli_query($conn, $query);
                        $rowCount = mysqli_num_rows($result);
                        echo ($rowCount);
                        ?>
                      </h6>

                    </div>
                  </div>

                </div>
              </a>


            </div>

          </div><!-- End Customers Card -->
          <!-- Sales Card -->
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card  sales-card">
              <a href="./blog_post.php" class="text-decoration-none">
                <div class="card-body">
                  <h5 class="card-title text-dark ">Total Post </h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-postcard-heart-fill"></i>
                    </div>
                    <div class="ps-3">
                      <h6>
                        <?php
                        $query = "select * from  blog_posts";
                        $result = mysqli_query($conn, $query);
                        $rowCount = mysqli_num_rows($result);
                        echo ($rowCount);
                        ?>
                      </h6>
                    </div>
                  </div>
                </div>
              </a>



            </div>
          </div>
        </div>

        <div class="row mt-2">
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card  revenue-card">
              <a href="./promotion_package.php" class="text-decoration-none">
                <div class="card-body">
                  <h5 class="card-title text-dark ">Total Promotion Package </h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-award "></i>
                    </div>
                    <div class="ps-3">
                      <h6>
                        <?php
                        $query = "select * from  promotion_package ";
                        $result = mysqli_query($conn, $query);
                        $rowCount = mysqli_num_rows($result);
                        echo ($rowCount);
                        ?>
                      </h6>

                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>
          <div class="col-xxl-4 col-xl-12">
            <div class="card info-card  customers-card">
              <a href="./campaign.php" class="text-decoration-none">
                <div class="card-body">
                  <h5 class="card-title text-dark ">Total Running Campaign Post</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi  bi-bar-chart-line"></i>
                    </div>
                    <div class="ps-3">
                      <h6>
                        <?php
                        $query = "select * from  campaigns where status = 'running'";
                        $result = mysqli_query($conn, $query);
                        $rowCount = mysqli_num_rows($result);
                        echo ($rowCount);
                        ?>
                      </h6>

                    </div>
                  </div>

                </div>
              </a>


            </div>

          </div><!-- End Customers Card -->
          <!-- Sales Card -->
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card  sales-card">
              <a href="./campaign.php" class="text-decoration-none">
                <div class="card-body">
                  <h5 class="card-title text-dark ">Total Campaign Revenue </h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-currency-rupee"></i>
                    </div>
                    <div class="ps-3">
                      <h6>
                        <?php
                        $query = "select sum(total_amount) from  campaigns";
                        $result = mysqli_query($conn, $query);
                        $rowCount = mysqli_fetch_row($result)[0];
                        echo ($rowCount);
                        ?>
                      </h6>
                    </div>
                  </div>
                </div>
              </a>



            </div>
          </div>
        </div>
      </div><!-- End Left side columns -->
    </div>
  </section>

</main><!-- End #main -->