
<?php

echo '<nav class="navbar navbar-expand-sm ">
<div class="container-fluid">
<ul>';

echo '<li class="nav-item">
        <a class="nav-link text-White" href="inicioAdmin">home</a>
    </li>';

if ($_SESSION["ruta"] == "inicioAdmin") {
    echo ' <li class="nav-item">
                <a class="nav-link text-White" href="insumos">insumos</a>
            </li>';
    echo ' <li class="nav-item">
                <a class="nav-link text-White" href="tipoServicio">servicios</a>
            </li>';
    echo ' <li class="nav-item">
                <a class="nav-link text-White" href="tipoVehiculo">tipo de vehiculo</a>
            </li>';
} elseif ($_SESSION["ruta"] == "inicioCliente") {
    echo ' <li class="nav-item">
                <a class="nav-link text-White" href="tipoServicio">servicios</a>
            </li>';
} elseif ($_SESSION["ruta"] == "inicioEmpleado") {
    echo ' <li class="nav-item">
                <a class="nav-link text-White" href="tipoServicio">servicios</a>
            </li>';
}

echo '<li class="nav-item">
                <a class="nav-link text-White" href="cerrarSesion">cerrar Sesion</a>
            </li>';

echo '</ul>
</div>
</nav>
</div>';


?>