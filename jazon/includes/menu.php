<link rel="stylesheet" href="../css/panel_gestion.css">
<button class="menu-toggle-btn" onclick="toggleSidebarMenu()">☰ Menú</button>
<aside class="sidebar-custom flex-shrink-0" id="sidebarMenu">
    <h2 class="sidebar-h2">Menú</h2>
    <nav>
        <ul>
            <li class="mb-3">
                <a href="../index.php" class="sidebar-link">Inicio</a>
            </li>
            <li class="mb-3">
                <a href="index2.php" class="sidebar-link active">Dashboard</a>
            </li>
            <li class="mb-3">
                <a href="eventos.php" class="sidebar-link">Eventos</a>
            </li>
            <li class="mb-3">
                <a href="reportes.php" class="sidebar-link">Reportes</a>
            </li>
        </ul>
    </nav>
</aside>
<script>
function toggleSidebarMenu() {
    var sidebar = document.getElementById('sidebarMenu');
    sidebar.classList.toggle('active');
}
</script>