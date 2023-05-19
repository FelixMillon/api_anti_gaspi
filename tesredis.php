<?php
// Créer une nouvelle instance de Redis
$redis = new Redis();

// Se connecter à Redis (par défaut, Redis s'exécute sur localhost avec le port 6379)
$redis->connect('127.0.0.1', 6379);

// Maintenant, vous pouvez utiliser $redis pour interagir avec Redis
// Par exemple, pour créer une clé appelée "ma_cle" avec la valeur "ma_valeur" qui expire dans 900 secondes :
$mavar= $redis->get('age');
print($mavar);

// Fermer la connexion à Redis
$redis->close();
?>
