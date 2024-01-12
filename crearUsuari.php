<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear un nou usuari</title>
</head>
<body>
    <main>
        <h1>Registrar un nou usuari:</h1>
        <form method="post">
            <label for="new-user-name">Username:</label>
            <input type="text" name="new-user-name" id="new-user-name" required />

            <label for="new-user-pass">Password:</label>
            <input type="password" name="new-user-pass" id="new-user-pass" required />

            <input type="submit" />
        </form>

        <?php
        if (isset($_POST["new-user-name"])) {
            try {
                $hostname = "localhost";
                $dbname = "mylogin";
                $username = "root";
                $pw = "p@raMor3";
                $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", "$username", "$pw");
            } catch (PDOException $e) { echo "Failed to get DB handle: ". $e->getMessage(); exit; }
            
            $query = $pdo -> prepare("INSERT INTO users (nom, contrasenya) VALUES (:nom, SHA2(:contrasenya, 512));");

            $user = $_POST["new-user-name"];
            $pass = $_POST["new-user-pass"];

            // Anti-sql injection check: no comentarios ni punto y comas en user o pass.
            if (str_contains($user, ";") or str_contains($user, "--") or str_contains($user, "/*") or str_contains($user, "*/") or str_contains($pass, ";") or str_contains($pass, "--") or str_contains($pass, "/*") or str_contains($pass, "*/")) {
                echo "<span style='color:red;'>Has puesto valores no válidos</span>";
            } else {
                $query -> bindParam(':nom', $user);
                $query -> bindParam(':contrasenya', $pass);

                $query -> execute();
                
                echo "Nou usuari \"" . $_POST["new-user-name"] . "\" creat exitosament!";
            }
        } 
        ?>
    </main>

    <style>
        h1 {margin: 0;}

        main {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            gap: 30px;
        }

        html, body { margin: 0; }
        
        form {
            display: flex;
            flex-direction: column;
        }

        form > *:nth-child(odd):not(:first-child) {
            margin-top: 25px;
        }
    </style>
</body>
</html> 