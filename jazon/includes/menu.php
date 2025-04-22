<link rel="stylesheet" href="../css/menu.css">

<!-- Sidebar -->
<div class="sidebar">
    <button class="sidebar-toggle" onclick="toggleSidebar()">☰</button>
    <h2 class="text-center text-white">Menú</h2>
    <ul class="nav flex-column">
        <li class="nav-item1"><a href="../index.php" class="nav-link">Inicio</a></li>
        <li class="nav-item1"><a href="index2.php" class="nav-link">Dashboard</a></li>
        <li class="nav-item1"><a href="eventos.php" class="nav-link">Eventos</a></li>
        <li class="nav-item1"><a href="../reportes.php" class="nav-link">Reportes</a></li>
    </ul>
</div>


<!-- Scripts de Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="../js/conIndex.js"></script>

<script>
    // Función para alternar el sidebar
    function toggleSidebar() {
        document.querySelector('.sidebar').classList.toggle('hidden');
        document.querySelector('.main-content').classList.toggle('shift');
    }
</script>