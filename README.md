# Base
Pour écrire du php, il fait l'initialiser 
```
<?php MON CODE PHP ?>
```

# Tester des variables
var_dump($variable)

# Fonction
Elles s'écrivent comme en javascript
```
function NOM() {
    MONCODE
}
```

# ECHO
echo est l'équivalent d'un console log
on peut écrire une chaine de character dans echo et y inclure une variable avec les {}
on ne peut pas echo un array directement, il faut lui dire quel colonne on appel
```
<?php echo $variable ?>
<?php echo"fdp" ?>
<?php echo"salut {$variable}" ?>

<?php echo $array[0]> //va afficher la 1ere colonne du tableau nommer "array"
```

# Variable
Comme en JS, contient des valeurs string, integer, float, boolean

# Opérateur Arithmétique
Opérateur classique : + - * / ** %
NDT: ** = Puissance
Incrémente : ++, --

Ordre d'utilisation :
1er : ()
2eme : **
3eme : * / %
4eme : + -


# $_GET, $_POST
Variable spécial utilisé pour collecté des données depuis un formulaire en html et les renvoie dans un fichier action
```
<form action="fichier.php" method="get">
```
GET est relié à l'url, si on fait un formulaire avec la method get, l'url va retourner :
http://localhost/index.php?username=dddd&password=123456
Il est préférable d'utiliser POST

# Opérateur logique
&& = Si les deux condition sont true
|| = True si au moins une des condition est true
! = True si false, et false est true (permet d'inverser des conditions)
Ex : 
```
if(condition1 || condition2)
```

# Switch
Remplace l'utilisation des else if (comme en JS)


# Boucle for
for va répéter du code un certain nombre de fois
Ex :
```
for($i = 0; $i < 5; $i++) { // i est un compteur qui commence a 0 et va s'arreter a 5, on va incrémenter i a chaque fois avec ++ jusqu'a atteindre 5
    echo"salut";
}
```

# Boucle while
Répète du code une infinité de fois tant que la condition est sur true, presque pareil que for
```
    $seconds = 0;
    $running = true;
    while($running) {
        $seconds++;
        echo $seconds ."<br>";
    }
```

# Array (tableau)
Variable qui contient plusieurs valeurs
on peut modifier une valeur du tableau en appelant la variable et son index (ex2)
on peut rajouer une valeur au tableau avec array push (ex3)
on peut supprimer la derniere valeur du tableau avec array pop (ex4) et supprimer la 1ere valeur avec shift (ex5)
```
1. $variable = array("option1", "option2", "option3", "option4");
2. $variable[0] = "opp" //l'option1 devient opp
3. array_push($variable, "option5")
4. array_pop($variable)
5. array_shift($variable)
```

# Array associatif
Un tableau avec comme contenu, une clé et sa valeur
```
$capital = array("Japon"=>"Tokyo",
                 "France"=>"Paris)
```

# foreach
```
$variables = array("option1", "option2", "option3", "option4");

foreach($variables as $variable) { //on doit donner un alias a notre variable
    echo $variable
}
```

# Isset, empty
isset() fonction qui retourne true si une variable est déclaré et non null
empty() fonction qui retourne true si une variable n'est pas déclaré, ou sur false ou null
``` 
$pseudo = "moi";
echo isset($pseudo)
```
on peut les utiliser pour vérifié si des éléments sont bien attribué (comme des formulaire)
```
<form action="index.php" method="post">
<input type="text" name="username">
<input type="password" name="password">
<input type="submit" name="login" value="connexion" />
</form>
<?php
if(isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if(empty($username)) {
        echo "pas de nom dutilisateur";
    } elseif(empty($password)) {
        echo "pas de mdp";
    } else {
        echo "salut {$username}";
    }
}
?>
```

# Sécurité et validation des input
```
<form action="index.php" method="post">
<input type="text" name="username">
<input type="submit" name="login" value="connexion" />
</form>

<?php
if(isset($_POST["login"])) {
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);

    if(empty($username)) {
        echo "pas de nom dutilisateur";
    } else {
        echo "salut {$username}";
    }
}
?>
```
filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS) 
Va filtrer les entrées de l'input pour empecher de par exemple éxécuté du code via l'input
Le 1er paramètre "INPUT_POST", input car c'est un input et post car on utilise $_POST, si c'était get on utiliserai INPUT_GET
le 2eme paramètre "username" est le nom de l'input que l'ont veut filtré

