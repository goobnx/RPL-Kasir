<?php
    include "ceklogin.php";

    

// Hitung jumlah barang
$hitungproduk1 = mysqli_query($koneksi, "SELECT * FROM produk");
$hitungproduk2 = mysqli_num_rows($hitungproduk1);

// Edit barang
if(isset($_POST['editbarang'])) {
    $idproduk = $_POST['idproduk'];
    $namaproduk = $_POST['namaproduk'];
    $hargaproduk = $_POST['hargaproduk'];
    

    $updatebarang = mysqli_query($koneksi, "UPDATE produk SET namaproduk='$namaproduk', hargaproduk='$hargaproduk' WHERE idproduk='$idproduk'");
    if($updatebarang) {
        echo '<script>
                alert("Berhasil mengedit barang!");
                location.href="stok.php";
              </script>';
    } else {
        echo '<script>alert("Gagal mengedit barang!");
        window.location.href="stok.php"</script>';
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Toko Serbaguna - Produk</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon">
                    <i class="fa-solid fa-cookie-bite"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Five's Bakery</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Menu
            </div>

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
                    aria-controls="collapseTwo">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span>Pesanan</span>
                </a>
                <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item active" href="index.php">Data Pesanan</a>
                        <a class="collapse-item active" href="laporan.php">Laporan Penjualan</a>
                    </div>
                </div>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="stok.php">
                    <i class="fa-solid fa-boxes-stacked"></i>
                    <span>Stok Barang</span></a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="masuk.php">
                    <i class="fa-solid fa-truck-fast"></i>
                    <span>Barang Masuk</span></a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="pelanggan.php">
                    <i class="fa-solid fa-users"></i>
                    <span>Kelola Pelanggan</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <div>
                        <h1 class="h3 text-gray-800">Data Produk</h1>
                    </div>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </ul>
                </nav>

                <?php
                // Tambah barang
                if(isset($_POST['tambahproduk'])) {   
                    $namaproduk = $_POST['namaproduk'];
                    $hargaproduk = $_POST['hargaproduk'];
                    $stokproduk = $_POST['stokproduk'];

                    $tambahproduk = mysqli_query($koneksi, "INSERT INTO produk (namaproduk, hargaproduk, stokproduk) VALUES
                        ('$namaproduk','$hargaproduk', '$stokproduk' )");

                    if($tambahproduk) {
                        echo '<div class="alert alert-success mx-4" role="alert">
                                Berhasil menambah barang baru!
                              </div>';
                        echo '<script>
                                setTimeout(function(){
                                  window.location.href="stok.php";
                                }, 2000); // Redirect setelah 2 detik
                              </script>';
                    } else {
                        echo '<div class="alert alert-danger mx-4" role="alert">
                                Gagal menambah barang baru!
                              </div>';
                        echo '<script>
                                setTimeout(function(){
                                  window.location.href="stok.php";
                                }, 2000); // Redirect setelah 2 detik
                              </script>';
                    }
                }

                // Hapus barang
                if(isset($_POST['hapusbarang'])) {
                    $idproduk = $_POST['idproduk'];

                    $hapusbarang = mysqli_query($koneksi, "DELETE FROM produk WHERE idproduk='$idproduk'");
                    if($hapusbarang) {
                        echo '<div class="alert alert-danger mx-4" role="alert">
                                Berhasil menghapus barang!
                              </div>';
                        echo '<script>
                                setTimeout(function(){
                                  window.location.href="stok.php";
                                }, 2000); // Redirect setelah 2 detik
                              </script>';
                    } else {
                        echo '<div class="alert alert-default mx-4" role="alert">
                                Gagal menghapus barang!
                              </div>';
                        echo '<script>
                                setTimeout(function(){
                                  window.location.href="stok.php";
                                }, 2000); // Redirect setelah 2 detik
                              </script>';
                    }
                }
                ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Jumlah Barang</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?=$hitungproduk2;?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa-solid fa-boxes-stacked fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#myModal">Tambah Barang Baru
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Barang</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>ID Produk</th>
                                            <th>Nama Produk</th>                                      
                                            <th>Harga Produk</th>
                                            <th>Stok Produk</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $ambilproduk = mysqli_query($koneksi, "SELECT * FROM produk");
                                            $i = 1;
                                            while($p=mysqli_fetch_array($ambilproduk)) {
                                                $idproduk = $p['idproduk'];
                                                $namaproduk = $p['namaproduk'];
                                                $hargaproduk = $p['hargaproduk'];
                                                $stokproduk = $p['stokproduk']; 
                                            ?>    

                                        <tr>
                                            <td><?=$i++;?></td>
                                            <td>KP<?=sprintf("%03d", $idproduk);?></td>
                                            <td><?=$namaproduk;?></td>
                                            <td>Rp. <?=number_format($hargaproduk);?></td>
                                            <td><?=$stokproduk;?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$idproduk;?>">Edit
                                                </button> | 
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapus<?=$idproduk;?>">Hapus
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- Modal untuk edit -->
                                        <div class="modal fade" id="edit<?=$idproduk;?>">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                              
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                  <h4 class="modal-title">Ubah <?=$namaproduk;?></h4>
                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>

                                                <form method="post">
                                                
                                                <!-- Modal body -->
                                                <div class="modal-body"> 
                                                  <input type="text" name="namaproduk" class="form-control mt-3" placeholder="Nama Produk" value="<?=$namaproduk;?>">
                                                  <input type="number" name="hargaproduk" class="form-control mt-3" placeholder="Harga Produk" value="<?=$hargaproduk;?>">
                                                  <input type="hidden" name="idproduk" value="<?=$idproduk;?>">
                                                </div>
                                                
                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                  <button type="submit" class="btn btn-success" name="editbarang">Simpan</button>
                                                  <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                                </div>

                                                </form>
                                                
                                              </div>
                                            </div>
                                          </div>

                                          <!-- Modal untuk hapus -->
                                        <div class="modal fade" id="hapus<?=$idproduk;?>">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                              
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                  <h4 class="modal-title">Hapus <?=$namaproduk;?></h4>
                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>

                                                <form method="post">
                                                
                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                  Apakah Anda yakin ingin menghapus produk ini?
                                                  <input type="hidden" name="idproduk" value="<?=$idproduk;?>">
                                                </div>
                                                
                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                  <button type="submit" class="btn btn-success" name="hapusbarang">Yakin</button>
                                                  <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                                </div>

                                                </form>
                                                
                                              </div>
                                            </div>
                                          </div>

                                    <?php
                                    }; // Penutup PHP di atas agar mencakup semua tr untuk di-while
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span><b>Website Kasir</b> &copy; by XI RPL (Kelompok 5)</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin untuk keluar?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih "Logout" di bawah ini jika Anda siap untuk mengakhiri sesi saat ini.
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
</body>
<!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Barang Baru</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <form method="post">
        
        <!-- Modal body -->
        <div class="modal-body">
          <input type="text" name="namaproduk" class="form-control mt-3" placeholder="Nama Produk" required>
          <input type="number" name="hargaproduk" class="form-control mt-3" placeholder="Harga Produk" required>
          <input type="number" name="stokproduk" class="form-control mt-3" placeholder="Stok Produk"
          required>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" name="tambahproduk">Simpan</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>

        </form>
        
      </div>
    </div>
  </div>
</html>