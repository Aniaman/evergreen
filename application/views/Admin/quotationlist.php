<?php include 'header.php'; ?>
<?php include 'navigation.php'; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    $("#myInput").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#myTable tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });
</script>

<div class="content-wrapper">
  <!-- Main content -->
  <div class="card">
    <div class="card-header">
      <strong>
        <h3 class="card-title">Qoutation List</h3>
      </strong>
      <form class="form-inline" style="padding-left: 70%;">
        <input type="search" class="form-control" area-label="Search" name="" id="myInput" placeholder="search">
      </form>
    </div>
    <?php if ($error = $this->session->flashdata('delete')) { ?>
      <div class="row">
        <div class="alert alert-success">
          <?php echo $error; ?>
        </div>
      </div>
    <?php } ?>
    <?php if ($error = $this->session->flashdata('update')) { ?>
      <div class="row">
        <div class="alert alert-success">
          <?php echo $error; ?>
        </div>
      </div>
    <?php } ?>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead class="text-center">
          <tr>
            <th>SL No</th>
            <th>Agent Name</th>
            <th>Enquiry Id</th>
            <th>Quotation ID</th>
            <th>Total</th>
            <th>Commission Rate</th>
            <th>Commission Amount</th>
            <th>Net Total</th>
            <th></th>
          </tr>
        </thead>
        <tbody id="myTable">
          <tr>
            <?php
            $s = 1;
            foreach ($details as $value) {
              $this->load->library('session');
              $this->session->set_userdata('qid', $value['quoId']);
              $Agid = $value['Agid'];
              $q = $this->db->select('name')
                ->where(['id' => $Agid])
                ->get('agent');
              $Agentname = $q->result_array();
              $commiAmount = $value['commi'] - $value['total'];
              $id = $value['quoId'];

              $qid = str_getcsv($id, "/", "'");
              $quoid = $qid[2];

            ?>
          <tr>
            <td><?php echo $s; ?></td>
            <td><?php echo $Agentname[0]['name']; ?></td>
            <td><?php echo $value['enqId']; ?></td>
            <td><?php echo $value['quoId']; ?></td>
            <td><?php echo $value['total']; ?></td>
            <td><?php echo $value['rate']; ?></td>
            <td><?php echo $commiAmount; ?></td>
            <td><?php echo $value['commi']; ?></td>
            <td><a href="<?php echo site_url("Admin/Makeinvoice/{$quoid}"); ?>" class="btn btn-success">Invoice</a> </td>

          </tr>
        <?php $s++;
            }


        ?>
        </tr>
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.col -->

<?php include 'footer.php'; ?>