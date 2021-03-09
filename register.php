<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Rejestracja</title>
</head>
<body>
    <?php #połączenie z bazą danych
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $database = 'przychodnia';
        $connect = mysqli_connect($host, $user, $password, $database);
    ?>
<!-- 
    <a href="./index.php">Strona startowa</a><br>
    <a href="./login.php">Logowanie</a>
   

    <form action="./register.php" method="POST">
        <label for="login">Podaj login: </label><input type="text" name="login" id="login" required><br>
        <label for="name">Podaj imię: </label><input type="text" name="name" id="name" required><br>
        <label for="surname">Podaj nazwisko: </label><input type="text" name="surname" id="surname" required><br>
        <label for="email">Podaj e-mail: </label><input type="email" name="email" id="email" required><br>
        <label for="password">Podaj hasło: </label><input type="password" name="password" id="password" required><br>
        <input type="submit" value="Zatwierdź">
    </form>
 -->
 <div class="signinSection">
  <div class="info">
    <h2>Zadbaj o swoją przyszłość</h2>
    <i class="icon ion-ios-ionic-outline" aria-hidden="true"></i>
    <p>Zbadaj się już teraz</p>
   <a   href="./index.php"><img  id="hospital" src="hospital.png" alt="hospital"></a>
   
        <a  class="linki" href="./login.php">Logowanie</a><br><a  class="linki" href="./index.php">Strona startowa</a>
    
  </div>
  <form action="./login.php" method="POST" class="signinForm" name="signinform">
    
    <ul class="noBullet">
      <li>
        <label for="username"></label>
        <input type="text" class="inputFields" id="username" name="login" placeholder="Nazwa użytkownika" value="" required/>
      </li>
      <li>
        <label for="name"></label>
        <input type="text" class="inputFields" id="name" name="name" placeholder="Imię" value="" required/>
      </li>
      <li>
        <label for="surname"></label>
        <input  class="inputFields" placeholder="Nazwisko" type="text" name="surname" id="surname"  required/>
      </li>
      <li>
        <label for="email"></label>
        <input  class="inputFields" placeholder="Email" type="email" name="email" id="email" required/>
      </li>
      <li>
        <label for="password"></label>
        <input placeholder="Hasło" class="inputFields" type="password" name="password" id="password" required/>
      </li>
      
      <li id="center-btn">
        <input type="submit" id="but2" name="zarejestruj" alt="Zarejestruj" value="Zarejestruj">
      </li>

    </ul>
  </form>
</div>
    <?php #rejestracja konta
        function repeatableNicks($connect, $login) {
            $checkNick = "SELECT `login` FROM `users`;";
            $nicks = mysqli_query($connect, $checkNick);
            while ($r = mysqli_fetch_assoc($nicks)) {
                #echo '<script>alert("'. $r["login"] .')</script>';
                if ($r["login"] == $login) return true;
                
            }
            #echo "<script>alert(\"$login\")</script>";
            return false;
        }

        function addClient($connect, $login, $name, $surname, $email, $password) {
            $query = "INSERT INTO users(`login`, `name`, `surname`, `email`, `password`) VALUES(\"$login\", \"$name\", \"$surname\", \"$email\", \"$password\");";
            $result = mysqli_query($connect, $query);
            mysqli_close($connect);
            header("Location: ./success.php");
        }

        if (isset($_POST['login']) && isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['email']) && isset($_POST['password'])) {
            
            $login = $_POST['login'];
            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            if (!repeatableNicks($connect, $login)) {
                addClient($connect, $login, $name, $surname, $email, $password);
            }
            echo 'Nie można utworzyć konta! Podany Nick został już użyty.';
        }
    ?>

    <?php #zamykanie połączenia
        mysqli_close($connect);
    ?>
</body>
</html>