<?php
include "./sidebar.php";
?>
<main id="main" class="main">
  <section class="section dashboard">
    <div class="row">
      <!-- Left side columns -->
      <div class="col-lg-12">
        <div class="row">

          <!-- Sales Card -->
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card  sales-card">
              <a href="./blog_post.php" class="text-decoration-none">
                <div class="card-body">
                  <h5 class="card-title text-dark ">Total Post </h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cart"></i>
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
          </div><!-- End Sales Card -->

          <!-- Revenue Card -->
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card  revenue-card">
              <a href="./userInfo.php" class="text-decoration-none">
                <div class="card-body">
                  <h5 class="card-title text-dark ">Total User </h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div class="ps-3">
                      <h6>
                        <?php
                        $query = "select * from  Users";
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
          </div><!-- End Revenue Card -->

          <!-- Customers Card -->
          <div class="col-xxl-4 col-xl-12">

            <div class="card info-card  customers-card">
              <a href="./category.php" class="text-decoration-none">
                <div class="card-body">
                  <h5 class="card-title text-dark ">Total Category</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
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

        </div>
      </div><!-- End Left side columns -->
    </div>
  </section>

</main><!-- End #main -->