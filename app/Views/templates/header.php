<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= base_url('assets/images/logo-polisi.png'); ?>" type="image/png">
    <title><?= isset($title) ? $title : 'Absensi Polsek Sukarame'; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }

        /* Sidebar styling */
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            left: 0;
            background: linear-gradient(to bottom, #f0f0f0, #d9d9d9);
            overflow-x: hidden;
            transition: width 0.3s ease;
            z-index: 500;
            padding-top: 100px;
        }

        .sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 18px;
            color: #333;
            display: block;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background-color: #ddd;
            color: #000;
        }

        .sidebar-logo {
            text-align: center;
            padding-top: 20px;
        }

        .sidebar-logo img {
            margin-top: 20px;
            width: 200px;
            opacity: 0.8;
        }

        .sidebar-logo img:hover {
            opacity: 1;
        }

        /* Main content styling */
        .main-content {
            margin-left: 150px;
            padding: 20px;
            transition: margin-left 0.3s ease;
        }

        .sidebar-hidden {
            width: 0;
        }

        .container {
            flex: 1;
        }

        /* Header styling */
        header {
            background-color: gold;
            color: black;
            padding: 15px;
            text-align: center;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 2px -2px gray;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-btn {
            font-size: 24px;
            cursor: pointer;
            color: #333;
        }

        footer {
            background-color: gold;
            color: black;
            padding: 15px;
            text-align: center;
            width: 100%;
            position: relative;
            bottom: 0;
            box-shadow: 0 -4px 2px -2px gray;
            margin-top: auto;
        }

        /* Transisi smooth untuk hamburger */
        .header-btn {
            transition: margin-left 0.3s ease;
        }

        .card-container {
            margin-left: 20px;
            /* Tambahkan jarak kiri agar tidak menempel */
        }

        #calendar {
            max-width: 100%;
            max-height: 400px;
            /* Atur tinggi maksimal sesuai kebutuhan */
            overflow-y: auto;
            /* Jika konten melebihi batas, tampilkan scroll */
        }

        /* Mengurangi margin dan padding untuk kalender */
        #calendar {
            margin-top: 5px;
            /* Sesuaikan margin atas */
            padding-bottom: 0;
            /* Hilangkan padding bawah */
        }

        #calendar .fc-toolbar {
            margin-bottom: 5px;
            /* Kurangi margin bawah toolbar kalender */
        }

        #calendar .fc-daygrid {
            margin-bottom: 0;
            /* Hilangkan margin bawah grid kalender */
        }


        /* Mengatur ukuran teks dalam kalender */
        #calendar .fc-toolbar-title {
            font-size: 1.2rem;
            /* Atur ukuran teks judul bulan */
        }

        #calendar th,
        #calendar td {
            font-size: 0.9rem;
            /* Atur ukuran teks untuk nama hari dan tanggal */
        }

        #calendar .fc-button {
            font-size: 0.8rem;
            /* Atur ukuran tombol navigasi pada kalender */
            padding: 5px 10px;
            /* Sesuaikan padding tombol agar lebih kecil */
        }


        .card-body #calendar {
            padding: 20px;
            font-size: 1.2rem;
        }

        .card {
            max-width: 400px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .card h3 {
            font-size: 2.5rem;
            margin: 0;
        }

        .card-header {
            font-size: 1.25rem;
            font-weight: bold;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .card-body {
            padding: 20px;
            font-size: 2rem;
        }

        #calendar {
            margin-top: 20px;
        }

        /* Tambahkan spacing pada tombol */
        .table-actions {
            display: flex;
            gap: 10px;
            /* Menambahkan jarak antar tombol */
        }

        /* Membatasi lebar kolom agar rapi */
        table th,
        table td {
            text-align: center;
            /* Agar konten di tengah */
            vertical-align: middle;
            /* Agar konten sejajar di tengah */
        }

        /* Optional: Mengatur ukuran tombol agar seragam */
        button.btn {
            min-width: 75px;
            /* Lebar minimal tombol */
        }
    </style>
</head>

<body>

    <!-- Header -->
    <header>
        <div class="header-btn" onclick="toggleSidebar()">&#9776;</div>
        <h1>Absensi Polsek Sukarame</h1>
    </header>

    <!-- Sidebar -->
    <div id="mySidebar" class="sidebar">

        <?php if (session()->get('role') === 'admin') : ?>
            <a href="/admin-dashboard">Dashboard</a>
            <a href="/users">Manajemen Akun</a>
            <a href="/rekap-absensi">Lihat Rekap Absensi</a>
        <?php endif; ?>

        <?php if (session()->get('role') === 'user') : ?>
            <a href="/user-dashboard">Dashboard</a>
            <a href="/absen/create">Absen</a>
            <a href="/profil">Profil</a>
            <a href="/rekap-absensi/user-rekap">Riwayat Absensi</a>
        <?php endif; ?>
        <a href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">Logout</a>

        <div class="sidebar-logo">
            <img src="<?= base_url('assets/images/logo-polisi.png'); ?>" alt="Logo Polisi" width="100">
        </div>
    </div>

    <!-- Modal Konfirmasi Logout -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
    </div

        <!-- Main content -->
    <div id="mainContent" class="main-content">