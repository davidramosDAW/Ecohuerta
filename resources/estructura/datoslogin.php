<?php
$usuario = $_SESSION['Usuario'];
$status = $_SESSION['status'];
echo '
    <div id="autenticacion">
      <table id="tabla_autenticacion"><tr>
      <td>' . $usuario .'</td>
      <td>Cerrar Sesión</td>
      </tr>
      <tr>'?>

      <?php if ($status == 4){
          echo '<td><a href="../php/alta_usuario.php"><img src="/img/add-user.png" alt="" width="32px">Alta Usuarios</p></a></td>';
      }else {
          echo '<td></td>';
      }
echo'
      <td><a href="../php/logout.php"><img src="/img/cancel.png" alt="" width="32px"></a></td>
      </tr></table>
</div>' ?>

