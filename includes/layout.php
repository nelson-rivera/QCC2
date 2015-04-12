<?php
include_once 'file_const.php';
include_once 'connection.php';
include_once 'sql.php';
function lytTopBarMenu(){
    return '<ul class="nav navbar-nav navbar-right user-nav">
              <li class="dropdown profile_menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">'. $_SESSION['nombre'] .'<b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="my-company.php">Mi Empresa</a></li>
                  <li><a href="my-profile.php">Mi Perfil</a></li>
                  <li class="divider"></li>
                  <li><a href="ajax/logout.php">Cerrar sesión</a></li>
                </ul>
              </li>
            </ul>';
}

function lytSideMenu($menuSelected){
    $isActiveM1='';$isActiveM2='';$isActiveM3='';$isActiveM4='';$isActiveM5='';$isActiveM6='';$isActiveM7='';$isActiveM8='';$isActiveM9='';
    switch($menuSelected){
        case 1:
            $isActiveM1='active';
            break;
        case 2:
            $isActiveM2='active';
            break;
        case 3:
            $isActiveM3='active';
            break;
        case 4:
            $isActiveM4='active';
            break;
        case 5:
            $isActiveM5='active';
            break;
        case 6:
            $isActiveM6='active';
            break;
        case 7:
            $isActiveM7='active';
            break;
        case 8:
            $isActiveM8='active';
            break;
        case 9:
            $isActiveM9='active';
            break;
    }
    
    $menu = '<div class="side-logo-container"><img src="images/logo.png" /><p>QCC slogan</p></div><ul class="cl-vnavigation"> '; 
    
    //<proveedores>
    if( Helper::helpMenuIsAllowed(5) or Helper::helpMenuIsAllowed(6) ){
        $menu .= '<li><a href="#"><i class="fa fa-list-alt"></i><span>Proveedores</span></a>
                      <ul class="sub-menu">';
    }
    
    if( Helper::helpMenuIsAllowed(5) ){
        $menu .= '<li class="'.$isActiveM5.'"><a href="list-suppliers.php">Listado de Proveedores</a></li>';
    }
    
    if( Helper::helpMenuIsAllowed(6) ){
        $menu .= '<li class="'.$isActiveM6.'"><a href="add-supplier.php">Agregar proveedor</a></li>';
    }
    
    if(Helper::helpMenuIsAllowed(5) or Helper::helpMenuIsAllowed(6) ){
        $menu .= '</ul>
                    </li>';
    }
     //</vendedores>
    
    //<vendedores>
    if( Helper::helpMenuIsAllowed(3) or Helper::helpMenuIsAllowed(4) ){            
        $menu .= '<li><a href="#"><i class="fa fa-lightbulb-o"></i><span>Vendedores</span></a>
                      <ul class="sub-menu">';
    }
    
    if( Helper::helpMenuIsAllowed(3) ){
        $menu .= '<li class="'.$isActiveM3.'"><a href="list-users.php">Listado de vendedores</a></li>';
    }
    
    if( Helper::helpMenuIsAllowed(4) ){
        $menu .= '<li class="'.$isActiveM4.'"><a href="add-user.php">Agregar vendedor</a></li>';
    }
    
    if( Helper::helpMenuIsAllowed(3) or Helper::helpMenuIsAllowed(4) ){
        $menu .= '</ul>
                    </li>';
    }
    //</vendedores>
    
    //<clientes>
    if( Helper::helpMenuIsAllowed(1) or Helper::helpMenuIsAllowed(2) ){
        $menu .= '<li>
                <a href="#"><i class="fa fa-users"></i><span>Clientes</span></a>
                <ul class="sub-menu">';
    }
    if( Helper::helpMenuIsAllowed(1) ){
        $menu .= '<li class="'.$isActiveM1.'"><a href="list-clients.php">Listado de clientes</a></li>
                    <li class="'.$isActiveM1.'"><a href="view-client-gallery.php">Listado de imagenes</a></li>';
    }
    if( Helper::helpMenuIsAllowed(2) ){
        $menu .= '<li class="'.$isActiveM2.'"><a href="add-client.php">Agregar cliente</a></li>';
    }
    
    if( Helper::helpMenuIsAllowed(1) or Helper::helpMenuIsAllowed(2) ){
         $menu .='</ul>
                 </li>';    
     }
   //</clientes>
    
    
    
    
    
     //<cotizaciones>
    //if( Helper::helpMenuIsAllowed(2) ){
        $menu .= '<li><a href="#"><i class="fa fa-table"></i><span>Cotizaciones</span></a>
                      <ul class="sub-menu">';
    //}
    
    //if( Helper::helpMenuIsAllowed(2) ){
        $menu .= '<li class="'.$isActiveM7.'"><a href="list-quotes.php">Listado de cotizaciones</a></li>';
    //}
    
    //if( Helper::helpMenuIsAllowed(2) ){
        $menu .= '<li class="'.$isActiveM8.'"><a href="add-quote.php">Crear Cotización</a></li>';
    //}
    
    //if( Helper::helpMenuIsAllowed(2) ){
        $menu .= '</ul>
                    </li>';                         
    //}
    //</cotizaciones>

    //<reportes>
    if( Helper::helpMenuIsAllowed(9) ){
        $menu .= '<li class="'.$isActiveM9.'">
                      <a href="charts.php"><i class="fa fa-signal nav-icon"></i><span>Reportes</span></a>
                    </li>';
    }
    //<reportes>
    
    //<mantenimientos>
    //if( Helper::helpMenuIsAllowed(2) ){
        $menu .= '<li><a href="#"><i class="fa fa-cogs fa-fw"></i><span>Mantenimientos</span></a>
                      <ul class="sub-menu">';
    //}
    
    //if( Helper::helpMenuIsAllowed(2) ){
        $menu .= '<li ><a href="list-suppliers-types.php">Tipo de proveedores</a></li>';
        $menu .= '<li ><a href="list-suppliers-category.php">Rubro de proveedores</a></li>';
        $menu .= '<li ><a href="list-suppliers-subcategory.php">Sub rubro de proveedores</a></li>';
        $menu .= '<li ><a href="list-position-contact.php">Cargo de contacto de proveedores</a></li>';
        $menu .= '<li ><a href="list-clients-category.php">Rubro de clientes</a></li>';
        $menu .= '<li ><a href="list-position-client.php">Cargos de clientes</a></li>';
    //}
    
  
    //if( Helper::helpMenuIsAllowed(2) ){
        $menu .= '</ul>
                    </li>';                         
    //}
    //</mantenimientos>
    
    
    $menu .= '</ul>';
    //</todo>
    
    return $menu;
}
function selectFaseCotizacion($id,$name,$class,$required,$onchange,$idSelected){
    $connection= openConnection();
    $select= '<select id="'.$id.'" name="'.$name.'" class="'.$class.'" '.$required.' onchange="'.$onchange.'">';
                                                                    
    $query=$connection->prepare(sql_select_estados_cotizacion());
    $query->execute();
    $selected='';
    foreach ($query->fetchAll() as $estado){
        if($idSelected==$estado['idestado_cotizacion'])
            $selected='selected="true"';
        $select.='<option '.$selected.' value="'.$estado['idestado_cotizacion'].'">'.utf8_encode($estado['estado']).'</option>';
        $selected='';
    }
    $select.='</select>';
    return $select;
}
function selectDepartamento($id,$name,$class,$required,$onchange,$idSelected){
    $connection= openConnection();
    $select= '<select id="'.$id.'" name="'.$name.'" class="'.$class.'" '.$required.' onchange="'.$onchange.'"><option value="">Selecciones un departamento</option>';
                                                                    
    $queryDepartamentos=$connection->prepare(sql_get_departamentos());
    $queryDepartamentos->execute();
    $selected='';
    foreach ($queryDepartamentos->fetchAll() as $departamento){
        if($idSelected==$departamento['iddepartamento'])
            $selected='selected="true"';
        $select.='<option '.$selected.' value="'.$departamento['iddepartamento'].'">'.utf8_encode($departamento['departamento']).'</option>';
        $selected='';
    }
    $select.='</select>';
    return $select;
}
function selectMunicipio($idDepartamento,$id,$name,$class,$required,$onchange,$idSelected){
    $connection= openConnection();
    $select= '<select id="'.$id.'" name="'.$name.'" class="'.$class.'" '.$required.' onchange="'.$onchange.'"><option value="">Selecciones un municipio</option>';
                                                                    
    $queryMunicipios=$connection->prepare(sql_get_municipios_by_iddepartamento());
    $queryMunicipios->execute(array($idDepartamento));
    $selected='';
    foreach ($queryMunicipios->fetchAll() as $municipio){
        if($idSelected==$municipio['idmunicipio'])
            $selected='selected="true"';
        $select.='<option '.$selected.' value="'.$municipio['idmunicipio'].'">'.utf8_encode($municipio['municipio']).'</option>';
        $selected='';
    }
    $select.='</select>';
    return $select;
}
function selectContactos($idCliente,$id,$name,$class,$required,$onchange,$idSelected){
    $connection= openConnection();
    $select= '<select id="'.$id.'" name="'.$name.'" class="'.$class.'" '.$required.' onchange="'.$onchange.'">';
                                                                    
    $query=$connection->prepare(sql_select_contactos_by_idcliente());
    $query->execute(array($idCliente));
    $selected='';
    foreach ($query->fetchAll() as $contacto){
        if($idSelected==$contacto['idcontacto'])
            $selected='selected="true"';
        $select.='<option '.$selected.' value="'.$contacto['idcontacto'].'">'.utf8_encode($contacto['nombre_contacto']).'</option>';
        $selected='';
    }
    $select.='</select>';
    return $select;
}
function selectVendedor($id,$name,$class,$required,$onchange,$idSelected, $allOptionFlag){
    $connection= openConnection();
    $select= '<select id="'.$id.'" name="'.$name.'" class="'.$class.'" '.$required.' onchange="'.$onchange.'">';
                                                                 
    if($allOptionFlag){
        $select.='<option value="0">Todos los vendedores</option>'; 
    }
    $queryUsuarios=$connection->prepare(sql_select_usuarios_all());
    $queryUsuarios->execute();
    $selected='';
    foreach ($queryUsuarios->fetchAll() as $usuario){
        if($idSelected==$usuario['idusuario'])
                $selected='selected="true"';
        $select.='<option '.$selected.' value="'.$usuario['idusuario'].'">'.utf8_encode($usuario['nombre'].' '.$usuario['apellido']).'</option>';
        $selected='';
    }
    $select.='</select>';
    return $select;
}
function selectClientes($id,$name,$class,$required,$onchange,$idSelected){
    $connection= openConnection();
    $select= '<select id="'.$id.'" name="'.$name.'" class="'.$class.'" '.$required.' onchange="'.$onchange.'"><option value="">Selecciones un cliente</option>';
                                                                    
    $queryClientes=$connection->prepare(sql_select_clientes());
    $queryClientes->execute();
    $selected='';
    foreach ($queryClientes->fetchAll() as $cliente){
        if($idSelected==$cliente['idcliente'])
                $selected='selected="true"';
        $select.='<option '.$selected.' value="'.$cliente['idcliente'].'">'.utf8_encode($cliente['nombre_cliente']).'</option>';
        $selected='';
    }
    $select.='</select>';
    return $select;
}
function selectRubro($id,$name,$class,$required,$onchange,$idSelected){
    $connection= openConnection();
    $select= '<select id="'.$id.'" name="'.$name.'" class="'.$class.'" '.$required.' onchange="'.$onchange.'">';
                                                                    
    $queryRubros=$connection->prepare(sql_select_rubros_clientes());
    $queryRubros->execute();
    $selected='';
    foreach ($queryRubros->fetchAll() as $rubro){
        if($idSelected==$rubro['idrubro'])
                $selected='selected="true"';
        $select.='<option '.$selected.' value="'.$rubro['idrubro'].'">'.utf8_encode($rubro['rubro']).'</option>';
        $selected='';
    }
    $select.='</select>';
    return $select;
}
function selectValidez($id,$name,$class,$required,$onchange,$idSelected){
    $connection= openConnection();
    $select= '<select id="'.$id.'" name="'.$name.'" class="'.$class.'" '.$required.' onchange="'.$onchange.'">';
                                                                    
    $query=$connection->prepare(sql_select_validez());
    $query->execute();
    $selected='';
    foreach ($query->fetchAll() as $row){
        if($idSelected==$row['idvalidez_cotizacion'])
                $selected='selected="true"';
        $select.='<option '.$selected.' value="'.$row['idvalidez_cotizacion'].'">'.utf8_encode($row['validez']).'</option>';
        $selected='';
    }
    $select.='</select>';
    return $select;
}
function selectFormasPago($id,$name,$class,$required,$onchange,$idSelected){
    $connection= openConnection();
    $select= '<select id="'.$id.'" name="'.$name.'" class="'.$class.'" '.$required.' onchange="'.$onchange.'">';
                                                                    
    $query=$connection->prepare(sql_select_formas_pago());
    $query->execute();
    $selected='';
    foreach ($query->fetchAll() as $row){
        if($idSelected==$row['idforma_pago'])
                $selected='selected="true"';
        $select.='<option '.$selected.' value="'.$row['idforma_pago'].'">'.utf8_encode($row['forma_pago']).'</option>';
        $selected='';
    }
    $select.='</select>';
    return $select;
}
function selectGarantias($id,$name,$class,$required,$onchange,$idSelected){
    $connection= openConnection();
    $select= '<select id="'.$id.'" name="'.$name.'" class="'.$class.'" '.$required.' onchange="'.$onchange.'">';
                                                                    
    $query=$connection->prepare(sql_select_garantias());
    $query->execute();
    $selected='';
    foreach ($query->fetchAll() as $row){
        if($idSelected==$row['idgarantia'])
                $selected='selected="true"';
        $select.='<option '.$selected.' value="'.$row['idgarantia'].'">'.utf8_encode($row['garantia']).'</option>';
        $selected='';
    }
    $select.='</select>';
    return $select;
}
function selectIva($id,$name,$class,$required,$onchange,$idSelected){
    $select= '<select id="'.$id.'" name="'.$name.'" class="'.$class.'" '.$required.' onchange="'.$onchange.'">';
    $ivaSelected='';
    $noIvaSelected='';
    if($idSelected==1){
        $ivaSelected='selected="true"';
    }
    else{
        $noIvaSelected='selected="true"';
    }
    $select.='<option '.$ivaSelected.' value="1">Con IVA desglosado</option>';
    $select.='<option '.$noIvaSelected.' value="0">Sin IVA desglosado</option>';

    $select.='</select>';
    return $select;
}
?>
