<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= isset($title) ? $title : 'UPT SMPN 3 BLAMBANGAN UMPU'; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #f5f5f5;
            overflow-x: hidden;
        }

        .wrapper {
            display: flex;
            flex: 1;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background: #f8f9fa;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            transition: transform 0.3s ease-in-out;
            box-shadow: 2px 0px 5px rgba(0, 0, 0, 0.1);
            padding-top: 20px;
            z-index: 1000;
        }

        .sidebar.hidden {
            transform: translateX(-100%);
        }

        .sidebar a {
            padding: 10px;
            text-decoration: none;
            font-size: 18px;
            display: block;
            color: #333;
        }

        .sidebar a:hover {
            background: #007bff;
            color: #fff;
        }

        .sidebar-logo {
            text-align: center;
            padding: 10px;
        }

        .sidebar-logo img {
            width: 150px;
            border-radius: 50%;
        }

        /* Navbar */
        .navbar {
            width: 100%;
            background-color: gold;
            color: black;
            padding: 15px;
            text-align: center;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1050;
            box-shadow: 0 4px 2px -2px gray;
            transition: left 0.3s ease-in-out;
        }

        .content {
            margin-left: 250px;
            width: calc(100% - 250px);
            padding: 20px;
            min-height: 100vh;
            transition: margin-left 0.3s ease-in-out, width 0.3s ease-in-out;
        }

        .sidebar.hidden+.content {
            margin-left: 0;
            width: 100%;
        }

        /* Footer */
        footer {
            background-color: gold;
            color: black;
            padding: 10px;
            text-align: center;
            width: 100%;
            position: absolute;
            bottom: 0;
            left: 0;
        }
    </style>

</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-logo mt-5">
                <img src="<?= base_url('assets/images/logo.png'); ?>" alt="Logo Sekolah">
            </div>
            <a href="/admin-dashboard">Dashboard</a>
            <a href="/users">Manajemen Guru</a>
            <a href="/facilities">Fasilitas Sekolah</a>
            <a href="/extracurriculars">Ekstrakurikuler</a>
            <a href="#" data-bs-toggle="modal" data-bs-target="#logoutModal" class="text-danger">Logout</a>
        </div>

        <!-- Main Content -->
        <div class="content">
            <div class="navbar d-flex align-items-center justify-content-between">
                <button class="btn btn-outline-dark ms-3" id="toggleSidebar">
                    ☰
                </button>
                <h3 class="text-center flex-grow-1">UPT SMPN 3 BLAMBANGAN UMPU</h3>
            </div>

            <div style="margin-top: 80px;">
                <?= $this->renderSection('content') ?>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>Team Kerja Praktik Ilmu Komputer @Universitas Lampung</p>
    </footer>

    <!-- Modal Logout -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Logout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda ingin logout?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <a href="/logout" class="btn btn-danger">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery, DataTables, Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#usersTable').DataTable();
        });

        // Fungsi untuk toggle sidebar
        document.getElementById("toggleSidebar").addEventListener("click", function() {
            let sidebar = document.getElementById("sidebar");
            let content = document.querySelector(".content");

            sidebar.classList.toggle("hidden");
            if (sidebar.classList.contains("hidden")) {
                content.style.marginLeft = "0";
                content.style.width = "100%";
            } else {
                content.style.marginLeft = "250px";
                content.style.width = "calc(100% - 250px)";
            }
        });
    </script>

</body>

</html>