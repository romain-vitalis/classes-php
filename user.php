<?php
session_start();
//Attributs de la classe Utilisateurs
class User
{
    //stockage des attributs
    private $bdd;
    private $id;
    public $login;
    public $email;
    public $firstname;
    public $lastname;


// Constructeur
public function __construct($login,$password,$email,$firstname,$lastname){
// this -> accéder aux informations directement aux objets
    $this->bdd= mysqli_connect("localhost","root","","classes");
    $this->login = $login;
    $this->password = $password;
    $this->email = $email;
    $this->firstname = $firstname;
    $this->lastname = $lastname;
}

public function register() { 
 $insert = mysqli_query($this->bdd,"INSERT INTO `utilisateurs` (`login`, `email`, `password`, `firstname`, `lastname`) VALUES ('$this->login', '$this->email', '$this->password', '$this->firstname', '$this->lastname')");
 $request  = mysqli_query($this->bdd,"SELECT*FROM utilisateurs WHERE login = '$this->login'");
 $result = $request->fetch_array(MYSQLI_ASSOC);
}

$users= new User("test","test","test","test","test");
$users->register();
/*fonction pour connecter l'utilisateur */
public function connect($_login, $_password){
$_connexion= mysqli_connect('localhost','root','', 'classes');
$sql = "INSERT INTO utilisateurs (login,password) VALUES ('$_login', '$_password')";
$verifdoublon =mysqli_query($_connexion, $sql);
return $verifdoublon;
    }
    
public function disconnect(){
session_destroy();
}

public function delete() {
    $this->login = $_SESSION['login'];
    $delete = mysqli_query($this->bdd, "DELETE FROM `utilisateurs` WHERE `login` = '$this->login'");
    session_destroy();
}
public function update($login,$email,$password,$firstname,$lastname){
 $request= mysqli_query($bdd,"UPDATE utilisateurs SET login='$login', email='$email', password='$password',firstname=$firstname,lastname=$lastname WHERE  id =  $this->id");
}

public function isConnected()
if(isset($_SESSION['login'])){
    return true;
}else {
    return false;
}
public function getAllInfos(){
    $bdd= mysqli_connect("localhost","root","","classes");
    $req= mysqli_query($bdd,"SELECT * FROM utilisateurs");  
    $res= mysqli_fetch_all($req);
    foreach($res as $key => $value){ 
        echo '<tr>';
        foreach ($value as $key1 => $value1) 
        {
        echo "<td>$value1</td>";  
        }
        echo '</tr>'; 
        }
        return $value1;
}

public function getLogin(){
    if($_SESSION['login'] !== ""){
        $user = $_SESSION['login'];
        // afficher un message
        echo "Bonjour $user, vous êtes connecté"; 
        return $user;
    } 
}
function getEmail(){
    if($_SESSION['email'] !== ""){
        $user = $_SESSION['email'];
        return $user;
    }
 }

 public function getFirstname(){
    if($_SESSION['firstname'] !== ""){
        $user = $_SESSION['firstname'];
        return $user;
    }
}
public function getLastname(){
    if($_SESSION['lastname'] !== ""){
        $user = $_SESSION['lastname'];
        return $user;
    }
}
}
?>
