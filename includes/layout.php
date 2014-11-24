<?php
function lytTopBarMenu(){
    return '<ul class="nav navbar-nav navbar-right user-nav">
              <li class="dropdown profile_menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img alt="Avatar" src="images/avatar2.jpg" />José Perez<b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="my-company.php">Mi Empresa</a></li>
                  <li><a href="my-profile.php">Mi Perfil</a></li>
                  <li class="divider"></li>
                  <li><a href="login.php">Cerrar sesión</a></li>
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
    
    return '<ul class="cl-vnavigation">
                <li>
                  <a href="#"><i class="fa fa-users"></i><span>Clientes</span></a>
                  <ul class="sub-menu">
                    <li class="'.$isActiveM1.'"><a href="list-clients.php">Listado de clientes</a></li>
                    <li class="'.$isActiveM1.'"><a href="view-client-gallery.php">Listado de imagenes</a></li>
                    <li class="'.$isActiveM2.'"><a href="add-client.php">Agregar cliente</a></li>
                  </ul>
                </li>
                <li><a href="#"><i class="fa fa-smile-o"></i><span>Vendedores</span></a>
                  <ul class="sub-menu">
                    <li class="'.$isActiveM3.'"><a href="list-users.php">Listado de vendedores</a></li>
                    <li class="'.$isActiveM4.'"><a href="add-user.php">Agregar vendedor</a></li>
                  </ul>
                </li>
                <li><a href="#"><i class="fa fa-list-alt"></i><span>Proveedores</span></a>
                  <ul class="sub-menu">
                    <li class="'.$isActiveM5.'"><a href="list-suppliers.php">Listado de Proveedores</a></li>
                    <li class="'.$isActiveM6.'"><a href="add-supplier.php">Agregar proveedor</a></li>
                  </ul>
                </li>
                <li><a href="#"><i class="fa fa-table"></i><span>Cotizaciones</span></a>
                  <ul class="sub-menu">
                    <li class="'.$isActiveM7.'"><a href="list-quotes.php">Listado de cotizaciones</a></li>
                    <li class="'.$isActiveM8.'"><a href="add-quote.php">Crear Cotización</a></li>
                  </ul>
                </li>                         
                <li class="'.$isActiveM9.'">
                  <a href="charts.php"><i class="fa fa-signal nav-icon"></i><span>Reportes</span></a>
                </li>
            </ul>';
}
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
