<?php
/**
 * Nombre           : validacion.php                                        
 * Autor            : Cesar Cappetto                                        
 * Descripcion      : Archivo donde se alojan todas las funciones que realizan
 *                  : validaciones sobre un determinado campo                
 * Fecha            : 07/08/2013                                               
 * Observaciones    :                                                          
 */

/**
 * Valida que el valor del campo sea distinto de un valor determinado
 * @param type $valor <p>El valor de comparacion</p>
 * @param type $campo <p>El campo a validar</p>
 * @return boolean <b>TRUE</b> si la validacion es correcta<br>
 * <b>FALSE</b> caso contrario    
 */
function distintoDe($valor,$campo)
{
    $retorno = false;
    
    if($campo == $valor)
    {
        $retorno = false;
    }
    else
    {
        $retorno = true;
    }
    
    return $retorno;
}
/**
 * Valida que el campo contenga un valor menor o igual al valor maximo pedido
 * @param type $valorMaximo <p>El valor que se establecera como maximo</p>
 * @param type $campo <p>El campo a validar</p>
 * @return boolean <b>TRUE</b> si la validacion es correcta<br>
 * <b>FALSE</b> caso contrario    
 */
function valorMaximo($valorMaximo,$campo)
{
    $retorno = false;
    if($campo > $valorMaximo)
    {
        $retorno = false;
    }
    else
    {
        $retorno = true;
    }
        
    return $retorno;
}
/**
 * Valida que el campo contenga un valor mayor al valor minimo pedido
 * @param type $valorMinimo <p>El valor que se establecera como minimo</p>
 * @param type $campo <p>El campo a validar</p>
 * @return boolean <b>TRUE</b> si la validacion es correcta<br>
 * <b>FALSE</b> caso contrario    
 */
function valorMinimo($valorMinimo,$campo)
{
    $retorno = false;
    if($campo < $valorMinimo)
    {
        $retorno = false;
    }
    else
    {
        $retorno = true;
    }
        
    return $retorno;
}
/**
 * Valida que el campo solo contenga caracteres numericos
 * @param type $campo <p>El campo a validar</p>
 * @return boolean <b>TRUE</b> si la validacion es correcta<br>
 * <b>FALSE</b> caso contrario                  
 */
function esSoloNumeros($campo)
{
    $retorno    = false;
    $er         = "/^[0-9]+$/i";
    
    if (preg_match($er,$campo) == true) 
    {
        $retorno = true;
    } 
    else 
    {
        $retorno = false;
    }
    
    return $retorno;
}
/**
 * Valida que el campo solo contenga letras
 * @param String $palabra
 * @return boolean 
 *      TRUE si la validacion es correcta 
 *      FALSE caso contrario
 */
function esSoloLetras($palabra)
{
    $retorno    = false;
    $er         = "/^[a-z\s]+$/i";
    
    if (preg_match($er,$palabra) == true) 
    {
        $retorno = true;
    } 
    else 
    {
        $retorno = false;
    }
    
    return $retorno;
}
/**
 * Valida que el campo no este vacio
 * @param String $strCampo
 * @return boolean 
 *      TRUE si el campo esta vacio 
 *      FALSE caso contrario 
 */
function esVacio($strCampo)
{
   $retorno = false;
    if(empty($strCampo) == true)
    {
        $retorno = true;
    }
    else
    {
        $retorno = false;
        
    }
    return $retorno;
}
/**
 * Valida que el campo sea un mail correcto
 * @param String $strMail
 * @return boolean 
 *      TRUE si el campo es valido 
 *      FALSE caso contrario 
 */
function validarMail($strMail)
{
    $retorno = false;
    
    if(esVacio($strMail) == true)
    {
        $retorno = false;
    }
    else
    {
        if(filter_var($strMail, FILTER_VALIDATE_EMAIL)== true)
        {
            $retorno = true;
        }else
        {
            $retorno = false;
        } 
    }    
    
    return $retorno;
}
/**
 * Valida que el campo cumpla con una longitud minima establecida
 * @param Int $valorMinimo
 * @param String $strCampo
 * @return boolean 
 *      TRUE si cumple 
 *      FALSE caso contrario 
 */
function longitudMinima($valorMinimo,$strCampo)
{
    $retorno = false;
    if(strlen($strCampo) >= $valorMinimo)
    {
        $retorno = true;
    }
    else
    {
        $retorno = false;
    }
    return $retorno;
}
/**
 * Valida que el campo no supere una longitud maxima establecida
 * @param Int $valorMaximo
 * @param String $strCampo
 * @return boolean 
 *      TRUE si cumple
 *      FALSE caso contrario 
 */
