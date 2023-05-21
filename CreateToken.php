<?php
require_once ("controleur/controleur.class.php");

if (isset($_REQUEST['email']))
{
    print( Controleur::generateToken ($_REQUEST['email']));
}else{
    print("error no email found");
}

?>
