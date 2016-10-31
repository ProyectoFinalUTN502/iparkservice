<?php
require_once "config/db.php";
require_once "selectors/clientSelector.php";

define("USER", "root");
define("PASSWORD", "proyecto2016cesarputo");

define("SERVER_IP", "192.168.1.135");
define("BASE_IP", "192.168.1.");

define("PUTTY", "F:\Stefan\Descargas\putty.exe");
define("SERVER_FILE", "comandos_servidor.bin");
define("CLIENT_FILE", "comandos_clientes.bin");


$fm         = 20;
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
    
    $result = array();
    $result["error"] = "true";
    $result["data"] = "";
    echo json_encode($result);
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
    
    $result = array();
    $result["error"] = "true";
    $result["data"] = "";
    echo json_encode($result);
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
$serverFile = fopen(SERVER_FILE, "w") or die("Unable to open file!");
$txt = "./scriptServidor.sh " . $macAddress . " " . $clientID;
fwrite($serverFile, $txt);
fclose($serverFile);

$clientFile = fopen(CLIENT_FILE, "w") or die("Unable to open file!");
$txt = "./scriptProyecto.sh " . $fm . " " . $macAddress . " " . $clientID;
fwrite($clientFile, $txt);
fclose($clientFile);

// Ejecuto el comando del Putty
send2Server(PUTTY, USER, SERVER_IP, PASSWORD, SERVER_FILE);
sleep(1);
for ($i = 135; $i < 139; $i++) {
    send2Client(PUTTY, USER, BASE_IP . $i, PASSWORD, CLIENT_FILE);
    sleep(1);
}

$result = array();
$result["error"] = "false";
$result["data"] = "";
echo json_encode($result);


//echo " Se ha iniciado el proceso de monitoreo para el cliente " . $clientID . " sobre la Mac " . $macAddress;


function send2Server($putty, $serverUser, $serverIp, $serverPassword, $serverFile) {
    $command = "start " . $putty . " " . $serverUser . "@" . $serverIp . " -pw " . $serverPassword . " -m " . $serverFile;
    pclose(popen($command, "w"));
}

function send2Client($putty, $clientUser, $clientIp, $clientPassword, $clientFile) {
    $command = "start " . $putty . " " . $clientUser . "@" . $clientIp . " -pw " . $clientPassword . " -m " . $clientFile;
    pclose(popen($command, "w"));
}
