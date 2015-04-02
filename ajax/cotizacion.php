<?php
include_once '../includes/connection.php';
include_once '../includes/sql.php';

if(empty($_POST['opt']) || !is_numeric($_POST['opt'])){
    $response['status']=1;
    $response['msg']= 'A su petición le falta un argumento';
    $response['error']= '101';
    exit(json_encode($response));
}
$opt=$_POST['opt'];
$connection= openConnection();
switch ($opt) {
    //save cotizacion
    case 1:
        if(!empty($_POST['input-vendedor']) && !empty($_POST['input-cliente']) && !empty($_POST['input-municipio']) && !empty($_POST['input-contacto'])
        && !empty($_POST['input-validez']) && !empty($_POST['input-forma-pago']) && !empty($_POST['input-garantia'])){
            $connection->beginTransaction();
            try{
                $nItems=  count($_POST['input-cantidad']);
                if($nItems<1){
                    $response['status']=1;
                    $response['msg']= 'A su petición le falta un argumento';
                    $response['error']= '101';
                    exit(json_encode($response));
                }
                
                
                
                $idVendedor=$_POST['input-vendedor'];
                $idCliente=$_POST['input-cliente'];
                $idMunicipio=$_POST['input-municipio'];
                $idContacto=$_POST['input-contacto'];
                $idvalidez=$_POST['input-validez'];
                $idFormaPago=$_POST['input-forma-pago'];
                $idgarantia=$_POST['input-garantia'];
                $idEstadoCotizacion=1;
                $ivaFlag=(empty($_POST['input-iva']))?0:1;
                $now=date('Y-m-d H:i:s');
                $queryCodigo=$connection->prepare(sql_select_last_idcotizacion());
                $queryCodigo->execute();
                if($queryCodigo->rowCount()>0){
                    $codigoArray=$queryCodigo->fetch();
                    $codigoCotizacion=str_pad($codigoArray['idcotizacion'], 7, "0", STR_PAD_LEFT);
                }
                else{
                    $codigoCotizacion='0000001';
                }
                
                $cantidadArray=$_POST['input-cantidad'];
                $idRubroArray=$_POST['input-rubro'];
                $descripcionArray=$_POST['input-descripcion'];
                $preciounitarioArray=$_POST['input-precio-unitario'];
                
                $queryInsertCotizacion=$connection->prepare(sql_save_cotizacion());
                $queryInsertCotizacion->execute(array($codigoCotizacion,$idVendedor,$idCliente,$idMunicipio,
                $idContacto,$idEstadoCotizacion,$idvalidez,$idFormaPago,$idgarantia,$ivaFlag,$now));

                $idCotizacion=$connection->lastInsertId();
                
                $queryInsertItem=$connection->prepare(sql_save_item_cotizacion());
                for($i=0;$i<$nItems;$i++){
                    $imageUrlString = null;
                    
                    if(!empty($_FILES["input-image"]["name"][$i])){
                        $uploadDir = "../uploads/$codigoCotizacion/";
                        if(!is_dir($uploadDir)) {
                            mkdir($uploadDir,0566,true);
                        }
                        $imageUrl = $uploadDir. $_FILES["input-image"]["name"][$i];
                        $imageUrlString = "uploads/$codigoCotizacion/".$_FILES["input-image"]["name"][$i];
                        move_uploaded_file($_FILES["input-image"]["tmp_name"][$i], $imageUrl);
                    }
                    $queryInsertItem->execute(array($idCotizacion,$cantidadArray[$i],$idRubroArray[$i],$descripcionArray[$i],$imageUrlString,$preciounitarioArray[$i]));
                }
                
                if(!empty($_POST['input-condicion-custom'])){
                    $nCondiciones=count($_POST['input-condicion-custom']);
                    $condicionArray=$_POST['input-condicion-custom'];
                    $condicionValorArray=$_POST['input-condicion-custom-valor'];
                    
                    $queryInsertCondicion=$connection->prepare(sql_save_condicion_custom());
                    for($j=0;$j<$nCondiciones;$j++){
                        $queryInsertCondicion->execute(array($condicionArray[$j],$condicionValorArray[$j],$idCotizacion));
                    }
                    
                }
                
                $connection->commit();
                $response['status']=0;
                $response['msg']= 'Cotización agregada con exito';
            }
            catch (Exception $error){
                $connection->rollBack();
                $response['status']=1;
                $response['msg']= 'Error 202: Error al ingresar cotización';
                $response['error']= '202';
                $response['dev']= $error->getMessage();
            }
        }
        else{
            $response['status']=1;
            $response['msg']= 'A su petición le falta un argumento';
            $response['error']= '201';
        }

        

        break;
        
        case 2:
        if(!empty($_POST['input-vendedor']) && !empty($_POST['input-cliente']) && !empty($_POST['input-municipio']) && !empty($_POST['input-contacto'])
        && !empty($_POST['input-validez']) && !empty($_POST['input-forma-pago']) && !empty($_POST['input-garantia']) && !empty($_POST['input-cotizacion'])){
            $connection->beginTransaction();
            try{
                $nItems=  count($_POST['input-cantidad']);
                if($nItems<1){
                    $response['status']=1;
                    $response['msg']= 'A su petición le falta un argumento';
                    $response['error']= '101';
                    exit(json_encode($response));
                }
                
                
                $formerIdCotizacion=$_POST['input-cotizacion'];
                $codigoCotizacion=$_POST['input-codigo'];
                $idVendedor=$_POST['input-vendedor'];
                $idCliente=$_POST['input-cliente'];
                $idMunicipio=$_POST['input-municipio'];
                $idContacto=$_POST['input-contacto'];
                $idvalidez=$_POST['input-validez'];
                $idFormaPago=$_POST['input-forma-pago'];
                $idgarantia=$_POST['input-garantia'];
                $idEstadoCotizacion=$_POST['input-estado-cotizacion'];
                $ivaFlag=(empty($_POST['input-iva']))?0:1;
                $now=date('Y-m-d H:i:s');
                
                
                $cantidadArray=$_POST['input-cantidad'];
                $idRubroArray=$_POST['input-rubro'];
                $descripcionArray=$_POST['input-descripcion'];
                $preciounitarioArray=$_POST['input-precio-unitario'];
                
                $queryDeleteCotizacion=$connection->prepare(sql_delete_cotizacion_by_idcotizacion());
                $queryDeleteCotizacion->execute(array($formerIdCotizacion));
                
                $queryInsertCotizacion=$connection->prepare(sql_save_cotizacion());
                $queryInsertCotizacion->execute(array($codigoCotizacion,$idVendedor,$idCliente,$idMunicipio,
                $idContacto,$idEstadoCotizacion,$idvalidez,$idFormaPago,$idgarantia,$ivaFlag,$now));

                $idCotizacion=$connection->lastInsertId();
                
                $queryInsertItem=$connection->prepare(sql_save_item_cotizacion());
                for($i=0;$i<$nItems;$i++){
                    $uploadDir = "../uploads/$codigoCotizacion/";
                    if(!is_dir($uploadDir)) {
                        mkdir($uploadDir,0566,true);
                    }
                    $imageUrl = $uploadDir. $_FILES["input-image"]["name"][$i];
                    $imageUrlString = "uploads/$codigoCotizacion/".$_FILES["input-image"]["name"][$i];
                    move_uploaded_file($_FILES["input-image"]["tmp_name"][$i], $imageUrl);
                    
                    $queryInsertItem->execute(array($idCotizacion,$cantidadArray[$i],$idRubroArray[$i],$descripcionArray[$i],$imageUrlString,$preciounitarioArray[$i]));
                }
                
                if(!empty($_POST['input-condicion-custom'])){
                    $nCondiciones=count($_POST['input-condicion-custom']);
                    $condicionArray=$_POST['input-condicion-custom'];
                    $condicionValorArray=$_POST['input-condicion-custom-valor'];
                    
                    $queryInsertCondicion=$connection->prepare(sql_save_condicion_custom());
                    for($j=0;$j<$nCondiciones;$j++){
                        $queryInsertCondicion->execute(array($condicionArray[$j],$condicionValorArray[$j],$idCotizacion));
                    }
                    
                }
                
                $connection->commit();
                $response['status']=0;
                $response['msg']= 'Cotización editada con éxito';
            }
            catch (Exception $error){
                $connection->rollBack();
                $response['status']=1;
                $response['msg']= 'Error 202: Error al ingresar cotización';
                $response['error']= '202';
                $response['dev']= $error->getMessage();
            }
        }
        else{
            $response['status']=1;
            $response['msg']= 'A su petición le falta un argumento';
            $response['error']= '201';
        }

        

        break;
    case 3:
        $idCotizacion = $_POST['id'];
        $deleteCotizacion = $connection->prepare(sql_update_cotizacion_deleted_by_idcotizacion());
        $deleteCotizacion->execute(array($idCotizacion));
        $response['status']=0;
        $response['msg']= 'Cotización eliminada con éxito';
        break;
    default:
        $response['status']=1;
        $response['msg']= 'A su petición le falta un argumento';
        $response['error']= '106';
        break;
}
exit(json_encode($response));
