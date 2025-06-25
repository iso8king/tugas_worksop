<?php
include 'koneksi.php';

$sql = "SELECT 
            bd.borrow_details_id,
            bd.borrow_id,
            bd.book_id,
            bd.borrow_status,
            bd.date_return,
            b.book_title,
            br.date_borrow,
            m.firstname,
            m.lastname
        FROM borrowdetails bd
        LEFT JOIN book b ON bd.book_id = b.book_id
        LEFT JOIN borrow br ON bd.borrow_id = br.borrow_id
        LEFT JOIN member m ON br.member_id = m.member_id
        ORDER BY bd.borrow_details_id ASC";

$result = mysqli_query($db, $sql);
?>

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Laporan Detail Peminjaman</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
          <li class="breadcrumb-item active">Laporan Peminjaman</li>
        </ol>
      </div>
    </div>
  </div>
</section>

<section class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Data Peminjaman Buku</h3>
      </div>
      <div class="card-body">
        <table id="borrowTable" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>ID Peminjaman</th>
              <th>Nama Peminjam</th>
              <th>Judul Buku</th>
              <th>Status</th>
              <th>Tanggal Pinjam</th>
              <th>Tanggal Kembali</th>
            </tr>
          </thead>
          <tbody>
            <?php
              if ($result && mysqli_num_rows($result) > 0) {
                  $no = 1;
                  while ($row = mysqli_fetch_assoc($result)) {
                      $nama = $row['firstname'] . ' ' . $row['lastname'];
            ?>
              <tr>
                <td class="text-center"><?= $no++; ?></td>
                <td><?= htmlspecialchars($row['borrow_id']); ?></td>
                <td><?= htmlspecialchars($nama); ?></td>
                <td><?= htmlspecialchars($row['book_title'] ?? '-'); ?></td>
                <td><?= $row['borrow_status'] == 1 ? 'Dikembalikan' : 'Dipinjam'; ?></td>
                <td><?= htmlspecialchars($row['date_borrow'] ?? '-'); ?></td>
                <td><?= htmlspecialchars($row['date_return'] ?? '-'); ?></td>
              </tr>
            <?php
                  }
              } else {
                echo '<tr><td colspan="7" class="text-center">Tidak ada data peminjaman.</td></tr>';
              }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
  if ($('#borrowTable').length) {
    $('#borrowTable').DataTable({
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
      "responsive": true,
      "lengthChange": true,
      "autoWidth": false
    }).buttons().container().appendTo('#borrowTable_wrapper .col-md-6:eq(0)');
  }
});
</script>
