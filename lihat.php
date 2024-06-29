<?php
    include "ceklogin.php";

    if(isset($_GET['idp'])) {
        $idp = $_GET['idp'];

        $ambilnamapelanggan = mysqli_query($koneksi, "SELECT * FROM pesanan p, pelanggan pl WHERE p.idpelanggan=pl.idpelanggan AND p.idpesanan='$idp'");
        if(mysqli_num_rows($ambilnamapelanggan) > 0) {
            $np = mysqli_fetch_array($ambilnamapelanggan);
            $namapel = $np['namapelanggan'];
            $alamatpelanggan = $np['alamatpelanggan'];
        } else {
            header('location:index.php');
        }
    }

    // Mengecek apakah stok cukup untuk dibeli
    if(isset($_POST['addproduk'])) {
        // Tangkap data yang dikirimkan dari form
        $idp = $_POST['idp'];
        $idproduk = $_POST['idproduk'];
        $jumlahproduk = $_POST['jumlahproduk'];

        // Hitung stok sekarang ada berapa
        $hitungstok1 = mysqli_query($koneksi, "SELECT * FROM produk WHERE idproduk='$idproduk'");
        if(mysqli_num_rows($hitungstok1) > 0) {
            $hitungstok2 = mysqli_fetch_array($hitungstok1);
            $stoksekarang = $hitungstok2['stokproduk']; // Stok barang saat ini

            if($jumlahproduk > $stoksekarang) { // Menggunakan $stoksekarang
                echo '<script>
                    alert("Stok barang tidak cukup!");
                    window.location.href="lihat.php?idp='.$idp.'";
                </script>';
                exit; // Keluar dari skrip jika stok tidak mencukupi
            }
        }

        // Lakukan penambahan data barang ke dalam tabel keranjang
        $tambahbarang = mysqli_query($koneksi, "INSERT INTO keranjang (idpesanan, idproduk, jumlahproduk) VALUES ('$idp', '$idproduk', '$jumlahproduk')");

        // Redirect ke halaman yang sama setelah proses selesai
        header('Location: lihat.php?idp=' . $idp);
    }

    // Edit keranjang
    if(isset($_POST['editkeranjang'])) {
        $jumlahproduk = $_POST['jumlahproduk'];
        $idkeranjang = $_POST['idkeranjang']; // ID keranjang
        $idproduk = $_POST['idproduk'];
        $idpesanan = $_POST['idpesanan'];

            $query1 = mysqli_query($koneksi, "UPDATE keranjang SET jumlahproduk='$jumlahproduk' WHERE idkeranjang='$idkeranjang'");

            // Cek apakah data berhasil diperbarui
            if ($query1) {
                echo '<script>
                    alert("Berhasil mengedit data barang masuk!");
                    window.location.href="lihat.php?idp='.$idp.'";
                </script>';
            } else {
                echo '<script>
                    alert("Gagal mengedit data barang masuk!");
                    window.location.href="lihat.php?idp='.$idp.'";
                </script>';
            }
    }

    // Hapus keranjang
    if(isset($_POST['hapuskeranjang'])) {
    // Tangkap data yang dikirimkan dari form
    $idkeranjang = $_POST['idkeranjang'];
    $idproduk = $_POST['idproduk'];
    $idp = $_POST['idp'];

    // Lakukan penghapusan data barang dari tabel keranjang
    $hapusbarang = mysqli_query($koneksi, "DELETE FROM keranjang WHERE idkeranjang='$idkeranjang'");
    
    if($hapusbarang) {
        // Jika penghapusan berhasil, tampilkan pesan sukses
        echo '<script>alert("Barang berhasil dihapus.");</script>';
    } else {
        // Jika penghapusan gagal, tampilkan pesan gagal
        echo '<script>alert("Gagal menghapus barang.");</script>';
    }
    
    // Redirect ke halaman yang sama setelah proses selesai
    header('Location: lihat.php?idp=' . $idp);
    exit; // Pastikan keluar dari skrip setelah redirect
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
    <title>Toko Serbaguna - Detail Pesanan
    </title>
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
                        <h3 class="h3 text-gray-800 mt-2 mb-0">Data Pesanan : <b><?=$idp;?></b></h3>
                        <h4 class="h4 text-gray-800 mb-2">Nama Pelanggan : <b><?=$namapel ;?></b></h4>
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
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Tambah Barang
                                    </button>
                                </div>
                            </div>
                        </div>


                    </div>

                    <!-- Content Row -->

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Pesanan</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID Produk</th>
                                            <th>Nama Produk</th>
                                            <th>Harga Satuan</th>
                                            <th>Jumlah</th>
                                            <th>Subtotal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $ambilpesanan = mysqli_query($koneksi, "SELECT * FROM keranjang p, produk pr WHERE p.idproduk=pr.idproduk AND idpesanan='$idp'");
                                            $i = 1;
                                            $totalharga = 0; // Inisialisasi total subtotal
                                            $totalid = new SplObjectStorage();
                                            while($p=mysqli_fetch_array($ambilpesanan)) {
                                                $idproduk = $p['idproduk'];
                                                $idkeranjang = $p['idkeranjang'];
                                                $namaproduk = $p['namaproduk'];
                                                $hargaproduk = $p['hargaproduk'];
                                                $jumlahproduk = $p['jumlahproduk'];
                                                $subtotal = $jumlahproduk * $hargaproduk;
                                                $totalharga += $subtotal; // Menambahkan subtotal pada setiap iterasi

                                                // Membuat objek standar baru
                                                $produkid = new stdClass();
                                                $produkid->id = $idproduk; // Menetapkan ID produk ke properti
                                                $totalid->attach($produkid);
                                        ?>
                                        <tr>
                                            <td>KP<?=sprintf("%03d", $idproduk);?></td>
                                            <td><?=$namaproduk;?></td>
                                            <td>Rp. <?=number_format($hargaproduk);?></td>
                                            <td><?=number_format($jumlahproduk);?></td>
                                            <td>Rp. <?=number_format($subtotal);?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$idproduk;?>">Edit </button> | 
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$idproduk;?>">Hapus</button>
                                            </td>
                                        </tr>

                                        <!-- Modal untuk edit -->
                                        <div class="modal fade" id="edit<?=$idproduk;?>">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                              
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                  <h4 class="modal-title">Ubah Detail Pesanan</h4>
                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>

                                                <form method="post">
                                                
                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                  <input type="text" name="namaproduk" class="form-control" placeholder="Nama Produk" value="<?=$namaproduk;?>"
                                                  readonly>
                                                  <input type="number" name="jumlahproduk" class="form-control mt-3" placeholder="Jumlah Produk" value="<?=$jumlahproduk;?>" min="1">
                                                  <input type="hidden" name="idkeranjang" value="<?=$idkeranjang;?>">
                                                  <input type="hidden" name="idproduk" value="<?=$idproduk;?>">
                                                  <input type="hidden" name="idpesanan" value="<?=$idpesanan;?>">
                                                </div>
                                                
                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                  <button type="submit" class="btn btn-success" name="editkeranjang">Simpan</button>
                                                  <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                                </div>

                                                </form>
                                                
                                              </div>
                                            </div>
                                        </div>

                                        <div class="modal fade" id="delete<?=$idproduk;?>">
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
                                                    Apakah Anda yakin ingin menghapus barang ini?
                                                    <input type="hidden" name="idkeranjang"
                                                    value="<?=$idkeranjang;?>">
                                                    <input type="hidden" name="idproduk" value="<?=$idproduk;?>">
                                                    <input type="hidden" name="idp" value="<?=$idp;?>">
                                                </div>
                                                
                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                  <button type="submit" class="btn btn-success" name="hapuskeranjang">Yakin</button>
                                                  <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                                </div>
                                                </form>
                                              </div>
                                            </div>
                                          </div>
                                    <?php
                                    }; // Penutup PHP di atas agar mencakup semua tr untuk di-while

                                    // Hitung total item unik
                                    $totalitem = $totalid->count();

                                    ?>
                                    </tbody>
                                </table><br>

                                <table class="table table-striped">
                                    <form method="POST">     
                                        <tr>
                                            <td>Total Item</td>
                                            <td>
                                                <input type="text" class="form-control font-weight-bold"
                                                name="totalitem" value="<?=$totalitem;?>">
                                            </td>
                                            <td>Total Semua</td>
                                            <td colspan="2">
                                                <input type="text" class="form-control font-weight-bold"
                                                name="totalharga" value="Rp. <?= number_format($totalharga); ?>">
                                            </td>  
                                        </tr>
                                        <tr>
                                            <td>Bayar</td>
                                            <td>
                                                <input type="text" class="form-control" name="inputbayar" id="inputbayar" min="0" required>
                                            </td>
                                                                            
                                            <td>Kembali</td>
                                            <td>
                                                <input type="text" class="form-control font-weight-bold" id="kembalianinput" name="kembalianinput" value="Rp. <?= isset($kembalian) ? number_format($kembalian, 0, ',',',') : ''; ?>" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                            <button type="submit" class="btn btn-success" name="bayar">
                                                <i class="fa fa-shopping-cart"></i> Bayar
                                            </button>

                                            </td>
                                            <td colspan="5" align="right">
                                                <a href="struk.php" target="_blank">
                                                    <button type="button" class="btn btn-default"> 
                                                        <i class="fa fa-print"></i> Print Untuk Bukti Pembayaran
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                    </form>

                                    <?php
                                    // Inisialisasi variabel
                                    $jumlahdibayarkan = 0;
                                    $totalbayar = $totalharga;

                                    // Periksa apakah formulir telah disubmit
                                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                        $jumlahdibayarkan = $_POST['inputbayar'];
                                        $totalbayar = $totalharga; // Ganti dengan nilai total bayar yang sesuai

                                        // Hitung kembalian
                                        $kembalian = $jumlahdibayarkan - $totalbayar;

                                        // Buat query untuk menyimpan total harga ke dalam tabel 'pesanan'
                                        $query_insert_totalharga = "INSERT INTO pesanan (totalharga) VALUES ('$totalharga')";

                                        // Jika input bayar lebih dari total subtotal
                                        if ($jumlahdibayarkan >= $totalbayar) {
                                            // Tampilkan kembalian sebagai kembalian
                                            echo '<script>
                                                document.getElementById("kembalianinput").value = "Rp. ' . number_format($kembalian, 0, ',', ',') . '";
                                            </script>';
                                            

                                        // Jika input bayar kurang dari total subtotal
                                        } else if ($jumlahdibayarkan < $totalbayar) { 
                                            // Hitung jumlah kekurangan
                                            $kekurangan = $totalbayar - $jumlahdibayarkan;
                                            // Set nilai kembalian menjadi negatif, menunjukkan kekurangan pembayaran
                                            $kembalian = -$kekurangan;
                                            // Tampilkan kembalian sebagai kekurangan
                                            echo '<script>
                                                document.getElementById("kembalianinput").value = "Rp. ' . number_format($kembalian, 0, ',', '.') . '";
                                            </script>';
                                            
                                        }
                                    }
                                    ?> 

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <?php
            // Periksa apakah formulir telah disubmit
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['bayar'])) {
                // Tangkap nilai inputan
                $inputbayar = $_POST['inputbayar'];

                // Hitung kembalian
                $kembalian = $inputbayar - $totalharga;

                // Jika input bayar lebih dari atau sama dengan total harga
                if ($inputbayar >= $totalharga) {
                    // Query untuk mengambil data keranjang dengan join ke tabel produk
                    $query = "SELECT k.idproduk, k.jumlahproduk, p.namaproduk, p.hargaproduk, p.stokproduk FROM keranjang k 
                              INNER JOIN produk p ON k.idproduk = p.idproduk 
                              WHERE k.idpesanan = '$idp'";
                    $result = mysqli_query($koneksi, $query);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $idproduk = $row['idproduk'];
                            $namaproduk = $row['namaproduk'];
                            $jumlahproduk = $row['jumlahproduk'];
                            $hargaproduk = $row['hargaproduk'];
                            $subtotal = $jumlahproduk * $hargaproduk;

                            // Kurangi stok barang di tabel produk
                            $stok_terbaru = $row['stokproduk'] - $jumlahproduk;
                            $update_stok = mysqli_query($koneksi, "UPDATE produk SET stokproduk = '$stok_terbaru' WHERE idproduk = '$idproduk'");
                            if (!$update_stok) {
                                // Jika gagal mengupdate stok, tangani kesalahan di sini
                                echo '<script>alert("Gagal mengupdate stok barang.");</script>';
                                exit; // Keluar dari skrip jika gagal mengupdate stok
                            }

                            // Simpan detail pesanan ke dalam tabel 'detailpesanan' untuk setiap item
                            $simpan_detail = mysqli_query($koneksi, "INSERT INTO detailpesanan (idpesanan, idproduk, namaproduk, jumlahproduk, subtotal) VALUES ('$idp', '$idproduk', '$namaproduk', '$jumlahproduk', '$subtotal')");
                            if (!$simpan_detail) {
                                // Jika gagal menyimpan, tangani kesalahan di sini
                                echo '<script>alert("Gagal menyimpan pesanan.");</script>';
                                exit; // Keluar dari skrip jika gagal menyimpan
                            }
                        }
                    }

                    // Kosongkan keranjang belanja setelah pesanan berhasil disimpan
                    $hapus_keranjang = mysqli_query($koneksi, "DELETE FROM keranjang WHERE idpesanan = '$idp'");
                    if (!$hapus_keranjang) {
                        // Jika gagal menghapus, tangani kesalahan di sini
                        echo '<script>alert("Gagal menghapus keranjang belanja.");</script>';
                        exit; // Keluar dari skrip jika gagal menghapus
                    }
                    exit; // Pastikan keluar dari skrip setelah redirect
                } else {
                    // Jika input bayar kurang dari total harga, tampilkan pesan kesalahan
                    echo '<script>alert("Jumlah pembayaran tidak mencukupi.");</script>';
                }
            }
            ?>
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

    <script>
    // Fungsi untuk membuka jendela cetak saat tombol 'Bayar' ditekan
    function printStruk() {
        // Buka halaman 'struk.php' dalam jendela cetak baru
        window.open('struk.php', '_blank');
    }
    </script>

