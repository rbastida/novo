<?php 
require_once __DIR__ . '/vendor/autoload.php';

use App\Config\DB;
use App\Config\Appconf;


$codigo = '23';
$nome   = 'roger';
$idade  = '47';

confirmEmail($codigo, $nome, $idade);

function confirmEmail($codigo, $nome, $idade) {
    
    $sql = "INSERT INTO pessoa(codigo, nome, idade) VALUES(:codigo, :nome, :idade)";
    $stmt = DB::prepare($sql);
    $stmt->bindParam(':codigo',                 $codigo,    PDO::PARAM_INT);
    $stmt->bindParam(':nome',                   $nome,      PDO::PARAM_STR);
    $stmt->bindParam(':idade',                  $idade,     PDO::PARAM_INT);
    $stmt->execute();     

}

