<?php require "admin-header.php"; ?>


<main id="main" class="main">

    <div class="pagetitle">
      <h1>Analysis</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Charts</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <p>Admin can get analysis of all the students in the database.</p>

    <section class="section">
      <div class="row">


        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Junior Class</h5>

              <?php
                $sql = "SELECT * FROM users WHERE admin_verify='1' AND class='JSS3B'";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->get_result();
                $count_ss3 = $result->num_rows;
               if($count_ss3 < 0 || $count_ss3 == 0){
                $count_ss3 = 0;
               }
                ?>
                <?php
                $sql = "SELECT * FROM users WHERE admin_verify='1' AND class='JSS3A'";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->get_result();
                $count_ss2 = $result->num_rows;
               if($count_ss2 < 0 || $count_ss2 == 0){
                $count_ss2 = 0;
               }
                ?>
                <?php
                $sql = "SELECT * FROM users WHERE admin_verify='1' AND class='JSS2B'";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->get_result();
                $count_ss1 = $result->num_rows;
               if($count_ss1 < 0 || $count_ss1 == 0){
                $count_ss1 = 0;
               }
                ?>
                <?php
                $sql = "SELECT * FROM users WHERE admin_verify='1' AND class='JSS2A'";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->get_result();
                $count_jss3 = $result->num_rows;
               if($count_jss3 < 0 || $count_jss3 == 0){
                $count_jss3 = 0;
               }
                ?>
                <?php
                $sql = "SELECT * FROM users WHERE admin_verify='1' AND class='JSS1B'";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->get_result();
                $count_jss2 = $result->num_rows;
               if($count_jss2 < 0 || $count_jss2 == 0){
                $count_jss2 = 0;
               }
                ?>
                <?php
                $sql = "SELECT * FROM users WHERE admin_verify='1' AND class='JSS1A'";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->get_result();
                $count_jss1 = $result->num_rows;
               if($count_jss1 < 0 || $count_jss1 == 0){
                $count_jss1 = 0;
               }
                ?>

              <!-- Bar Chart -->
              <canvas id="barChart" style="max-height: 1000px;"></canvas>
              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new Chart(document.querySelector('#barChart'), {
                    type: 'bar',
                    data: {
                      labels: ['JSS1A', 'JSS1B', 'JSS2A', 'JSS2B', 'JSS3A', 'JSS3B'],
                      datasets: [{
                        label: 'Bar Chart',
                        data: [<?= $count_jss1; ?>, <?= $count_jss2; ?>, <?= $count_jss3; ?>, <?= $count_ss1; ?>, <?= $count_ss2; ?>, <?= $count_ss3; ?>],
                        backgroundColor: [
                          'rgba(255, 99, 132, 0.2)',
                          'rgba(255, 159, 64, 0.2)',
                          'rgba(255, 205, 86, 0.2)',
                          'rgba(75, 192, 192, 0.2)',
                          'rgba(54, 162, 235, 0.2)',
                          'rgba(153, 102, 255, 0.2)',
                          'rgba(201, 203, 207, 0.2)'
                        ],
                        borderColor: [
                          'rgb(255, 99, 132)',
                          'rgb(255, 159, 64)',
                          'rgb(255, 205, 86)',
                          'rgb(75, 192, 192)',
                          'rgb(54, 162, 235)',
                          'rgb(153, 102, 255)',
                          'rgb(201, 203, 207)'
                        ],
                        borderWidth: 1
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
                });
              </script>
              <!-- End Bar CHart -->


            </div>
          </div>
        </div>


        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Secondary Class</h5>

              <?php
                $sql = "SELECT * FROM users WHERE admin_verify='1' AND class='SS3B'";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->get_result();
                $count_ss3 = $result->num_rows;
               if($count_ss3 < 0 || $count_ss3 == 0){
                $count_ss3 = 0;
               }
                ?>
                <?php
                $sql = "SELECT * FROM users WHERE admin_verify='1' AND class='SS3A'";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->get_result();
                $count_ss2 = $result->num_rows;
               if($count_ss2 < 0 || $count_ss2 == 0){
                $count_ss2 = 0;
               }
                ?>
                <?php
                $sql = "SELECT * FROM users WHERE admin_verify='1' AND class='SS2B'";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->get_result();
                $count_ss1 = $result->num_rows;
               if($count_ss1 < 0 || $count_ss1 == 0){
                $count_ss1 = 0;
               }
                ?>
                <?php
                $sql = "SELECT * FROM users WHERE admin_verify='1' AND class='SS2A'";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->get_result();
                $count_jss3 = $result->num_rows;
               if($count_jss3 < 0 || $count_jss3 == 0){
                $count_jss3 = 0;
               }
                ?>
                <?php
                $sql = "SELECT * FROM users WHERE admin_verify='1' AND class='SS1B'";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->get_result();
                $count_jss2 = $result->num_rows;
               if($count_jss2 < 0 || $count_jss2 == 0){
                $count_jss2 = 0;
               }
                ?>
                <?php
                $sql = "SELECT * FROM users WHERE admin_verify='1' AND class='SS1A'";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->get_result();
                $count_jss1 = $result->num_rows;
               if($count_jss1 < 0 || $count_jss1 == 0){
                $count_jss1 = 0;
               }
                ?>

              <!-- Bar Chart -->
              <canvas id="secChart" style="max-height: 1000px;"></canvas>
              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new Chart(document.querySelector('#secChart'), {
                    type: 'bar',
                    data: {
                      labels: ['SS1A', 'SS1B', 'SS2A', 'SS2B', 'SS3A', 'SS3B'],
                      datasets: [{
                        label: 'Bar Chart',
                        data: [<?= $count_jss1; ?>, <?= $count_jss2; ?>, <?= $count_jss3; ?>, <?= $count_ss1; ?>, <?= $count_ss2; ?>, <?= $count_ss3; ?>],
                        backgroundColor: [
                          'rgba(255, 99, 132, 0.2)',
                          'rgba(255, 159, 64, 0.2)',
                          'rgba(255, 205, 86, 0.2)',
                          'rgba(75, 192, 192, 0.2)',
                          'rgba(54, 162, 235, 0.2)',
                          'rgba(153, 102, 255, 0.2)',
                          'rgba(201, 203, 207, 0.2)'
                        ],
                        borderColor: [
                          'rgb(255, 99, 132)',
                          'rgb(255, 159, 64)',
                          'rgb(255, 205, 86)',
                          'rgb(75, 192, 192)',
                          'rgb(54, 162, 235)',
                          'rgb(153, 102, 255)',
                          'rgb(201, 203, 207)'
                        ],
                        borderWidth: 1
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
                });
              </script>
              <!-- End Bar CHart -->


            </div>
          </div>
        </div>


      </div>
    </section>

  </main><!-- End #main -->



<?php require "main-footer.php"; ?>