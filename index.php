<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrasenyes encriptades</title>
</head>
<body>
    <form method="post">
        <h1>My Login</h1>
        <label>
            User
            <input type="text" name="user" id="user">
        </label>
        <label>
            Contrasenya
            <input type="password" name="pass" id="pass">
        </label>
        <input type="submit" value="Entrar">
    </form>

    <?php 
    if (isset($_POST["user"])) {
        try {
            $hostname = "localhost";
            $dbname = "mylogin";
            $username = "root";
            $pw = "p@raMor3";
            $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", "$username", "$pw");
        } catch (PDOException $e) {
            echo "Failed to get DB handle: ". $e->getMessage();
            exit;
        }

        $query = $pdo -> prepare("SELECT * FROM users WHERE nom = '". $_POST["user"] ."' AND '". $_POST["pass"] ."' = contrasenya;");
        $query -> execute();

        $row = $query -> fetch();
        if ($row) {
            echo "<span>Benvingut, ". $row["nom"] ."!</span>";
        }

        var_dump($row);

        // pol -> '12345'
        // erik -> '123454321'
        // pol'; SELECT * FROM Users WHERE nom = 'nom' or 1=1; --

        // Para hacer contraseñas en mysql: SHA2('contraseña', 512)
    }
    ?>

    <style>
        span {
            background-color: yellow;
        }

        * {
            font-family: 'Monaspace Neon';
        }

        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    </style>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviar mails.</title>
</head>
<body>
    <main style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
        <h1>Enviar mail</h1>
        <?php
        if (isset($_POST["texto"])) {
            mail(
                $_POST["email"],        // Destinatario.
                $_POST["asunto"],       // Asunto.
                $_POST["texto"]         // Contenido del mensaje.
            );
            echo "<span>Mail enviado.   Revisa tu bandeja!</span>";
        } else {
            echo '
            <form style="display: flex; flex-direction: column; justify-content: center; align-items: center; width: 70vw;" method="post">
                <label>Destinatario:<input type="email" name="email" id="email"></label>
                <label>Asunto:<input type="text" name="asunto" id="asunto"></label>
                <label>Texto: <textarea name="texto" id="texto" cols="30" rows="10"></textarea></label>
                <input type="submit" value="Enviar correo" style="width: fit-content;">
            </form>';
        }
        ?>
    </main>
</body>
</html>