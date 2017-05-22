<?php

class Get
{
    public static function routes($acao, $parans = [])
    {
        switch ($acao) {

            //Crud Usuarios

        case 'deletar_usuario':

            $id = (int)$_GET['id'];

            if ($parans['usuario']->delete($id)) {
                ?>
                    <div class="alert alert-success alert-dismissable">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      Deletado com sucesso!
                    </div>
                <?php

            }

            break;

        case 'editar_usuario':

            $id = (int)$_GET['id'];

            $resultado = $parans['usuario']->find($id);

            include "view/usuario/formulario_usuario_atualizar.php";

            break;

        case 'novo_usuario':

            include "view/usuario/formulario_usuario_cadastrar.php";

            break;

        case 'listar_usuarios':

            include "view/usuario/listar_usuarios.php";

            break;

          //Crud Cargos

        case 'deletar_cargo':
            $id = (int)$_GET['id'];

            if ($parans['cargo']->delete($id)) {
                ?>
                  <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    Deletado com sucesso!
                  </div>
              <?php

            }

            break;

        case 'editar_cargo':

            $id = (int)$_GET['id'];

            $resultado = $parans['cargo']->find($id);

            include "view/cargo/formulario_cargo_atualizar.php";

            break;

        case 'novo_cargo':

            include "view/cargo/formulario_cargo_cadastrar.php";

            break;

        case 'listar_cargos':

            include "view/cargo/listar_cargos.php";

            break;

        case 'logout':

            $parans['logar']->deslogar();

            break;
          }
    }
}
