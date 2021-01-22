<!--
Programado por: Luana Rodrigues da Silva e Lima
Criação:05/11/2020
Última alteração: 08/11/2020
-->
<!DOCTYPE html>
<html lang="pt-br">
   
    <head>
       
        <meta charset="UTF-8">
        <title>Framefy - Login</title>
        <link rel="stylesheet" type="text/css" href="design.css">
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
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <a class="a_header" href="dev.php">DEVS</a>

                        <br><br>

                   </div>

                    <div class="busca">
                        <input type="text" id="txtbusca" placeholder="Buscar..."/>
                        <img src="imagens/img_busca.png" id="btnbusca"/>

                    </div>

                    <div class="header_carrinho">
                        <a href="index.php">
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
                        echo "<div class='usuario'>";
                        include "conexao1.php";
                        $email=$_SESSION['usuario'];
                        $sql="SELECT * FROM cadastro WHERE email='$email' AND excluido='n' AND tipo='Administrador';";
                        $resultado=pg_query($conecta,$sql);
                        $linhas=pg_num_rows($resultado);
                        $linha=pg_fetch_array($resultado);
                        if($linhas>0 )
                        {
                            if(!isset($_GET['compra']) && !isset($_GET['clientes']) && !isset($_GET['admin'])
                              && !isset($_GET['produtos'])
                              && !isset($_GET['visualizar'])
                              && !isset($_GET['excluidos'])
                              && !isset($_GET['alterar'])
                              && !isset($_GET['excluidos']))
                            {
                            echo "<center>
                            <h1>PERFIL</h1><br>
                            </center>";
                            echo $linha['nome'];
                            echo "<br>
                            <center>
                            <div class='bylink'> 
                            <a class='btn_admin' target='_blank' href=\"admin.php?compra=1\">
                            Compras</a><br><br>
                            <a class='btn_admin' target='_blank' href=\"admin.php?clientes=1\">Clientes</a><br><br>
                            <a class='btn_admin' target='_blank' href=\"admin.php?admin=1\">Admins</a><br><br>
                            <a class='btn_admin' target='_blank' href=\"admin.php?produtos=1\">Produtos</a><br><br>
                            <a class='btn_admin' target='_blank' href=\"admin.php?visualizar=1\">Dados pessoais</a><br><br>
                             <a class='btn_admin' target='_blank' href=\"admin.php?excluidos=1\">Reativação</a><br><br>
                            <a class='btn_admin'  href=\"admin.php?sair=1\">
                            Logout</a><br><br>
                            </div></center>
                            ";
                            }
                            echo "</div>";
                        }
                        
                        else
                        {
                            echo "Não rolou";
                        }
                        if($_GET['sair']==1)
                        {
                            session_destroy();
                            echo"<script type='text/javascript'>
                alert('Logout realizado com sucesso!!')</script>";
                            echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=index.php'>";
                            
                        }
                        if($_GET['visualizar']==1)
                        {
                            echo "<div class='cliente'><br>Nome: ".$linha['nome'];
                            echo "<br>Endereço: ".$linha['endereco'];
                            echo "<br>Email: ".$linha['email'];
                            echo "<br>CEP: ".$linha['cep'];
                            echo "<br>Cpf: ".$linha['cpf'];
                            echo "<br>Data de nascimento: ".$linha['data_nasc'];
                            if($linha['sexo']=='f')
                            {
                                echo "<br>Sexo feminino";
                            }
                            if($linha['sexo']=='m')
                            {
                                echo "<br>Sexo masculino";
                            }
                            if($linha['sexo']=='o')
                            {
                                echo "<br>Outro sexo";
                            }
                            echo "<br><br><a href=\"admin.php?alterar=1\">Alterar informações</a>";
                            echo "&nbsp;&nbsp;&nbsp<a href=\"admin.php?senha=1\">Alterar senha</a><br></div><br>";
                        }
                        if($_GET['clientes']==1)
                        {
                            $Sql="SELECT * FROM cadastro WHERE excluido='n' AND tipo='Usuário';";
                            $Resultado=pg_query($conecta,$Sql);
                            $Linhas=pg_num_rows($Resultado);
                            for($i=0; $i<$Linhas; $i++)
                            {
                               $Linha=pg_fetch_array($Resultado);
                                echo "<div class='cliente'><br>Nome: ".$Linha['nome'];
                                echo "<br>Endereço: ".$Linha['endereco'];
                                echo "<br>Email: ".$Linha['email'];
                                echo "<br>CEP: ".$Linha['cep'];
                                echo "<br>Cpf: ".$Linha['cpf'];
                                echo "<br>Data de nascimento: ".$Linha['data_nasc'];
                                if($Linha['sexo']=='f')
                                {
                                    echo "<br>Sexo feminino";
                                }
                                if($Linha['sexo']=='m')
                                {
                                    echo "<br>Sexo masculino";
                                }
                                if($Linha['sexo']=='o')
                                {
                                    echo "<br>Outro sexo";
                                }
                                $id=$Linha['id_cliente'];
                                echo "<br><br><a href=\"admin.php?alterar=1&id=$id\">Alterar informações</a>";
                                echo "<br><a href=\"admin.php?adicionar=1&id=$id\">Adicionar como admin</a>";
                                echo "<br><a href=\"admin.php?excluir=1&id=$id\">Excluir usuário</a><br></div><br>";
                            }
                            
                        }
                        if($_GET['excluidos']==1)
                        {
                            $Sql="SELECT * FROM cadastro WHERE excluido='s';";
                            $Resultado=pg_query($conecta,$Sql);
                            $Linhas=pg_num_rows($Resultado);
                            for($i=0; $i<$Linhas; $i++)
                            {
                               $Linha=pg_fetch_array($Resultado);
                                echo "<div class='cliente'> <br>Nome: ".$Linha['nome'];
                                echo "<br>Endereço: ".$Linha['endereco'];
                                echo "<br>Email: ".$Linha['email'];
                                echo "<br>CEP: ".$Linha['cep'];
                                echo "<br>Cpf: ".$Linha['cpf'];
                                echo "<br>Data de nascimento: ".$Linha['data_nasc'];
                                if($Linha['sexo']=='f')
                                {
                                    echo "<br>Sexo feminino";
                                }
                                if($Linha['sexo']=='m')
                                {
                                    echo "<br>Sexo masculino";
                                }
                                if($Linha['sexo']=='o')
                                {
                                    echo "<br>Outro sexo";
                                }
                                $id=$Linha['id_cliente'];
                                echo "<br><br><a href=\"admin.php?reativar=1&id=$id\">Reativar</a><br></div><br>";
                            }
                            
                        }
                        if($_GET['admin']==1)
                        {
                            $Sql="SELECT * FROM cadastro WHERE excluido='n' AND tipo='Administrador';";
                            $Resultado=pg_query($conecta,$Sql);
                            $Linhas=pg_num_rows($Resultado);
                            for($i=0; $i<$Linhas; $i++)
                            {
                               $Linha=pg_fetch_array($Resultado);
                                echo "<div class='cliente'><br> Nome: ".$Linha['nome'];
                                echo "<br>Endereço: ".$Linha['endereco'];
                                echo "<br>Email: ".$Linha['email'];
                                echo "<br>CEP: ".$Linha['cep'];
                                echo "<br>Cpf: ".$Linha['cpf'];
                                echo "<br>Data de nascimento: ".$Linha['data_nasc'];
                                if($Linha['sexo']=='f')
                                {
                                    echo "<br>Sexo feminino<br>";
                                }
                                if($Linha['sexo']=='m')
                                {
                                    echo "<br>Sexo masculino<br>";
                                }
                                if($Linha['sexo']=='o')
                                {
                                    echo "<br>Outro sexo<br>";
                                }
                                $id=$Linha['id_cliente'];
                                echo "<br><a href=\"admin.php?alterar=1&id=$id\">Alterar informações</a>";
                                echo "<br><a href=\"admin.php?remover=1&id=$id\">Remover de admin</a>";
                                echo "<br><a href=\"admin.php?excluir=1&id=$id\">Excluir usuário</a><br></div><br>";
                            }
                            
                        }
                        if($_GET['excluir']==1)
                        {
                            $id=$_GET['id'];
                            $Sql="UPDATE cadastro set excluido='s' WHERE id_cliente=$id;";
                            $Resultado=pg_query($conecta,$Sql);
                            $Linhas=pg_affected_rows($Resultado);
                            if($Linhas>0)
                                echo"<script type='text/javascript'>
                alert('Exclusão realizada com sucesso!!')</script>";
                            else
                                echo"<script type='text/javascript'>
                alert('Erro na exclusão')</script>";
                        }
                        if($_GET['reativar']==1)
                        {
                            $id=$_GET['id'];
                            $Sql="UPDATE cadastro set excluido='n' WHERE id_cliente=$id;";
                            $Resultado=pg_query($conecta,$Sql);
                            $Linhas=pg_affected_rows($Resultado);
                            if($Linhas>0)
                             echo"<script type='text/javascript'>
                alert('Reativação realizada com sucesso!!')</script>";
                            else
                                echo"<script type='text/javascript'>
                alert('Reativação falhou!!')</script>";
                        }
                        if($_GET['remover']==1)
                        {
                            $id=$_GET['id'];
                            $Sql="UPDATE cadastro set tipo='Usuário' WHERE id_cliente=$id;";
                            $Resultado=pg_query($conecta,$Sql);
                            $Linhas=pg_affected_rows($Resultado);
                            if($Linhas>0)
                                echo"<script type='text/javascript'>
                alert('Exclusão realizada com sucesso!!')</script>";
                            else
                                echo"<script type='text/javascript'>
                alert('Erro na exclusão')</script>";
                        }
                        if($_GET['adicionar']==1)
                        {
                            $id=$_GET['id'];
                            $Sql="UPDATE cadastro set tipo='Administrador' WHERE id_cliente=$id;";
                            $Resultado=pg_query($conecta,$Sql);
                            $Linhas=pg_affected_rows($Resultado);
                            if($Linhas>0)
                                echo "Exclusão realizada com sucesso";
                            else
                                echo "Não foi possível realizar exclusão";
                        }
                        if($_GET['compra']==1)
                        {
                            $Sql="SELECT * FROM cadastro;";
                            $Resultado=pg_query($conecta,$Sql);
                            $quantidade=pg_num_rows($Resultado);
                            for($j=0;$j<$quantidade;$j++)
                            {
                                $Linha=pg_fetch_array($Resultado);
                                $id_cliente=$Linha['id_cliente'];
                                
                                $SQL="SELECT * FROM compra,produto WHERE id_cliente=$id_cliente AND compra.excluido='n' AND produto.id_produto=compra.id_produto;";
                                $RESULTADO=pg_query($conecta,$SQL);
                                $Linhas=pg_num_rows($RESULTADO);
                                if($Linhas>0)
                                    echo "<br><div class='compra'><h2>".$Linha['nome']."</h2>";
                                $aux=0;
                                $total=0;
                                $flag=false;
                                for($i=0;$i<$Linhas;$i++)
                                {
                                    $Linha=pg_fetch_array($RESULTADO);
                                    if($Linha['id_compra']!=$aux)
                                    {
                                        if($total!=0)
                                        {
                                            $total = number_format($total, 2, ',', '.');
                                            echo "<br>Total: $total";
                                            $flag=true;
                                        }
                                        $aux=$Linha['id_compra'];
                                        echo "<h5><br>Compra $aux <br></h5>";
                                    }
                                    $preco=$Linha['preco'];
                                    $preco = number_format($preco, 2, ',', '.');
                                    echo "<br>Quadro ".$Linha['musica']."(".$Linha['quantidade']."x)..............".$preco;
                                    $total=$Linha['total'];
                                }
                                if($total!=0 AND $flag)
                                 {
                                    $total = number_format($total, 2, ',', '.');
                                    echo "<br>Total: $total</div><br>";
                                }
                                if($total!=0 AND !$flag)
                                 {
                                    $total = number_format($total, 2, ',', '.');
                                    echo "<br>Total: $total </div><br>";
                                }
                            }
                            
                        }
                        
                        if($_GET['produtos']==1)
                        {
                            $Sql = "SELECT * FROM produto WHERE excluido='n' ORDER BY musica";
                            $res = pg_query($conecta, $Sql);
                            $qtde=pg_num_rows($res);
                            if($qtde>0){
                                echo "<table>";
                                echo "<tr>";
                                $num=0;
                                for ($cont=0; $cont < $qtde; $cont++)
                                {
                                    if($num==3){
                                        echo "</tr>";
                                        echo "<tr>";
                                        $num=0;
                                    }
                                    $Linha=pg_fetch_array($res);
                                    echo "<td  class='produtos'>";
                                    echo "<center><img src='image/".$Linha['imagem']."'>";
                                    echo "<h2><a class='nomes_produtos'>".$Linha['musica']."</a></h2>";
                                    echo "<h3>".$Linha['cantor']."</h3>";
                                    $preco= number_format($Linha['preco'], 2, ',', '.');
                                    echo "Preço: R$ ".$preco."<br>";
                                    echo "<br><a class='prod_btn' href='admin.php?estoque=1&id=".$Linha['id_produto']."'>Alterar estoque</a>
                                    <br><br><br><a class='prod_btn' href='admin.php?preco=1&id=".$Linha['id_produto']."'>Alterar preço</a><br>
                                    </center><br><br><hr><br>";
                                    echo "</td>";
                                    $num++;
                                }
                                echo "</tr>";
                                echo "</table>";
                            }
                            else
                                echo "<br>Não há produtos disponíveis!<br>";
                        }
                        
                        if($_GET['estoque']==1)
                        {
                            $id=$_GET['id'];
                            $Sql="SELECT * FROM produto WHERE excluido='n' AND id_produto=$id;";
                            $Resultado=pg_query($conecta,$Sql);
                            $Linhas=pg_num_rows($Resultado);
                            $Linha=pg_fetch_array($Resultado);
                            $estoque=$Linha['estoque'];
                            echo "<form target='_blank' action=\"admin.php?alterar_estoque=1&id=$id\" method=\"post\">";

                            echo "<br>ESTOQUE:<br>";
                            echo "<input type=\"number\" name=\"estoque\" maxlenght = 10 size = 4 value=\"$estoque\" required><br>";


                            echo "<br><br><input type=\"submit\" class=\"btn_comprafinal\" value=\"ENVIAR\"><br><br>";
                            echo "<input type=\"reset\" class=\"btn_comprafinal\" value=\"LIMPAR\">";

                            echo "</form> ";
                        }
                        if($_GET['preco']==1)
                        {
                            $id=$_GET['id'];
                            $Sql="SELECT * FROM produto WHERE excluido='n' AND id_produto=$id;";
                            $Resultado=pg_query($conecta,$Sql);
                            $Linhas=pg_num_rows($Resultado);
                            $Linha=pg_fetch_array($Resultado);
                            $preco=$Linha['preco'];
                            echo "<form action=\"admin.php?alterar_preco=1&id=$id\" method=\"post\">";

                            echo "<br>PREÇO:<br>";
                            echo "<input type=\"number\" name=\"estoque\" maxlenght = 10 size = 4 value=\"$preco\" required><br>";


                            echo "<br><br><input type=\"submit\" class=\"btn_comprafinal\" value=\"ENVIAR\"><br><br>";
                            echo "<input type=\"reset\" value=\"LIMPAR\">";

                            echo "</form> ";
                        }
                        if($_GET['alterar_preco']==1)
                        {
                            $id=$_GET['id'];
                            $preco=$_POST['preco'];
                            $Sql="UPDATE produto set preco=$preco WHERE id_produto=$id;";
                            $Resultado=pg_query($conecta,$Sql);
                            $Linhas=pg_affected_rows($Resultado);
                            if($Linhas>0)
                                echo "Alteração realizada com sucesso";
                            else
                                echo "Não foi possível realizar alteração";
                        }
                        if($_GET['alterar_estoque']==1)
                        {
                            $id=$_GET['id'];
                            $estoque=$_POST['estoque'];
                            $Sql="UPDATE produto set estoque=$estoque WHERE id_produto=$id;";
                            $Resultado=pg_query($conecta,$Sql);
                            $Linhas=pg_affected_rows($Resultado);
                            if($Linhas>0)
                                echo "Alteração realizada com sucesso";
                            else
                                echo "Não foi possível realizar alteração";
                        }

                        if($_GET['alterar']==1)
                        {
                            $id=$_GET['id'];
                            $Sql="SELECT * FROM cadastro WHERE excluido='n' AND id_cliente=$id;";
                            $Resultado=pg_query($conecta,$Sql);
                            $Linhas=pg_num_rows($Resultado);
                            $nome=$Linha['nome'];
                            $endereco=$Linha['endereco'];
                            $email=$Linha['email'];
                            $cep=$Linha['cep'];
                            $cpf=$Linha['cpf'];
                            $data_nasc=$Linha['data_nasc'];
                            echo "<form action=\"alterar.php?tudo=1\" method=\"post\">";
                            echo "<br>NOME:<br>";
                            echo "<input type=\"text\" name=\"nome\" pattern=\"[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$\" maxlenght = 50 size = 40  value=\"$nome\" required><br>";

                            echo "<br>ENDEREÇO:<br>";

                            echo "<input type=\"text\" name=\"endereco\" size = 40 value=\"$endereco\" required><br>";

                            echo "<br>CEP:<br>";
                            echo "<input type=\"number\" name=\"cep\" maxlenght = 50 size = 40 value=\"$cep\" required><br>";

                            echo "<br>CPF:<br>";
                            echo "<input type=\"number\" name=\"cpf\" maxlenght = 50 size = 40  value=\"$cpf\" required><br>";

                            echo "<br>DATA DE NASCIMENTO:<br>";
                            echo "<input type=\"date\" name=\"data_nasc\" value=\"$data_nasc\" required><br>";

                            echo "<br>SEXO:<br>";
                            if($Linha['sexo']=='f')
                            {
                                echo "<input type=\"radio\" name=\"sexo\" value=\"m\">";
                                echo "<label for=\"masculino\">Masculino</label><br>";
                                echo "<input type=\"radio\" name=\"sexo\" checked value=\"f\">";
                                echo "<label for=\"feminino\">Feminino</label><br>";
                                echo "<input type=\"radio\" name=\"sexo\" value=\"x\">";
                                echo "<label for=\"outro\">Outro</label><br>";
                            }
                            if($Linha['sexo']=='m')
                            {
                                echo "<input type=\"radio\" name=\"sexo\" checked value=\"m\">";
                                echo "<label for=\"masculino\">Masculino</label><br>";
                                echo "<input type=\"radio\" name=\"sexo\" value=\"f\">";
                                echo "<label for=\"feminino\">Feminino</label><br>";
                                echo "<input type=\"radio\" name=\"sexo\" checked value=\"x\">";
                                echo "<label for=\"outro\">Outro</label><br>";
                            }
                            if($Linha['sexo']=='o')
                            {
                                echo "<input type=\"radio\" name=\"sexo\" value=\"m\">";
                                echo "<label for=\"masculino\">Masculino</label><br>";
                                echo "<input type=\"radio\" name=\"sexo\" value=\"f\">";
                                echo "<label for=\"feminino\">Feminino</label><br>";
                                echo "<input type=\"radio\" name=\"sexo\" value=\"x\">";
                                echo "<label for=\"outro\">Outro</label><br>";
                            }
                            
                            echo "<br>EMAIL:<br>";
                            echo "<input type=\"email\" name=\"mail\" value=\"$email\" required><br>";

                            echo "<label for=\"cliente\">Usuário</label><br>";

                            echo "<br><input type=\"submit\" class=\"btn_comprafinal\" value=\"ENVIAR\">                                 ";
                            echo "         <input type=\"reset\" class=\"btn_comprafinal\" value=\"LIMPAR\"><br><br>";

                            echo "</form> ";
                        }
                        if($_GET['senha']==1)
                        {
                            echo "<form action=\"alterar.php?senha=1\" method=\"post\">";
                            echo "
                            <script language=\"javascript\">
                            function passwordChanged() {
                                var strength = document.getElementById('strength');
                                var strongRegex = new RegExp(\"^(?=.{8,})(?=.[A-Z])(?=.[a-z])(?=.[0-9])(?=.\\W).*$\", \"g\");
                                var mediumRegex = new RegExp(\"^(?=.{7,})(((?=.[A-Z])(?=.[a-z]))|((?=.[A-Z])(?=.[0-9]))|((?=.[a-z])(?=.[0-9]))).*$\", \"g\");
                                var enoughRegex = new RegExp(\"(?=.{6,}).*\", \"g\");
                                var pwd = document.getElementById(\"senha\");
                                if (pwd.value.length == 0) {
                                        strength.innerHTML = ' ';
                                } else if (false == enoughRegex.test(pwd.value)) {
                                        strength.innerHTML = 'Mais caracteres';
                                } else if (strongRegex.test(pwd.value)) {
                                        strength.innerHTML = '<span style=\"color:green\">Forte!</span>';
                                } else if (mediumRegex.test(pwd.value)) {
                                        strength.innerHTML = '<span style=\"color:orange\">Intermediária!</span>';
                                } else {
                                        strength.innerHTML = '<span style=\"color:red\">Fraca!</span>';
                                }
                            }
                            </script>
                            <label>
                                Senha<sup>*</sup>: 
                            </label>
                            <input name=\"senha\" id=\"senha\" type=\"password\" size=\"15v\" maxlength=\"100\" onkeyup=\"return passwordChanged();\" required>
                            <br><span id=\"strength\"></span><br><br>
                            <label>
                                Confirmar senha<sup>*</sup>: 
                            </label>
                            <input type=\"password\" name=\"confirme\" required>
                            <br><br>
                                <input type=\"submit\" class=\"btn_comprafinal\" value=\"Mudar senha\"> ";
                            echo "</form><br>";
                            if($_SESSION['senha']==1)
                            {
                                echo "<br>Senha inválida";
                                $_SESSION['senha']=0;
                            }

                        }
                    }
                    
                    else
                    {
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