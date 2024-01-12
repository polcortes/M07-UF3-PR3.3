<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <main>
        <h1>Admin dashboard</h1>
        <?php session_start(); if (isset($_SESSION['user-registered'])) {echo "Benvingut, ". $_SESSION['user-registered'] ."!";} ?>
        <ul>
            <li><a href="crearUsuari.php">Crear un nou usuari</a></li>
            <li><a href="canviarContrasenya.php">Canvia la teva contrasenya</a></li>
            <li><a href="actionLogout.php">Fer log out</a></li>
        </ul>
    </main>

    <style>
        body,
        html {
            margin: 0;
        }

        main {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 10px;
            height: 100vh;
        }

        ul {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        h1 {margin:0;}

        li::marker {
            content: '🫃🏼';
        }
    </style>
</body>
</html>