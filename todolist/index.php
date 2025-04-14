<?php
require 'function.php';
require 'ceklogin.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>To Do List</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <style>
            .text-danger { color: red !important; font-weight: bold; }
            .text-success { color: green !important; font-weight: bold; }
            </style>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">Dashboard</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Menu</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link" href="tuntas.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Tuntas
                            </a>
                            <a class="nav-link" href="belum_tuntas.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Belum Tuntas
                            </a>
                            <a class="nav-link" href="logout.php">
                                Logout
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Melamp
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4 text-center">To Do List</h1>
                        

                        <!-- Button to Open the Modal -->
                        <button type="button" class="btn btn-info mb-4" data-bs-toggle="modal" data-bs-target="#myModal">
                              Tambah Task
                             </button>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Isi Kegiatan
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Task</th>
                                            <th>Prioritas</th>
                                            <th>Tanggal</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $get = mysqli_query($c,"SELECT * FROM tasks");
                                        $i = 1;

                                        while($p=mysqli_fetch_array($get)){
                                            $namatask = $p['task'];
                                            $prioritas = $p['prioritas'];
                                            $tanggal = $p['tanggal'];
                                            $status = $p['status'];
                                            $id = $p['id'];
                                        ?>


                                        <tr>
                                            <td><?=$i++?></td>
                                            <td><?=$namatask?></td>
                                            <td><?=$prioritas?></td>
                                            <td><?=$tanggal?></td>
                                            <td class="<?= (strcasecmp(trim($status), 'belum') == 0) ? 'text-danger' : 'text-success'; ?>">
                                                <?=$status?>
                                            </td>




                                            <td>
    <?php if ($status != 'selesai') { ?>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#selesai<?=$id;?>">
            Selesai
        </button>
        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?=$id;?>">
            Edit
        </button>
    <?php } ?>
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?=$id;?>">
        Delete
    </button>
</td>

                                        </tr>

                                         <!-- modal edit -->
                                         <div class="modal fade" id="edit<?=$id;?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Ubah Task</h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                                <form method="post">

                                               <!-- Modal body -->
      <div class="modal-body">
    <div class="mb-2">
        <label for="task" class="form-label">Nama Task</label>
        <input type="text" id="task" name="task" class="form-control" placeholder="Masukkan Nama Task">
    </div>

    <div class="mb-2">
        <label for="prioritas" class="form-label">Prioritas</label>
        <select id="prioritas" name="prioritas" class="form-control">
            <option value="">Pilih Prioritas</option>
            <option value="penting">Penting</option>
            <option value="tidak penting">Tidak Penting</option>
        </select>
    </div>

    <div class="mb-2">
        <label for="tanggal" class="form-label">Tanggal</label>
        <input type="date" id="tanggal" name="tanggal" class="form-control">
    </div>
    <div class="mb-2">
    <input type="hidden" name="id" value="<?=$id;?>">
    </div>
</div>

                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success" name="edittask">Submit</button>
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                </div>

                                            </form>

                                                </div>
                                            </div>
                                            </div>


                                             <!-- modal edit -->
                                        <div class="modal fade" id="selesai<?=$id;?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Konfirmasi Penyelesaian</h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                                <form method="post">

                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                    Apakah Anda Yakin Ingin Menandai Tugas Ini Selesai
                                                    <input type="hidden" name="id" value="<?=$id;?>">
                                                </div>

                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success" name="selesai">Submit</button>
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                </div>

                                            </form>

                                                </div>
                                            </div>
                                            </div>


                                            <!-- modal delete -->
                                            <div class="modal fade" id="delete<?=$id;?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Hapus Task</h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                                <form method="post">

                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menghapus task ini?
                                                    <input type="hidden" name="id" value="<?=$id;?>">
                                                </div>

                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success" name="hapustask">Submit</button>
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                </div>

                                            </form>

                                                </div>
                                            </div>
                                            </div>

                                        <?php } ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; UKK Melamp 2025</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        <script>
    document.addEventListener("DOMContentLoaded", function () {
        const table = document.getElementById("datatablesSimple");
        
        // Pastikan DataTables telah diinisialisasi
        if (table) {
            const dataTable = new simpleDatatables.DataTable(table);

            // Menetapkan ulang warna status setiap kali tabel dirender ulang
            dataTable.on("datatable.update", function () {
                updateStatusColors();
            });

            // Jalankan fungsi awal untuk mengatur warna
            updateStatusColors();
        }

        function updateStatusColors() {
            document.querySelectorAll("#datatablesSimple tbody tr td:nth-child(5)").forEach(td => {
                if (td.innerText.trim().toLowerCase() === "belum") {
                    td.classList.add("text-danger");
                    td.classList.remove("text-success");
                } else {
                    td.classList.add("text-success");
                    td.classList.remove("text-danger");
                }
            });
        }
    });
</script>
    </body>
 <!-- The Modal -->
 <div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Tambah Task</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <form method="post">

      <!-- Modal body -->
      <div class="modal-body">
    <div class="mb-2">
        <label for="task" class="form-label">Nama Task</label>
        <input type="text" id="task" name="task" class="form-control" placeholder="Masukkan Nama Task">
    </div>

    <div class="mb-2">
        <label for="prioritas" class="form-label">Prioritas</label>
        <select id="prioritas" name="prioritas" class="form-control">
            <option value="">Pilih Prioritas</option>
            <option value="penting">Penting</option>
            <option value="tidak penting">Tidak Penting</option>
        </select>
    </div>

    <div class="mb-2">
        <label for="tanggal" class="form-label">Tanggal</label>
        <input type="date" id="tanggal" name="tanggal" class="form-control">
    </div>
</div>


      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-success" name="tambahtask">Submit</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

</form>

    </div>
  </div>
</div>



</html>