Il existe la meme chose pour les nombres, les emails : 
AGE : filter_input(INPUT_POST, "age", FILTER_SANITIZE_NUMBER_INT);
EMAIL : filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);

## Validation des inputs
Si les input ne passe pas le test de validation ça affichera une chaine de caractère vide
Il existe pour les nombres, et email
```
<?php
if(isset($_POST["login"])) {
    $age = filter_input(INPUT_POST, "age", FILTER_VALIDATE_INT);

    if(empty($age)) {
        echo "ce chiffre n'est pas valide";
    } else {
        echo "tu as {$age} age";
    }
}
?>
```
```
<?php
if(isset($_POST["login"])) {
    $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);

    if(empty($email)) {
        echo "cette adresse n'est pas valide";
    } else {
        echo "voici ton mail : {$email}";
    }
}
?>
```

# Include
include() copie le contenu d'un fichier et l'inclu dans la page (ex pour des navbar, footer ect)


# $_COOKIE
Les informations d'un utilisateur, stocké dans son navigateur, utilisé pour les pub ciblé, les préférences de navigation et des infos non sensible
Les cookies sont stocké dans des array associatif
```
setcookie("bouffe_favorite", "pizza", time() + (86400 * 2), "/");
```
en 1er paramètre on va donner le nom du cookie
en 2eme paramètre son contenu
en 3eme paramètre time() + (MILISECONDE * 2) pour le temps que le cookie sera gardé en mémoire
et en 4eme "/" la ou il sera stocké

# $_SESSION
utilisé pour gardé en mémoire les infos d'un utilisateur pour la navigation sur plusieurs page.
un utilisateur est assigné a une session-id 
Ex :
```
index.php : 

<?php 
    session_start();
?>
// a mettre avant le doctype


//a insérer a la fin du html
<?php 
    $_SESSION["username"] = "moi";
    $_SESSION["password"] = "blabla";

?>
```

```
home.php :

<?php 
    session_start();
?>

DU HTML

<?php 
    $_SESSION["username"] = "moi";
    $_SESSION["password"] = "blabla";
?>
```

Exemple de formulaire de connexion et de page home :
```
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="index.php" method="post">
<input type="text" name="username">
<input type="password" name="password">
<input type="submit" name="login" value="connexion" />
</form>
<?php
if(isset($_POST["login"])) {
    if(!empty($_POST["username"]) &&
       !empty($_POST["password"])) {

        $_SESSION["username"] = $_POST["username"];
        $_SESSION["password"] = $_POST["password"];

        header("Location: home.php");
       }
       else {
        echo"Pas d'username ou de mdp";
       }
}
?>
</body>
</html>
```

on peut kill la session pour se déconnecter :
session_destroy()
on peut rajouter un bouton pour kill la session :
```
<form action="home.php" method="post">
    <input type="submit" name="logout" value="déconnexion">
</form>
<?php 
if(isset($_POST["logout"])) {
    session_destroy();
    header("Location: index.php")
}
?>
```

# Hasging de mot de passe
Transforme les infos sensible en truc random (qihomighdùgdf1459dfgdfg)
```
$password = "mdp123";
$hash = password_hash($password, PASSWORD_DEFAULT)

// test si ça a marché
if(password_verify("mdprandom123", $hash)) {
    echo "tu es hashé";
} 
else {
    echo "mauvais mdp";
}
```
