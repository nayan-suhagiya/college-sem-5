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
                      <h6><?php
                          $query = "select * from  blog_posts";
                          $result = mysqli_query($conn, $query);
                          $rowCount = mysqli_num_rows($result);
                          echo ($rowCount);
                          ?></h6>
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
                      <h6><?php
                          $query = "select * from  Users";
                          $result = mysqli_query($conn, $query);
                          $rowCount = mysqli_num_rows($result);
                          echo ($rowCount);
                          ?></h6>

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
                      <h6><?php
                          $query = "select * from  categories";
                          $result = mysqli_query($conn, $query);
                          $rowCount = mysqli_num_rows($result);
                          echo ($rowCount);
                          ?></h6>

                    </div>
                  </div>

                </div>
              </a>


            </div>

          </div><!-- End Customers Card -->



          <!-- Recent Sales -->
          <div class="col-12">
            <div class="card recent-sales overflow-auto">



              <div class="card-body">
                <h5 class="card-title text-dark ">Recent Sales <span>| Today</span></h5>

                <table class="table table-borderless datatable">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Customer</th>
                      <th scope="col">Product</th>
                      <th scope="col">Price</th>
                      <th scope="col">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row"><a href="#">#2457</a></th>
                      <td>Brandon Jacob</td>
                      <td><a href="#" class="text-primary">At praesentium minu</a></td>
                      <td>$64</td>
                      <td><span class="badge bg-success">Approved</span></td>
                    </tr>
                    <tr>
                      <th scope="row"><a href="#">#2147</a></th>
                      <td>Bridie Kessler</td>
                      <td><a href="#" class="text-primary">Blanditiis dolor omnis similique</a></td>
                      <td>$47</td>
                      <td><span class="badge bg-warning">Pending</span></td>
                    </tr>
                    <tr>
                      <th scope="row"><a href="#">#2049</a></th>
                      <td>Ashleigh Langosh</td>
                      <td><a href="#" class="text-primary">At recusandae consectetur</a></td>
                      <td>$147</td>
                      <td><span class="badge bg-success">Approved</span></td>
                    </tr>
                    <tr>
                      <th scope="row"><a href="#">#2644</a></th>
                      <td>Angus Grady</td>
                      <td><a href="#" class="text-primar">Ut voluptatem id earum et</a></td>
                      <td>$67</td>
                      <td><span class="badge bg-danger">Rejected</span></td>
                    </tr>
                    <tr>
                      <th scope="row"><a href="#">#2644</a></th>
                      <td>Raheem Lehner</td>
                      <td><a href="#" class="text-primary">Sunt similique distinctio</a></td>
                      <td>$165</td>
                      <td><span class="badge bg-success">Approved</span></td>
                    </tr>
                  </tbody>
                </table>

              </div>

            </div>
          </div><!-- End Recent Sales -->



        </div>
      </div><!-- End Left side columns -->
    </div>
  </section>

</main><!-- End #main -->