<?php

require_once "helpers/start.php";

startApp();

$logar = new Login();

include "view/layout/head.php";

if (isset($_SESSION['logado']))
{

  $usuario = new Usuarios();

  $cargo = new Cargos();

  $parans = array( 'usuario' => $usuario, 'cargo' => $cargo, 'logar' => $logar );

  include "view/layout/menu.php";

  isset($_POST['acao']) ? Post::routes($_POST['acao'], $parans) : '' ;

  isset($_GET['acao']) ? Get::routes($_GET['acao'], $parans) : '' ;

}
else
{

  include "view/login/index.php";

  isset($_POST['acao']) ? Post::routes($_POST['acao'], array('logar' => $logar)) : '';

}

include "view/layout/footer.php";
