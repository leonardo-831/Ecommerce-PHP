<!--
Programado por: Luana Rodrigues da Silva e Lima
Criação:22/09/2020
Última alteração: 25/09/2020
-->
<!DOCTYPE html>
<html lang="pt-br">
   
    <head>
       
        <meta charset="UTF-8">
        <title>Framefy - Login</title>
        <link rel="stylesheet" type="text/css" href="login_design.css">
        <link rel="icon" type="imagem/png" href="imagens/icone.jpg">
        
    </head>

    <body>
        <center>
        <div class="div_principal">  <section>
        <!-- HEADER -->
        <center>
            
            <div class="header">
              <center>

                   <div class="logo">
                        <a href="index.php">
                            <img id="header_logo" src="imagens/logomarca.jpg">
                        </a>
                    </div>

                   <div class="links">
                        <a class="a_header" href="index.php">HOME</a>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <a class="a_header" href="index1.php">PRODUTOS</a>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <?php
                        session_start();
                        if(isset($_SESSION['usuario']))
                        {
                            include "conexao1.php";
                            $email=$_SESSION['usuario'];
                            $sql="SELECT * FROM cadastro WHERE email='$email' AND excluido='n' AND tipo='Administrador';";
                            $resultado=pg_query($conecta,$sql);
                            $linhas=pg_num_rows($resultado);
                            if($linhas>0)
                            {
                                echo "<a class=\"a_header\" href=\"admin.php\">ADMIN</a>";
                            }
                            else
                            {
                                echo "<a class=\"a_header\" href=\"perfil.php\">PERFIL</a>";
                            }
                        }
                        else
                        {
                            echo "<a class=\"a_header\" href=\"form_login.php\">LOGIN</a>";
                        }
                        
                    ?>
                    
                    &nbsp;&nbsp;&nbsp;
                        <a class="a_header" href="dev.php">DEVS</a>

                        <br><br>

                   </div>

                    <div class="busca">
                        <input type="text" id="txtbusca" name="txtbusca" placeholder="Buscar..."/>
                        <img src="imagens/img_busca.png" id="btnbusca"/>

                    </div>

                    <div class="header_carrinho">
                        <a href="carrinho.php">
                            <img src="imagens/img_carrinho.png" id="img_carrinho"/>
                        </a>
                        <br>

                    </div>

            </center>
        </div>
        </center>
            <br><br><br><br><br><br><br>
                <?php
                    session_start();
                    if(isset($_SESSION['usuario']))
                    {
                        include "conexao1.php";
                        $email=$_SESSION['usuario'];
                        $sql="SELECT * FROM cadastro WHERE email='$email' AND excluido='n';";
                        $resultado=pg_query($conecta,$sql);
                        $linhas=pg_num_rows($resultado);
                        $linha=pg_fetch_array($resultado);
                        if($linhas>0)
                        {
                           if(!isset($_GET['compra']) && !isset($_GET['clientes']) && !isset($_GET['admin'])
                              && !isset($_GET['produtos'])
                              && !isset($_GET['visualizar'])
                              && !isset($_GET['excluidos']))
                        }
                        else
                        {
                            echo "Não rolou";
                        }
                        if($_GET['sair']==1)
                        {
                            session_destroy();
                            echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=index.php'>";
                        }
                        if($_GET['tudo']==1){
                            $codigo=$linha['id_cliente'];
                            $nome=$_POST['nome'];
                            $endereco=$_POST['endereco'];
                            $cep=$_POST['cep'];
                            $cpf=$_POST['cpf'];
                            $data_nasc=$_POST['data_nasc'];
                            $sexo=$_POST['sexo'];
                            $mail=$_POST['mail'];
                            $senha=md5($s);
                            $sql="UPDATE cadastro set nome='$nome', endereco='$endereco', cep='$cep', cpf='$cpf', data_nasc='$data_nasc', sexo='$sexo', email='$mail' WHERE excluido='n' AND id_cliente=$codigo;";
                            $resultado=pg_query($conecta,$sql);
                            $linhas=pg_affected_rows($resultado);
                            if ($linhas > 0)
                            {
                                echo "Alteração concluído!";
                            }
                            else	
                            {
                                echo "Erro na alteração!";
                                echo $sql;
                                exit;
                            }
                        }
                            

                            
                            
                            
                        if($_GET['senha']==1)
                        {
                            $senha=$_POST['senha'];
                            $confirmar=$_POST['confirme'];
                            if($senha!=$confirmar)
                            {
                                $_SESSION['senha']=1;
                                echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=perfil.php?senha=1'>";
                                exit;
                            }
                            $cripto=md5($senha);
                            $sql="UPDATE cadastro set senha='$cripto' WHERE excluido='n' AND email='$email';";
                            $resultado=pg_query($conecta,$sql);
                            $qtde=pg_affected_rows($resultado);
                            if($qtde>0)
                            {
                                echo"<script type='text/javascript'> alert('Senha alterada com sucesso')</script>";
                                pg_close($conecta);
                                echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=perfil.php?visualizar=1'>";
                            }
                            else
                            {
                                pg_close($conecta);
                                echo"<script type='text/javascript'> alert('Não foi possível mudar senha')</script>";
                                echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=perfil.php?visualizar=1'>";
                            }
                        }
                        else
                            echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=index.php'>";

                    }
                ?>
            
                <!-- FOOTER -->
                <div class="footer">
                   <center>
                       <br><br>
                        <a class="a_header" href="index.php">HOME</a>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <a class="a_header" href="index1.php">PRODUTOS</a>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <?php
                        session_start();
                        if(isset($_SESSION['usuario']))
                        {
                            include "conexao1.php";
                            $email=$_SESSION['usuario'];
                            $sql="SELECT * FROM cadastro WHERE email='$email' AND excluido='n' AND tipo='Administrador';";
                            $resultado=pg_query($conecta,$sql);
                            $linhas=pg_num_rows($resultado);
                            if($linhas>0)
                            {
                                echo "<a class=\"a_header\" href=\"admin.php\">ADMIN</a>";
                            }
                            else
                            {
                                echo "<a class=\"a_header\" href=\"perfil.php\">PERFIL</a>";
                            }
                        }
                        else
                        {
                            echo "<a class=\"a_header\" href=\"form_login.php\">LOGIN</a>";
                        }
                        
                    ?>
                    
                    &nbsp;&nbsp;&nbsp;
                        <a class="a_header" href="dev.php">DEVS</a>
                        
                        <br><br>
                        
                        01 - Ana Silva | 
                        08 - Diego Rodrigues | 
                        21 - Leonardo Muto | 
                        25 - Luana Lima | 
                        30 - Sara Ceschin | 
                        32 - Sofia Conti
                        
                        <br><br><br>
                    </center>
                </div>
           </section></div>
        </center>
        
    </body>

</html>