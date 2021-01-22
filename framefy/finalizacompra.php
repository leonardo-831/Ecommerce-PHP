<!--
Programado por: Luana Rodrigues da Silva e Lima
Criação:28/09/2020
Última alteração: 29/09/2020
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
                    $email=$_SESSION['usuario'];
                    include "conexao1.php";
                    
                    $sql="SELECT * FROM produto;";
                    $resultado=pg_query($conecta,$sql);
                    $linhas=pg_num_rows($resultado);
                    $total=0;
                    $maior=0;
                    for($i=0;$i<$linhas;$i++)
                    {
                        $linha=pg_fetch_array($resultado);
                        $id=$linha['id_produto'];
                        if($id>$maior)
                        {
                            $maior=$id;
                        }
                    }
                    for($i=1;$i<=$maior;$i++)
                    {
                        if(isset($_SESSION['carrinho'][$i]))
                        {
                            $sql="SELECT * FROM produto where id_produto=$i AND excluido='n';";
                            $resultado=pg_query($conecta,$sql);
                            $linhas=pg_num_rows($resultado);
                            if($linhas>0)
                            {
                                $linha=pg_fetch_array($resultado);
                                echo "<img src='image/".$linha['imagem']."'>";
                                echo "<h2><a class='nomes_produtos'>".$linha['musica']." - ".$linha['cantor']."</a></h2>";
                                $preco= number_format($linha['preco'], 2, ',', '.');
                                echo "<br><h5> Preço: R$ ".$preco."<br>";
                                $preco=$linha['preco'];
                                $quant=$_SESSION['carrinho'][$i];
                                $mult=$preco*$quant;
                                $total+=$mult;"</h5>";
                            }
                        }
                    }
                    $total= number_format($total, 2, ',', '.');
                    echo "Total: $total";
                    $sql="SELECT * FROM cadastro where email='$email' AND excluido='n';";
                    $resultado=pg_query($conecta,$sql);
                    $linhas=pg_num_rows($resultado);
                    $linha=pg_fetch_array($resultado);
                    $endereco=$linha['endereco'];
                    echo "<form action=\"compra.php\" method=\"post\">
                    <br>ENDEREÇO:<br><br>
                    <input type=\"text\" name=\"endereco\" size = 40 value=\"$endereco\" required><br><br>
                    <input type=\"submit\" class=\"btn_comprafinal\" href=\"compra.php\" value=\"Comprar\">
                    </form>
                    ";
                ?>
                <br>
                <a class="btn_finalcompra" href="carrinho.php">Voltar para carrinho de compras</a>&nbsp;&nbsp;
                <a class="btn_finalcompra" href="index1.php">Continuar comprando</a>
                <br><br>
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