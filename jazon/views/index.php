<?php
session_start();

if (isset($_SESSION['nombre']) && isset($_SESSION['ape_pat']) && isset($_SESSION['ape_mat']) && isset($_SESSION['tipo_usuario'])) {
    $nombre = $_SESSION['nombre'];
    $apellido = $_SESSION['ape_pat'] . ' ' . $_SESSION['ape_mat'];
    $tipo_usuario = $_SESSION['tipo_usuario'];
} else {
    $nombre = 'Usuario no autenticado';
    $apellido = '';
    $tipo_usuario = 'desconocido';
}
$nombreCompleto = $nombre . ' ' . $apellido;
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/conIndex2.css">
    <link rel="stylesheet" href="../css/menu.css">
    <style>
        
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <button class="sidebar-toggle" onclick="toggleSidebar()">☰</button>
        <h2 class="text-center text-white">Menú</h2>
        <ul class="nav flex-column">
            <li class="nav-item1"><a href="../index.php" class="nav-link">Inicio</a></li>
            <li class="nav-item1"><a href="index2.php" class="nav-link">Dashboard</a></li>
            <?php if ($tipo_usuario == 'supervisores' or $tipo_usuario == 'maestros' or $tipo_usuario == 'encargados'): ?>
                <li class="nav-item1"><a href="#ninos" class="nav-link">Niños</a></li>
                <li class="nav-item1"><a href="#re" class="nav-link">Registros</a></li>
                <li class="nav-item1"><a href="#rep" class="nav-link">Reporte y eventos</a></li>
                <?php if ($tipo_usuario == 'supervisor' or $tipo_usuario == 'encargados'): ?>
                    <li class="nav-item1"><a href="#agr" class="nav-link">Agregar Registros</a></li>
                    <li class="nav-item1"><a href="#ver" class="nav-link">Ver Registros</a></li>
                <?php endif; ?>
            <?php endif; ?>
        </ul>
    </div>
    <header class="p-3">
        <div class="container-fluid">
            <div class="d-flex flex-wrap align-items-center justify-content-between">
                <div class="title-container">
                    <img src="../img/logo/logoFinal2.png" class="logo" alt="Logo de la Iglesia">
                </div>
                <span class="title">Iglesia Jazon</span>
                <div>
                    <p id="usuario"><?php echo $nombreCompleto; ?></p>
                    <a href="../includes/logout.php" class="btn btn-outline-danger">Cerrar sesión</a>
                </div>
            </div>
        </div>
    </header>
    <!-- Main Content -->
    <div class="main-content">


        <!-- Contenido -->
        <?php if ($tipo_usuario == 'desconocido'): ?>
            <center>
                <br>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header"><i class="bi bi-person-lines-fill"></i> INICIE SESION</div>
                        <div class="card-body">
                            <p>INICIE SESION</p>
                            <a href="login.php" class="btn btn-primary">iniciar sesion</a>
                        </div>
                    </div>
                </div>
                <br><br><br>
            </center>
        <?php endif; ?>


        <?php if ($tipo_usuario == 'supervisores' or $tipo_usuario == 'maestros' or $tipo_usuario == 'encargados'): ?>
            <!-- SECCIONES CRUD -->
            <h2 class="section-title">Panel de Gestión</h2>
            <!-- SECCIONES CRUD -->
            <main class="content-section">
                <div class="container">
                    <div class="row g-4">
                        <!-- Notificaciones -->
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header"><i class="bi bi-journal-text"></i> Enviar Notificacion
                                </div>
                                <div class="card-body">
                                    <p>Enviar notificacion al tutor del niño.</p>
                                    <a href="enviar_notificacion.php" class="btn btn-primary">Enviar
                                        Notificacion</a>
                                </div>
                            </div>
                        </div>
                        <!-- Agregar Niños -->
                        <div class="col-md-4" id="ninos">
                            <div class="card">
                                <div class="card-header"><i class="bi bi-person-plus-fill"></i> Agregar Niños</div>
                                <div class="card-body">
                                    <p>Agrega un nuevo niño al sistema.</p>
                                    <a href="agregar_nino.php" class="btn btn-primary">Agregar Niños</a>
                                </div>
                            </div>
                        </div>
                        <!-- Ver Niños -->
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header"><i class="bi bi-person-lines-fill"></i> Ver Niños</div>
                                <div class="card-body">
                                    <p> Administra la lista de niños.</p>
                                    <a href="ver_ninos.php" class="btn btn-primary">Ver Niños</a>
                                </div>
                            </div>
                        </div>
                        <!-- Agregar Enfermedades -->
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header"><i class="bi bi-journal-text"></i> Agregar Enfermedades
                                </div>
                                <div class="card-body">
                                    <p>Registra enfermedades de los niños.</p>
                                    <a href="agregar_enfermedad.php" class="btn btn-primary">Agregar Enfermedad</a>
                                </div>
                            </div>
                        </div>
                        <!-- Ver Enfermedades -->
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header"><i class="bi bi-journal-text"></i> Ver Enfermedades</div>
                                <div class="card-body">
                                    <p>Lista de niños con enfermedades.</p>
                                    <a href="ver_enfermedad.php" class="btn btn-primary">Ver Niños</a>
                                </div>
                            </div>
                        </div>
                        <!-- Control Asistencia -->
                        <div class="col-md-4" id="re">
                            <div class="card">
                                <div class="card-header"><i class="bi bi-calendar-check-fill"></i> Control
                                    Asistencia</div>
                                <div class="card-body">
                                    <p>Registra la asistencia de los niños.</p>
                                    <a href="agregar_asistencia.php" class="btn btn-primary">Registrar
                                        Asistencia</a>
                                </div>
                            </div>
                        </div>
                        <!-- Control Salida -->
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header"><i class="bi bi-door-closed-fill"></i> Control Salida</div>
                                <div class="card-body">
                                    <p>Gestiona la salida de los niños.</p>
                                    <a href="agregar_salida.php" class="btn btn-primary">Registrar Salida</a>
                                </div>
                            </div>
                        </div>
                        <!-- Mostrar Asistencia -->
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header"><i class="bi bi-clock-history"></i> Mostrar Asistencia
                                </div>
                                <div class="card-body">
                                    <p>Consulta el historial de asistencia.</p>
                                    <a href="ver_asistencias.php" class="btn btn-primary">Ver Asistencia</a>
                                </div>
                            </div>
                        </div>
                        <!-- Mostrar Salida -->
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header"><i class="bi bi-journal-text"></i> Mostrar Salida</div>
                                <div class="card-body">
                                    <p>Consulta el historial de salidas.</p>
                                    <a href="ver_salidas.php" class="btn btn-primary">Ver Salidas</a>
                                </div>
                            </div>
                        </div>
                        <!-- crear reportes -->
                        <div class="col-md-4" id="rep">
                            <div class="card">
                                <div class="card-header"><i class="bi bi-journal-text"></i>Crear reportes</div>
                                <div class="card-body">
                                    <p>Reportes sobre actividades, eventos y los niños.</p>
                                    <a href="reportes.php" class="btn btn-primary">Generar reporte</a>
                                </div>
                            </div>
                        </div>
                        <!-- Agregar actividad -->
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header"><i class="bi bi-journal-text"></i> Agregar actividad</div>
                                <div class="card-body">
                                    <p>Agregar una nueva actividad con los niños.</p>
                                    <a href="agregar_actividad.php" class="btn btn-primary">Agregar actividad</a>
                                </div>
                            </div>
                        </div>
                        <!-- Ver actividades -->
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header"><i class="bi bi-journal-text"></i> Ver actividad</div>
                                <div class="card-body">
                                    <p>Ver un listado de las actividades con los niños.</p>
                                    <a href="ver_actividades.php" class="btn btn-primary">Ver actividad</a>
                                </div>
                            </div>
                        </div>
                        <!-- Ver Eventos -->
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header"><i class="bi bi-journal-text"></i> Mostrar Eventos</div>
                                <div class="card-body">
                                    <p>Consulta y administra la lista de Eventos.</p>
                                    <a href="ver_evento.php" class="btn btn-primary">Ver Eventos</a>
                                </div>
                            </div>
                        </div>
                        <!-- Agregar Encargado -->
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header"><i class="bi bi-person-plus-fill"></i> Agregar Encargado
                                </div>
                                <div class="card-body">
                                    <p>Agrega un Encargado para recoger al niño al sistema.</p>
                                    <a href="agregar_encargado.php" class="btn btn-primary">Agregar Encargado</a>
                                </div>
                            </div>
                        </div>
                        <!-- Agregar nino al evento -->
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header"><i class="bi bi-person-plus-fill"></i> Agregar niño a evento
                                </div>
                                <div class="card-body">
                                    <p>Agrega a los niños a los eventos.</p>
                                    <a href="agr_nino_eve.php" class="btn btn-primary">Agregar niño</a>
                                </div>
                            </div>
                        </div>
                        <?php if ($tipo_usuario == 'supervisor' or $tipo_usuario == 'encargados'): ?>

                            <!-- Ver Cursos -->
                            <div class="col-md-4" id="ver">
                                <div class="card">
                                    <div class="card-header"><i class="bi bi-journal-text"></i> Mostrar Cursos</div>
                                    <div class="card-body">
                                        <p>Consulta y administra la lista de cursos.</p>
                                        <a href="ver_cursos.php" class="btn btn-primary">Ver Cursos</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Ver Tutores -->
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header"><i class="bi bi-journal-text"></i> Ver Tutores</div>
                                    <div class="card-body">
                                        <p>Consulta y administra la lista de los Tutores.</p>
                                        <a href="ver_tutores.php" class="btn btn-primary">Ver Tutores</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Ver Encargados -->
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header"><i class="bi bi-journal-text"></i> Ver Encargados</div>
                                    <div class="card-body">
                                        <p>Consulta y administra la lista de Encargados de recoger al niño.</p>
                                        <a href="ver_encargado.php" class="btn btn-primary">Ver Encargados</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Ver Maestros -->
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header"><i class="bi bi-journal-text"></i> Mostrar Maestros</div>
                                    <div class="card-body">
                                        <p>Consulta y administra la lista de maestros.</p>
                                        <a href="ver_maestros.php" class="btn btn-primary">Ver Maestros</a>
                                    </div>
                                </div>
                            </div>
                            <?php if ($tipo_usuario == 'encargados'): ?>

                                <!-- Agregar Cursos -->
                                <div class="col-md-4" id="agr">
                                    <div class="card">
                                        <div class="card-header"><i class="bi bi-journal-text"></i> Agregar Curso</div>
                                        <div class="card-body">
                                            <p>Agregar un nuevo Curso al sistema.</p>
                                            <a href="agregar_curso.php" class="btn btn-primary">Registrar Cursos</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Registrar Maestro -->
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header"><i class="bi bi-journal-text"></i> Agregar Maestro</div>
                                        <div class="card-body">
                                            <p>Agregar un nuevo maestro al sistema.</p>
                                            <a href="agregar_maestro.php" class="btn btn-primary">Registrar Maestro</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Registrar Supervisor -->
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header"><i class="bi bi-journal-text"></i> Agregar Supervisor</div>
                                        <div class="card-body">
                                            <p>Agregar un nuevo Supervisor al sistema.</p>
                                            <a href="agregar_supervisor.php" class="btn btn-primary">Registrar
                                                Supervisor</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Registrar Evento -->
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header"><i class="bi bi-journal-text"></i> Agregar Evento</div>
                                        <div class="card-body">
                                            <p>Agregar un nuevo Evento al sistema.</p>
                                            <a href="agregar_evento.php" class="btn btn-primary">Registrar Evento</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Ver Supervisores -->
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header"><i class="bi bi-journal-text"></i> Mostrar Supervisores
                                        </div>
                                        <div class="card-body">
                                            <p>Consulta y administra la lista de Supervisores.</p>
                                            <a href="ver_supervisores.php" class="btn btn-primary">Ver Supervisores</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                        <?php endif; ?>
                    </div>
                </div>
            </main>
        <?php endif; ?>
    </div>

    <!-- Pie de página -->
    <?php include '../includes/footer.php'; ?>

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

</body>

</html>