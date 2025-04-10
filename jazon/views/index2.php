<?php

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
    <?php include 'componentes/menu.php'; ?>

   
    <header class="p-3">
        <div class="container-fluid">
            <div class="d-flex flex-wrap align-items-center justify-content-between">
                <div class="title-container">
                    <img src="../img/logo/logoFinal2.png" class="logo" alt="Logo de la Iglesia">
                </div>
                <span class="title">Iglesia Jazon</span>
                <div>
                    <a href="../includes/logout.php" class="btn btn-outline-danger">Cerrar sesión</a>
                </div>
            </div>
        </div>
    </header>
    <!-- Main Content -->
    <div class="main-content">

        <!-- SECCIONES CRUD -->
        <h2 class="section-title">Panel de Gestión</h2>
        <!-- SECCIONES CRUD -->
        <main class="content-section">
            <div class="container">
                <div class="row g-4">

                    <!-- Agregar asociado -->
                    <div class="col-md-4" id="asociado">
                        <div class="card">
                            <div class="card-header"><i class="bi bi-person-plus-fill"></i> Agregar Asociado</div>
                            <div class="card-body">
                                <p>Agrega un nuevo asociado al sistema.</p>
                                <a href="agregar/agr_asociado.php" class="btn btn-primary">Agregar Asociado</a>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header"><i class="bi bi-person-lines-fill"></i> Ver Asociados</div>
                            <div class="card-body">
                                <p> Administra la lista de asociados.</p>
                                <a href="listas/lst_asociados.php" class="btn btn-primary">Ver Asociados</a>
                            </div>
                        </div>
                    </div>

                    <!-- Agregar categoria -->
                    <div class="col-md-4" id="categoria">
                        <div class="card">
                            <div class="card-header"><i class="bi bi-person-plus-fill"></i> Agregar Categorias</div>
                            <div class="card-body">
                                <p>Agrega una nueva categoria al sistema.</p>
                                <a href="agregar/agr_categoria.php" class="btn btn-primary">Agregar Categorias</a>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header"><i class="bi bi-person-lines-fill"></i> Ver Categorias</div>
                            <div class="card-body">
                                <p> Administra la lista de categorias.</p>
                                <a href="listas/lst_categorias.php" class="btn btn-primary">Ver Categorias</a>
                            </div>
                        </div>
                    </div>

                    <!-- Agregar zona -->
                    <div class="col-md-4" id="zona">
                        <div class="card">
                            <div class="card-header"><i class="bi bi-person-plus-fill"></i> Agregar Zona</div>
                            <div class="card-body">
                                <p>Agrega una nueva zona al sistema.</p>
                                <a href="agregar/agr_zona.php" class="btn btn-primary">Agregar Zona</a>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header"><i class="bi bi-person-lines-fill"></i> Ver Zonas</div>
                            <div class="card-body">
                                <p> Administra la lista de zonas.</p>
                                <a href="listas/lst_zonas.php" class="btn btn-primary">Ver Zonas</a>
                            </div>
                        </div>
                    </div>

                    <!-- Agregar zona -->
                    <div class="col-md-4" id="zona">
                        <div class="card">
                            <div class="card-header"><i class="bi bi-person-plus-fill"></i> Agregar Formulario</div>
                            <div class="card-body">
                                <p>Agrega un formulario al sistema.</p>
                                <a href="agregar/agr_formulario.php" class="btn btn-primary">Agregar Formulario</a>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header"><i class="bi bi-person-lines-fill"></i> Ver Formularios</div>
                            <div class="card-body">
                                <p> Administra la lista de formularios.</p>
                                <a href="listas/lst_formularios.php" class="btn btn-primary">Ver Formularios</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
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