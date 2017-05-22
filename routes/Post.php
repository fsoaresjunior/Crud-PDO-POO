<?php

class Post
{
    public static function routes($acao, $parans = [])
    {
        switch ($acao) {
      case 'Cadastrar usuario':

          $parans['usuario']->setNome($_POST['nome']);
          $parans['usuario']->setSenha($_POST['senha']);
          $parans['usuario']->setCargo($_POST['cargo']);

          if (isset($parans['usuario']->findByEmail($_POST['email'])->email) == $_POST['email']) {
              ?>
                <div class="alert alert-danger alert-dismissable">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  O e-mail já está cadastrado!
                </div>
              <?php

          } else {
              if ($parans['usuario']->setEmail($_POST['email'])) {
                  if ($parans['usuario']->insert()) {
                      ?>
                        <div class="alert alert-success alert-dismissable">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          Inserido com sucesso!
                        </div>
                      <?php

                  }
              }
          }

          break;

      case 'Atualizar usuario':
          $parans['usuario']->setNome($_POST['nome']);

          $parans['usuario']->setSenha($_POST['senha']);

          $parans['usuario']->setCargo($_POST['cargo']);

          if ($parans['usuario']->setEmail($_POST['email'])) {
              $parans['usuario']->update($_POST['id']);
              ?>
                <div class="alert alert-success alert-dismissable">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  Atualizado com sucesso!
                </div>
              <?php

          } else {
              ?>
                <div class="alert alert-danger alert-dismissable">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  O e-mail inserido é invalido!
                </div>
              <?php

          }

          break;

      case 'Cadastrar cargo':

          $parans['cargo']->setNome($_POST['cargo']);

          if (isset($parans['cargo']->findByNome($_POST['cargo'])->nome) == $_POST['cargo']) {
              ?>
                <div class="alert alert-danger alert-dismissable">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  Cargo já existe!
                </div>
              <?php

          } else {
              if ($parans['cargo']->insert()) {
                  ?>
                      <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        Inserido com sucesso!
                      </div>
                  <?php

              }
          }

          break;

      case 'Atualizar cargo':

          $parans['cargo']->setNome($_POST['cargo']);
          if ($parans['cargo']->update($_POST['id'])) {
              ?>
              <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                Atualizado com sucesso!
              </div>
              <?php

          }

          break;

      case 'logar':

          if ($parans['logar']->logar($_POST["email"], md5($_POST["senha"]))) {
              header("location: index.php");
          } else {
              ?>
                  <div class="container">
                    <div class="alert alert-danger alert-dismissable">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      Erro ao logar!
                    </div>
                  </div>
              <?php

          }

          break;
      }
    }
}
