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
    case 2:
        if(is_numeric($_POST['cliente'])){
            $idCliente=$_POST['cliente'];
            $getClienteInfo=$connection->prepare(sql_get_cliente_departamento_contacto());
            $getClienteInfo->execute(array($idCliente));
            $clientInfoArray=$getClienteInfo->fetch();
            $idDepartamento=$clientInfoArray['iddepartamento'];
            $idMunicipio=$clientInfoArray['idmunicipio'];
            
            //Getting municipios
            $queryMunicipios=$connection->prepare(sql_get_municipios_by_iddepartamento());
            $queryMunicipios->execute(array($idDepartamento));
            $selected='';
            $selectMunicipio='';
            foreach ($queryMunicipios->fetchAll() as $municipio){
                if($idMunicipio==$municipio['idmunicipio'])
                    $selected='selected="true"';
                $selectMunicipio.='<option '.$selected.' value="'.$municipio['idmunicipio'].'">'.utf8_encode($municipio['municipio']).'</option>';
                $selected='';
            }
            
            //Getting contactos
            $getContactos=$connection->prepare(sql_select_contactos());
            $getContactos->execute();
            $selectContacto='<option value="">Seleccione un contacto</option>';
            foreach ($getContactos->fetchAll() as $contacto) {
                $selectContacto.='<option value="'.$contacto['idcontacto'].'">'.$contacto['nombre_contacto'].'</option>';
            }
            $response['status']=0;
            $response['iddepartamento']=$idDepartamento;
            $response['selectContacto']=$selectContacto;
            $response['selectMunicipio']=$selectMunicipio;
            
        }
        else{
            $response['status']=1;
            $response['msg']= 'A su petición le falta un argumento';
        }
        break;
    case 3:
        if(is_numeric($_POST['contacto'])){
            $idContacto=$_POST['contacto'];
            $getContactos=$connection->prepare(sql_select_contacto_by_idcontacto());
            $getContactos->execute(array($idContacto));
            
            $contactoArray=$getContactos->fetch();
            $response['status']=0;
            $response['telefono']=$contactoArray['telefono_1'];
            $response['email']=$contactoArray['email_1'];
        }
        else{
            $response['status']=1;
            $response['msg']= 'A su petición le falta un argumento';
        }
        break;
    default:
        $response['status']=1;
        $response['msg']= 'A su petición le falta un argumento';
        break;
}
exit(json_encode($response));
