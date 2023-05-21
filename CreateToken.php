<?php
require_once ("controleur/controleur.class.php");

if (isset($_REQUEST['email']))
{
    Controleur::connexion($host, $bdd, $user, $mdp);
    print( Controleur::generateToken ($_REQUEST['email']));
}else{
    print("error no email found");
}

?>