function longitudMaxima($valorMaximo, $strCampo)
{
    $retorno = false;
    if(strlen($strCampo) < $valorMaximo)
    {
        $retorno = true;
    }
    else
    {
        $retorno = false;
    }
    return $retorno;
}
/**
 * Valida si los campos que componen la fecha son validos
 * valida las combinaciones para descartar meses y dias erroneos
 * @param Int $mes
 * @param Int $dia
 * @param Int $ano
 * @return boolean 
 *      TRUE si es fecha valida 
 *      FALSE caso contrario 
 */
function validarFecha($mes,$dia,$ano)
{

    $retorno = false;
    
    if(checkdate($mes, $dia, $ano) == true)
    {
        $retorno = true;
    }
    else
    {
        $retorno = false;
    }
    
    return $retorno;
}
/**
 * Valida que el campo ingresado coincida con el formato DATETIME de MySQL
 * (yyyy-mm-dd hh:mm:ss)
 * @param string $campo <p>La cadena a validar</p>
 * @return boolean <p><b>TRUE</b> si cumple con el formato<br>
 * <b>FALSE</b> caso contrario</p>
 */
function validarFechaHora($campo)
{
   $retorno = false;
    
    $pattern = "/^(((\d{4})(-)(0[13578]|10|12)(-)(0[1-9]|[12][0-9]|3[01]))|((\d{4})(-)(0[469]|1‌​1)(-)([0][1-9]|[12][0-9]|30))|((\d{4})(-)(02)(-)(0[1-9]|1[0-9]|2[0-8]))|(([02468]‌​[048]00)(-)(02)(-)(29))|(([13579][26]00)(-)(02)(-)(29))|(([0-9][0-9][0][48])(-)(0‌​2)(-)(29))|(([0-9][0-9][2468][048])(-)(02)(-)(29))|(([0-9][0-9][13579][26])(-)(02‌​)(-)(29)))(\s([0-1][0-9]|2[0-4]):([0-5][0-9]):([0-5][0-9]))$/";
    if(preg_match($pattern,$campo))
    {
        $retorno = true;
    }
        
    return $retorno; 
}

function validarHora($hora)
{
    $retorno = false;
    
    $pattern = "/^([0-1][0-9]|[2][0-3])[\:]([0-5][0-9])[\:]([0-5][0-9])$/";
    if(preg_match($pattern,$hora))
    {
        $retorno = true;
    }
        
    return $retorno;
}
/**
 * Valida si el campo tiene formato de CUIT valido
 * @param String $cuit
 * @return boolean 
 *      TRUE si el CUIT es valido 
 *      FALSE caso contrario 
 */
function validarCUIT($cuit)
{

    $retorno        = false;
    $digitoCheck    = array();
    $digitoCUIT     = array();
    
    if(strlen($cuit) == 11)
    {
        $codigoCUIT     = "6789456789";

        $digitoCheck    = str_split($codigoCUIT);
        $digitoCUIT     = str_split($cuit);

        $resultado = 0;
        for($i = 0; $i <= 9; $i++) 
        { 
            $resultado += ($digitoCUIT[$i] * $digitoCheck[$i]); 
        } 
       
        $resultado = ($resultado % 11);
         
        if($resultado == $digitoCUIT[10])
        {
            $retorno = true;
        }
    } 
    else
    {
        $retorno = false;
    }    
    
    return $retorno;
    
    
    
}
/**
 * Valida si el campo es un nombre de usuario valido
 * Reglas:
 * 1. No vacio
 * 2. Long. Minima = 3 Caracteres
 * 3. Solo caracteres alfabeticos  
 * @param String $usuario
 * @return boolean 
 *      TRUE si el usuario es valido 
 *      FALSE caso contrario
 */
function validarNombreUsuario($usuario)
{
    $retorno   = false;
    $usuarioOK = true;
    
    if(esvacio($usuario) == true)
    {
        $usuarioOK = false;
    }    
    
    if(longitudMinima((3 - 1), $usuario) == false)
    {
        $usuarioOK = false;
    }
    
    if(esSoloLetras($usuario)== false)
    {
        $usuarioOK = false;
    }    
    
    $retorno = $usuarioOK;
    
    return $retorno;
}
/**
 * Valida si el campo es una Contraseña segura y valida
 *  Reglas:
 * 1. No vacio
 * 2. Long. Minima = 6  Caracteres 
 * @param String $password
 * @return boolean 
 *      TRUE si el campo es una contraseña correcta
 *      FALSE caso contrario  
 */
