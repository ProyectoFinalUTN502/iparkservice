<?php
define("USER", "root");
define("PASSWORD", "proyecto2016");

define("SERVER_IP", "192.168.1.135");
define("BASE_IP", "192.168.1.");

define("PUTTY", "F:\Stefan\Descargas\putty.exe");
define("SERVER_FILE", "comandos_servidor.bin");
define("CLIENT_FILE", "comandos_clientes.bin");


$type = INPUT_GET;
$fm = filter_input($type, "fm");
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
// Borro los archivos anteriores, si existian
if (file_exists(SERVER_FILE)) {
    unlink(SERVER_FILE);
}
if (file_exists(CLIENT_FILE)) {
    unlink(CLIENT_FILE);
}

// Creo los archivos .sh
$serverFile = fopen(SERVER_FILE, "w") or die("Unable to open file!");
$txt = "killall ncat && ./scriptServidor.sh " . $macAddress . " 2 > /dev/null";
fwrite($serverFile, $txt);
fclose($serverFile);

$clientFile = fopen(CLIENT_FILE, "w") or die("Unable to open file!");
$txt = "./scriptProyecto.sh " . $fm . " " . $macAddress;
fwrite($clientFile, $txt);
fclose($clientFile);

// Ejecuto el comando del Putty
send2Server(PUTTY, USER, SERVER_IP, PASSWORD, SERVER_FILE);

for ($i = 135; $i < 139; $i++) {
    send2Client(PUTTY, USER, BASE_IP . $i, PASSWORD, CLIENT_FILE);
}

//$command = "start F:\Stefan\Descargas\putty.exe root@192.168.1.135 -pw proyecto2016 -m " . SERVER_FILE;
//$resultado = pclose(popen($command, "w"));



function send2Server($putty, $serverUser, $serverIp, $serverPassword, $serverFile) {
    $command = "start " . $putty . " " . $serverUser . "@" . $serverIp . " -pw " . $serverPassword . " -m " . $serverFile;
    pclose(popen($command, "w"));
}

function send2Client($putty, $clientUser, $clientIp, $clientPassword, $clientFile) {
    $command = "start " . $putty . " " . $clientUser . "@" . $clientIp . " -pw " . $clientPassword . " -m " . $clientFile;
    pclose(popen($command, "w"));
}
