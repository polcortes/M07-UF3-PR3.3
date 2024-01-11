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
        $query = $pdo -> prepare("SELECT nom, contrasenya FROM users WHERE nom = :nom AND contrasenya = SHA2(:contrasenya, 512) ;");

        $user = $_POST["user"];
        $pass = $_POST["pass"];

        // Anti-sql injection check: no comentarios ni punto y comas en user o pass.
        if (str_contains($user, ";") or str_contains($user, "--") or str_contains($user, "/*") or str_contains($user, "*/") or str_contains($pass, ";") or str_contains($pass, "--") or str_contains($pass, "/*") or str_contains($pass, "*/")) {
            echo "<span>Has puesto valores no válidos</span>";
        } else {
            $query->bindParam(':nom', $user);
            $query->bindParam(':contrasenya', $pass);

            $query -> execute();

            $row = $query -> fetch();
            if ($row) {
                echo "<div>Benvingut, ". $row["nom"] ."!</div>";
            }
        }

        // pol -> '12345'
        // erik -> '123454321'
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