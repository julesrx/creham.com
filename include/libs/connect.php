<?php

// script de gestion de la connexion à la base de données
// retourne la variable globale $dbi

require_once 'DB.php';

$dbi = DB::connect($CFG->dsn);

if (DB::isError($dbi)) {
    echo 'Message Standard : ' . $dbi->getMessage() . "\n";
    exit;
}

$dbi->setFetchMode(DB_FETCHMODE_ASSOC);
?>