function validarPasswordUsuario($password)
{
    $retorno    = false;
    $passwordOK = true;
    
    if(esvacio($password) == true)
    {
        $passwordOK = false;
    }    
    
    if(longitudMinima((6 - 1), $password) == false)
    {
        $passwordOK = false;
    }
    
    /*if(longitudMaxima((12 + 1), $password) == false)
    {
        $passwordOK = false;
    } */   
    
    $retorno = $passwordOK;
    
    return $retorno;
}
/**
 * Valida si un Campo coincide con otro Campo<br>
 * Por Ejemplo Contraseña y Confirmar Contraseña
 * @param type $unCampo
 * @param type $otroCampo
 * @return boolean
 * <br>
 * TRUE     Si coinciden
 * FALSE    Si no coinciden
 */
function coinciden($unCampo,$otroCampo)
{
    $retorno = true;
    
    if($unCampo != $otroCampo)
    {
        $retorno = false;
    }
    
    return $retorno;
}

/**
 * Recibe un $_FILE['type'] y un tipo generico de archivo 
 * y los chequea para ver si concuerdan
 * @param file $tipoArchivo <p>El 'type' del archivo que se tiene que subir</p>
 * @param string $tipo <p>El tipo generico del archivo que se espera <br>
 * Ej: "image"</p>
 * @return boolean <p><b>TRUE</b> si es correcto<br>
 * <b>FALSE</b> si hubo errores</p>
 */
function validarTipoDeArchivo($tipoArchivo,$tipo)
{
    $retorno = preg_match('#'. $tipo .'#i', $tipoArchivo);
    
    return $retorno;
    
} 
/**
 * Recibe un $_FILE['tmp_name'] y un array con MIMES validos
 * y los compara para ver si hay coincidencia con alguno
 * @param $_FILE['tmp_name'] $tmpNameArchivo
 *      El nombre temporal que tiene el archivo antes de ser subido
 * @param array $arrayMIMESValidos
 *      Array con los MIMEs que SI estan permitidos
 *      Ej: 'image/jpg'
 * @return boolean 
 *      TRUE si la validacion es correcta
 *      FALSE si hubo errores
 */
function validarMIMEArchivo($tmpNameArchivo,$arrayMIMESValidos)
{
    $retorno = false;
    
    $imageInfo = getimagesize($tmpNameArchivo);
    foreach($arrayMIMESValidos as $MIME)
    {
        if($imageInfo['mime'] == $MIME && isset($imageInfo))
        {
            $retorno = true;
            break;
        }    
    }    
        
    return $retorno;
}
/**
 * Recibe un $_FILE['name'] y dos arrays, uno con la extensiones validas
 * y otro con las extensiones invalidas y chequea si la extension del 
 * archivo a subir es correcta
 * @param $_FILE['name'] $nameArchivo
 *      El nombre del archivo a subir
 * @param array $arrayExtensionesPermitidas
 *      Array con las extensiones permitidas
 *      Ej: 'jpg'
 * @param array $arrayExtensionesProhibidas
 *      Array con las extensiones prohibidas
 *      Ej: 'exe','php'
 * @return boolean 
 *      TRUE si la validacion fue correcta
 *      FALSE caso contrario
 */
function validarExtensionArchivo($nameArchivo,$arrayExtensionesPermitidas,$arrayExtensionesProhibidas)
{
    $retorno = true;
    
    $fileName   = strtolower($nameArchivo);
    $temp       = explode('.', $fileName);

    if(!in_array(end($temp), $arrayExtensionesPermitidas))
    {
        $retorno = false;
    }

    if(in_array(end($temp), $arrayExtensionesProhibidas))
    {
        $retorno = false;
    }
       
    return $retorno;
}
/**
 * Recibe el $_FILE['tmp_name'] y un valor de Heigth y Width 
 * y compara el tamaño del archivo con los valores pasados por parametro
 * En esta instancia, se asume que el archivo a subir es una imagen
 * @param $_FIL['tmp_name'] $tmpNameArchivo
 *      El nombre temporal del archivo, antes de ser subido
 * @param integer $heigth
 *      El heigth con el que se comapra el archivo
 * @param integer $width
 *      El width con el que se comapra el archivo
 * @return boolean 
 *      TRUE si la validacion es correcta
 *      FALSE caso contrario
 */
function validarTamanioArchivo($tmpNameArchivo,$heigth,$width)
{
    /*
     *  $img_info = getimagesize($_FILES['archivo'] ['tmp_name']); //
        $ancho=$img_info[0];
        $alto=$img_info[1];
     */
    $retorno = true;
    
    list($archivoWidth, $archivoHeight, $archivoType, $archivoAttr) = getimagesize($tmpNameArchivo);
   
    if($archivoWidth > $width || $archivoHeight > $heigth)
    {
        $retorno = false;
    }
    
    return $retorno;
}        
?>
