<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>formulario</title>
</head>
<body>
    <form action="formpost.php" method="post" enctype="multipart/form-data">
        Nombre: <input type="text" name="nombre"><br>
        Email: <input type="email" name="email"><br>
        Educación:
    <select name="educacion">
        <option value="sin-estudios">Sin estudios</option>
        <option value="educacion-obligatoria" selected="selected">Educación Obligatoria</option>
        <option value="formacion-profesional">Formación profesional</option>
        <option value="universidad">Universidad</option>
    </select> <br>
    <p>Subir avatar</p>
        <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_size; ?>" />
        <input type="file" name="imagen" /><br>
        <br><input type="submit" value="Enviar" name = "submit">
    </form>
       
</body>
</html>