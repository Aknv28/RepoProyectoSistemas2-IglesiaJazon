<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Agregar Categoria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/estilos.css">
    <link rel="stylesheet" href="../../css/index.css">
    
</head>

<body>
    <?php include '../../includes/header.php'; ?>
    <div class="container mt-5">
        <h2 class="text-center">Agregar Nueva Categoria</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre de la Categoria</label>
                <input type="text" name="nombre" id="nombre" class="form-control" required>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Agregar Categoria</button>
                <a href="javascript:history.back()" class="btn btn-secondary">Volver</a>
            </div>
        </form>
    </div>
    <?php include '../../includes/footer.php'; ?>
</body>

</html>