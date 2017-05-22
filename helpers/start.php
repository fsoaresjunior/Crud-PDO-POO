<?php

function startApp()
{
  session_start();
  /*
  Esta função irá ativar o buffer de saída. Enquanto o buffer de saída estiver ativo,
  não é enviada a saída do script (outros que não sejam cabeçalhos), ao invés a saída
  é guardada em um buffer interno.
  */
  ob_start();

  ini_set('display_errors', 1);

  ini_set('display_startup_erros', 1);

  error_reporting(E_ALL);

  spl_autoload_register(function ($class)
  {
    if (file_exists('classes/' . ucfirst($class) . '.php'))
    {
      require_once 'classes/' . ucfirst($class) . '.php';
    }
    if (file_exists('routes/' . ucfirst($class) . '.php'))
    {
      require_once 'routes/' . ucfirst($class) . '.php';
    }
  });
}
