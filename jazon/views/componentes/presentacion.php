<!-- Enlace a los estilos del panel de gestión -->
<link rel="stylesheet" href="../css/panel_gestion.css">

<div class="main-layout-container">
    <?php include '../includes/menu.php'; ?>
    <main id="main-content" class="main-content-area">
        <div>
            <h2 class="section-title-custom">Panel de Gestión</h2>
            <div class="dashboard-actions-grid">
                <!-- Asociados -->
                <div class="dashboard-action-pair">
                    <a href="agregar/agr_asociado.php" class="action-button-base action-button-add">
                        <div class="action-button-icon-container">👤</div>
                        <div>
                            <h3 class="action-button-title">Agregar Asociado</h3>
                            <p class="action-button-description">Agrega un nuevo asociado al sistema.</p>
                        </div>
                    </a>
                    <a href="listas/lst_asociados.php" class="action-button-base action-button-view">
                        <div class="action-button-icon-container">👥</div>
                        <div>
                            <h3 class="action-button-title">Ver Asociados</h3>
                            <p class="action-button-description">Administra la lista de asociados.</p>
                        </div>
                    </a>
                </div>
                <!-- Categorías -->
                <div class="dashboard-action-pair">
                    <a href="agregar/agr_categoria.php" class="action-button-base action-button-add">
                        <div class="action-button-icon-container">📚</div>
                        <div>
                            <h3 class="action-button-title">Agregar Categoría</h3>
                            <p class="action-button-description">Agrega una nueva categoría al sistema.</p>
                        </div>
                    </a>
                    <a href="listas/lst_categorias.php" class="action-button-base action-button-view">
                        <div class="action-button-icon-container">📖</div>
                        <div>
                            <h3 class="action-button-title">Ver Categorías</h3>
                            <p class="action-button-description">Administra la lista de categorías.</p>
                        </div>
                    </a>
                </div>
                <!-- Zonas -->
                <div class="dashboard-action-pair">
                    <a href="agregar/agr_zona.php" class="action-button-base action-button-add">
                        <div class="action-button-icon-container">📍</div>
                        <div>
                            <h3 class="action-button-title">Agregar Zona</h3>
                            <p class="action-button-description">Agrega una nueva zona al sistema.</p>
                        </div>
                    </a>
                    <a href="listas/lst_zonas.php" class="action-button-base action-button-view">
                        <div class="action-button-icon-container">🗺️</div>
                        <div>
                            <h3 class="action-button-title">Ver Zonas</h3>
                            <p class="action-button-description">Administra la lista de zonas.</p>
                        </div>
                    </a>
                </div>
                <!-- Formularios -->
                <div class="dashboard-action-pair">
                    <a href="agregar/agr_formulario.php" class="action-button-base action-button-add">
                        <div class="action-button-icon-container">📝</div>
                        <div>
                            <h3 class="action-button-title">Agregar Formulario</h3>
                            <p class="action-button-description">Agrega un formulario al sistema.</p>
                        </div>
                    </a>
                    <a href="listas/lst_formularios.php" class="action-button-base action-button-view">
                        <div class="action-button-icon-container">📋</div>
                        <div>
                            <h3 class="action-button-title">Ver Formularios</h3>
                            <p class="action-button-description">Revisa y administra los formularios existentes.</p>
                        </div>
                    </a>
                </div>
                <!-- Horarios -->
                <div class="dashboard-action-pair">
                    <a href="agregar/agr_horario.php" class="action-button-base action-button-add">
                        <div class="action-button-icon-container">⏰</div>
                        <div>
                            <h3 class="action-button-title">Agregar Horario</h3>
                            <p class="action-button-description">Agrega un horario nuevo al sistema.</p>
                        </div>
                    </a>
                    <a href="listas/lst_horarios.php" class="action-button-base action-button-view">
                        <div class="action-button-icon-container">🗓️</div>
                        <div>
                            <h3 class="action-button-title">Ver Horario</h3>
                            <p class="action-button-description">Revisa y administra los horarios existentes.</p>
                        </div>
                    </a>
                </div>
                <!-- Ubicaciones -->
                <div class="dashboard-action-pair">
                    <a href="agregar/agr_ubicacion.php" class="action-button-base action-button-add">
                        <div class="action-button-icon-container">🏠</div>
                        <div>
                            <h3 class="action-button-title">Agregar Ubicación</h3>
                            <p class="action-button-description">Agrega una nueva ubicación al sistema.</p>
                        </div>
                    </a>
                    <a href="listas/lst_ubicaciones.php" class="action-button-base action-button-view">
                        <div class="action-button-icon-container">🗺️</div>
                        <div>
                            <h3 class="action-button-title">Ver Ubicación</h3>
                            <p class="action-button-description">Revisa y administra las ubicaciones existentes.</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </main>
</div>
