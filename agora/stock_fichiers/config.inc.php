<?php
// CONNEXION À LA BDD
define("db_host", "mysql51-108.perso");
define("db_login", "crehambdd");
define("db_password", "jrVtQzxEzY2x");
define("db_name", "crehambdd");

// EN MAINTENANCE ?  CONTROLE L'ADRESSE IP ?
define("agora_maintenance", false);
define("controle_ip", true);

// ESPACE DISQUE / NB USERS / SALT (A L'INSTALL!)
define("limite_espace_disque", "5368709120");
define("limite_nb_users", "10000");

// DUREE DE CONNEXION AU LIVECOUNTER + MESSENGER
define("duree_livecounter", "45");
define("duree_messages_messenger", 7200);
define("AGORA_SALT", "66484");
?>
