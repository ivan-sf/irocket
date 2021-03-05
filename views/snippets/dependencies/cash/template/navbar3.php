<?php 
$modelUser = new models\User();
$array = $modelUser->inner();
$modelBill = new models\Bills();
$arrayBills = $modelBill->array();
  ?>
 <div class="preloader">
    <div class="cssload-speeding-wheel"></div>
</div>
<div id="wrapper">

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="sidebar-search hidden-sm hidden-md hidden-lg">
                        <!-- input-group -->
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                        <button class="btn btn-default" type="button"> <i class="fa fa-search"></i> </button>
                        </span>
                        </div>
                        <!-- /input-group -->
                    </li>

                    <li>
                        <a href="index.html" class="waves-effect"><i class="linea-icon linea-basic fa-fw" data-icon="v"></i> <span class="hide-menu"> Panel <span class="fa arrow"></span> </span></a>
                        <ul class="nav nav-second-level">
                            <li> <a target="" href="<?php echo URL; ?>tercero/crear">Crear tercero</a> </li>
                        </ul>
                    </li>
                   
                    
                    <li>
                        <a href="index.html" class="waves-effect"><i class="linea-icon linea-basic fa-fw" data-icon="v"></i> <span class="hide-menu"> Caja <span class="fa arrow"></span> </span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="<?php echo URL; ?>cajas?caja=ventas">Ventas</a> </li>
                        </ul>
                    </li>

                   


                    <li>
                        <a href="javascript:void(0)" class="waves-effect"><i data-icon="F" class="linea-icon linea-software fa-fw"></i> <span class="hide-menu">Facturas de venta<span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="<?php echo URL; ?>cajas/facturas?ver=venta&pos">POS</a> </li>
                            <li> <a href="<?php echo URL; ?>cajas/facturas?ver=venta&electronica">Electronica</a> </li>
                            <li> <a href="<?php echo URL; ?>cajas/facturas?ver=venta&remision">Remision</a> </li>
                        </ul>
                    </li>

                    <li>
                        <a href="index.html" class="waves-effect"><i class="linea-icon linea-basic fa-fw" data-icon="v"></i> <span class="hide-menu"> Salir <span class="fa arrow"></span> </span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="<?php echo URL; ?>usuario/logout">CERRAR SESION</a> </li>
                        </ul>
                    </li>
                    

                </ul>
            </div>
        </div>
        <!-- Left navbar-header end -->

