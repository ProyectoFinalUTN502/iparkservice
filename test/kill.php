<?php
require_once "../config/db.php";
require_once "../selectors/clientSelector.php";

define("USER", "root");
define("PASSWORD", "proyecto2016cesarputo");

define("SERVER_IP", "192.168.1.135");
define("BASE_IP", "192.168.1.13");

define("SERVER_PORT", "60005");
define("BASE_PORT", "6000");

define("PUTTY", "F:\Stefan\Descargas\putty.exe");
define("SERVER_FILE", "comandos_kill_servidor.bin");
define("NCAT_FILE", "comandos_kill_ncat.bin");
define("CLIENT_FILE", "comandos_kill_clientes.bin");


$fm         = 20;//filter_input($type, "fm"); // 20
$type       = INPUT_GET;
$macAddress = filter_input($type, "mac");

$exp = ($fm == NULL) || ($macAddress == NULL);
if ($exp) {
    if (file_exists(SERVER_FILE)) {
        unlink(SERVER_FILE);
    }
    if (file_exists(CLIENT_FILE)) {
        unlink(CLIENT_FILE);
    }
    exit();
}

$clientID = getClientByMacAddress(strtoupper($macAddress));

if ($clientID == "") {
    if (file_exists(SERVER_FILE)) {
        unlink(SERVER_FILE);
    }
    if (file_exists(CLIENT_FILE)) {
        unlink(CLIENT_FILE);
    }
    exit();
}

// Borro los archivos anteriores, si existian
if (file_exists(SERVER_FILE)) {
    unlink(SERVER_FILE);
}
if (file_exists(CLIENT_FILE)) {
    unlink(CLIENT_FILE);
}

// Creo los archivos .sh
$ncatFile = fopen(NCAT_FILE, "w") or die("Unable to open file!");
$txt = "kill -15 $(pgrep -f \"ncat -lkvp 3333" . $clientID . "\")";
fwrite($ncatFile, $txt);
fclose($ncatFile);

$serverFile = fopen(SERVER_FILE, "w") or die("Unable to open file!");
$txt = "kill -15 $(pgrep -f \"scriptServidor.sh " . $macAddress . " " . $clientID . "\")";
fwrite($serverFile, $txt);
fclose($serverFile);

$clientFile = fopen(CLIENT_FILE, "w") or die("Unable to open file!");
$txt = "kill -15 $(pgrep -f \"scriptProyecto.sh " . $fm . " " . $macAddress . " " . $clientID . "\")";
fwrite($clientFile, $txt);
fclose($clientFile);

// Ejecuto el comando del Putty
send2Server(PUTTY, USER, SERVER_IP, SERVER_PORT, PASSWORD, SERVER_FILE);
sleep(1);
send2Server(PUTTY, USER, SERVER_IP, SERVER_PORT, PASSWORD, NCAT_FILE);
sleep(1);
for ($i = 5; $i < 9; $i++) {
    send2Client(PUTTY, USER, BASE_IP . $i, BASE_PORT . $i, PASSWORD, CLIENT_FILE);
    sleep(1);
}


echo " Se ha detenido el proceso de monitoreo para el cliente " . $clientID . " sobre la Mac " . $macAddress;

function send2Server($putty, $serverUser, $serverIp, $serverPort, $serverPassword, $serverFile) {
    $command = "start " . $putty . " " . $serverUser . "@" . $serverIp . " -P " . $serverPort . " -pw " . $serverPassword . " -m " . $serverFile;
    pclose(popen($command, "w"));
}

function send2Client($putty, $clientUser, $clientIp, $clientPort, $clientPassword, $clientFile) {
    $command = "start " . $putty . " " . $clientUser . "@" . $clientIp . " -P " . $clientPort . " -pw " . $clientPassword . " -m " . $clientFile;
    pclose(popen($command, "w"));
}