</body>
<!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Barang</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <form method="post">
            <div class="modal-body">
                <!-- Pilihan Barang -->
                <select name="idproduk" class="form-control">
                    <?php
                    // Mengambil data barang
                    $ambilproduk = mysqli_query($koneksi, "SELECT * FROM produk WHERE idproduk NOT IN (SELECT idproduk FROM keranjang WHERE idpesanan='$idp')");

                    // Memeriksa apakah ada data barang yang tersedia
                    if(mysqli_num_rows($ambilproduk) > 0) {
                        // Iterasi melalui hasil query dan menambahkan opsi barang
                        while($pl = mysqli_fetch_array($ambilproduk)) {
                            $namaproduk = $pl['namaproduk'];
                            $hargaproduk = $pl['hargaproduk'];
                            $stokproduk = $pl['stokproduk'];
                            $idproduk = $pl['idproduk'];
                            ?>
                            <!-- Tambahkan opsi barang ke dalam elemen select -->
                            <option value="<?=$idproduk;?>"><?=$namaproduk;?> - Rp. <?=number_format($hargaproduk);?> (Stok : <?=$stokproduk;?>)</option>
                            <?php
                        }
                    } else {
                        // Jika tidak ada data barang yang tersedia
                        echo "<option value='' disabled>Tidak ada barang yang tersedia</option>";
                    }
                ?>
                </select>

                <!-- Input Jumlah Barang -->
                <input type="number" name="jumlahproduk" class="form-control mt-3" placeholder="Jumlah" min="1" required>
                <!-- Input hidden untuk ID Pesanan -->
                <input type="hidden" name="idp" value="<?=$idp;?>">
            </div>
            <div class="modal-footer">
                <!-- Tombol Simpan -->
                <button type="submit" class="btn btn-success" name="addproduk">Simpan</button>
                <!-- Tombol Batal -->
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
            </div>
        </form>

      </div>
    </div>
  </div>
</html>