<?php
session_start();
require_once 'config/koneksi.php';

if (isset($_SESSION['login'])) {
  header("Location: index.php");
  exit;
}

if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $result = $conn->query("SELECT * FROM tb_user WHERE username = '$username'") or die(mysqli_error($conn));
  if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
      // pasang session
      $_SESSION['login'] = $row;

      header("Location: index.php");
      exit;
    }
  }
}

$ambilBuku = $conn->query("SELECT * FROM tb_buku ORDER BY id_buku DESC") or die(mysqli_error($conn));

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Halaman Login</title>
  <link href="css/styles.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
  <style>
    .mt-5{
      margin-top: 77px !important;
    }
  </style>
</head>

<body class="bg-primary">
  <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
 <img src="" alt=""> <a class="navbar-brand" href="#">PERPUSTAKAAN KKLP XLIV</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </nav>
  <div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
      <main>
        <div class="">
          <div class="row justify-content-center">
            <div class="col-lg-8">
              <div class="card mb-4 mt-5">
                <div class="card-header">
                  <i class="fas fa-table mr-1"></i>
                  Data Buku
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Cover</th>
                                    <th>Judul</th>
                                    <th>Pengarang</th>
                                    <th>Penerbit</th>
                                    <th>ISBN</th>
                                    <th> No Kelas BukU </th>
                                    <th>Jumlah Buku</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $no = 1;
                                while ($pecahBuku = $ambilBuku->fetch_assoc()) {
                                
                                ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><img style="width:100px;height:100px;" src="<?= $pecahBuku['cover']; ?>" onerror="this.onerror=null;this.src='/assets/img/no-cover_en_US.jpg';" alt=""></td>
                                    <td><?= $pecahBuku['judul_buku']; ?></td>
                                    <td><?= $pecahBuku['pengarang_buku']; ?></td>
                                    <td><?= $pecahBuku['penerbit_buku']; ?></td>
                                    <td><?= $pecahBuku['isbn']; ?></td>
                                    <td><?= $pecahBuku['kelas_buku']; ?></td>
                                    <td><?= $pecahBuku['jumlah_buku']; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header">
                  <h3 class="text-center font-weight-light my-4">Login</h3>
                </div>
                <div class="card-body">
                  <form action="" method="post">
                    <div class="form-group">
                      <label class="small mb-1" for="username">Username</label>
                      <input class="form-control py-4" name="username" id="username" type="text" placeholder="Masukan username anda" />
                    </div>
                    <div class="form-group">
                      <label class="small mb-1" for="password">Password</label>
                      <input class="form-control py-4" id="password" name="password" type="password" placeholder="Masukan password" />
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" id="rememberPasswordCheck" type="checkbox" />
                        <label class="custom-control-label" for="rememberPasswordCheck">Remember password</label>
                      </div>
                    </div>
                    <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                      <button type="submit" name="login" class="btn btn-primary">Login</button>
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center">
                  <!-- <div class="small"><a href="register.html">Need an account? Sign up!</a></div> -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="js/scripts.js"></script>
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script> -->
  <!-- <script src="assets/demo/chart-area-demo.js"></script> -->
  <!-- <script src="assets/demo/chart-bar-demo.js"></script> -->
  <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
  <script src="assets/demo/datatables-demo.js"></script>
</body>

</html>