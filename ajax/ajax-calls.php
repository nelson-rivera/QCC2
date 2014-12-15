<?php
include_once '../includes/connection.php';
include_once '../includes/sql.php';

if(empty($_POST['opt']) || !is_numeric($_POST['opt'])){
    $response['status']=1;
    $response['msg']= 'A su petición le falta un argumento';
    exit(json_encode($response));
}
$opt=$_POST['opt'];
$connection= openConnection();
switch ($opt) {
    //save client
    case 1:
        try{
            $idDepartamento=$_POST['departamento'];
            $connection=  openConnection();
            $query=$connection->prepare(sql_get_municipio_by_iddepartamento());
            $query->execute(array($idDepartamento));
            $select='<option value="">Selecciones un municipio</option>';
            foreach ($query->fetchAll() as $municipios){
                $select.='<option value="'.$municipios['idmunicipio'].'">'.$municipios['municipio'].'</option>';
            }
            $response['status']=0;
        }
        catch (Exception $error){
           $response['status']=2;
        }
        $response['select']=  utf8_encode($select);  
        break;

    default:
        $response['status']=1;
        $response['msg']= 'A su petición le falta un argumento';
        break;
}
exit(json_encode($response));
