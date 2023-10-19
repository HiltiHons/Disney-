<?php
require("connection.php");

if (isset($_POST["submit"])) {
  var_dump($_POST);

  $username = $_POST["username"];
  $email = $_POST["email"];
  $password = PASSWORD_HASH($_POST["password"], PASSWORD_DEFAULT);

  $stmt = $con->prepare("SELECT * FROM users WHERE username=:username OR email=:email");
  $stmt->bindParam(":username", $username);
  $stmt->bindParam(":email", $email);
  $stmt->execute();

  $userAlreadyExists = $stmt->fetchColumn();

  if (!$userAlreadyExists) {
    //Registrieren
    registerUser($username, $email, $password);
  } else {
    //User existiert bereits
  }
}

function registerUser($username, $email, $password)
{
  global $con;
  $stmt = $con->prepare("INSERT INTO users(username, email, password) VALUES(:username, :email, :password)");
  $stmt->bindParam(":username", $username);
  $stmt->bindParam(":email", $email);
  $stmt->bindParam(":password", $password);
  $stmt->execute();
  header("Location: index.html");
}

?>

<html lang="de-at">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Disney + | Streame neue Originals, Blockbuster und Serien</title>
  <link rel="stylesheet" href="styles/style.css" />
  <script>
    function myfunction() {
      document.getElementById("myDropdown").classList.toggle("show");
    }
  </script>
</head>

<body style="background-color: #1a1d29">
  <header>
    <nav>
      <div class="signUpHeader">
        <a href="index.html">
          <img src="images/index/logo.png" style="width: 80px; position: relative; left: 34px" />
        </a>
        <a href="login.php"><button class="buttonLogin pointer">Einloggen</button></a>
      </div>
    </nav>
  </header>
  <main>
    <div class="signUpContainer">
      <p style="
            color: #cacaca;
            font-size: 10px;
            font-weight: 600;
            line-height: 15px;
          ">
        SCHRITT 1 VON 5
      </p>
      <br />
      <h3>E-Mail-Adresse eingeben</h3>
      <br />
      <p style="font-size: 15px; font-weight: 500; line-height: 24px">
        Mit dieser Kombination aus E-Mail-Adresse und Passwort kannst du dich
        in dein Disney+ Konto einloggen und deine Lieblingsserien und -filme
        streamen.
      </p>
      <br />
      <form action="sign-up.php" method="POST">
        <input type="text" placeholder="Benutzername" name="username" autocomplete="on" style="
              font-size: 15px;
              margin: left 10px;
              width: 374px;
              height: 54px;
              border: none;
            " /><br /><br />
        <input type="email" placeholder="E-Mail-Adresse" name="email" autocomplete="on" style="
              font-size: 15px;
              margin: left 10px;
              width: 374px;
              height: 54px;
              border: none;
            " /><br /><br />
        <input type="password" placeholder="Passwort" name="password" autocomplete="on" style="
              font-size: 15px;
              margin: left 10px;
              width: 374px;
              height: 54px;
              border: none;
            " />

        <br />
        <input type="checkbox" style="width: 20px; border-radius: 3px; border: 2px solid tomato" />
        <label style="
              font-size: 12px;
              color: white;
              position: relative;
              bottom: 15px;
              left: 10px;
            ">
          Ja! Ich möchte gerne per E-Mail Sonderangebote und Aktualisierungen
          über Disney+ und Informationen zu anderen Produkten und Diensten der
          <a style="
                color: #67bdff;
                font-weight: 500;
                text-decoration: underline;
              " href="https://privacy.thewaltdisneycompany.com/en/definitions/#The-Walt-Disney-Family-of-Companies">
            Walt Disney-<br />Unternehmensfamilie erhalten.
          </a>
        </label>
        <div class="safety">
          Disney verwendet deine Daten, um dein Erlebnis im Rahmen von Disney+
          zu personalisieren und zu verbessern und um dir Informationen über
          Disney+ zuzusenden. Du kannst deine Kommunikationseinstellungen
          jederzeit ändern. Wir können deine Daten wie in unserer
          Datenschutzerklärung beschrieben verwenden, einschließlich um sie an
          die Walt Disney-Unternehmensfamilie weiterzugeben. Indem du auf
          „Weiter“ klickst, bestätigst du, dass du unsere
          Datenschutzerklärung, Cookie-Richtlinie und UK &
          EU-Datenschutzhinweise gelesen hast.

          <button name="submit" class="buttonRegister pointer">
            WEITER
          </button>
        </div>
      </form>
    </div>
  </main>
  <footer>
    <div class="allRights">asdf</div>
  </footer>
</body>

</html>