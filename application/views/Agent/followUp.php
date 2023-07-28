<?php include 'header.php'; ?>
<?php include 'navigation.php'; ?>

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Follow Up Report for : - <span style="color:darkblue;"> <?= sizeof($followUp) > 0 ? $followUp[0]['quoId'] : ""; ?></span></h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <section class="content">
    <div class="container-fluid">

      <!-- Timelime example  -->
      <div class="row">
        <div class="col-md-12">
          <!-- The time line -->
          <?php
          if (sizeof($followUp) > 0) { ?>
            <div class="timeline">

              <?php
              foreach ($followUp as  $value) { ?>
                <div>
                  <i class="fas fa-comments bg-green"></i>
                  <div class="timeline-item">
                    <span class="time" style="color:darkblue;"><i class="fas fa-clock"></i> <strong><?= $value['followupDate']; ?></strong></span>
                    <h3 class="timeline-header no-border"> <?= $value['message']; ?></h3>
                  </div>
                </div>
              <?php
              } ?>
              <div>
                <i class="fas fa-clock bg-gray"></i>
              </div>
            <?php  } else {
            echo "<h3>No Data......</h3>";
          }
            ?>
            </div>
        </div>
        <!-- /.col -->
      </div>
    </div>
    <!-- /.timeline -->

  </section>
  <!-- /.content -->
</div>
<?php include 'footer.php'; ?>