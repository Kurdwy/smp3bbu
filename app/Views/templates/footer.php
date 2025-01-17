</div>

<!-- Footer -->
<footer>
    <p>Team Kerja Praktik Ilmu Komputer @Universitas Lampung</p>
</footer>

<!-- jQuery, DataTables, Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Tambahkan script untuk inisialisasi kalender -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css" rel="stylesheet" />


<script>
    $(document).ready(function() {
        $('#usersTable').DataTable({
            "paging": true,
            "searching": true,
            "info": true
        });

        
    });

    function toggleSidebar() {
        var sidebar = document.getElementById("mySidebar");
        var mainContent = document.getElementById("mainContent");
        var headerBtn = document.querySelector(".header-btn");

        if (sidebar.classList.contains("sidebar-hidden")) {
            // Tampilkan sidebar
            sidebar.classList.remove("sidebar-hidden");
            sidebar.style.width = "250px"; // Lebar sidebar
            mainContent.style.marginLeft = "150px"; // Tambahkan margin ke main content
        } else {
            // Sembunyikan sidebar
            sidebar.classList.add("sidebar-hidden");
            sidebar.style.width = "0"; // Hilangkan sidebar
            mainContent.style.marginLeft = "0"; // Kembalikan margin main content
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'id' // Setting bahasa kalender ke Indonesia
        });
        calendar.render();
    });
</script>

</body>

</html>