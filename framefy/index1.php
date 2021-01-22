<?php
/*
Sara Burgo Ceschin - Última alteração: 08/09, 16/09
*/
?>
<!DOCTYPE html>
<html lang="pt-br">
   <head>
        <meta http-equiv="Content-Type" content="text/html">
        <title>Página Inicial</title>
        <link rel="stylesheet" type="text/css" href="design.css">
        <link rel="icon" type="imagem/png" href="imagens/icone.jpg">
    </head>
    <body>
       
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
		    <form action="pesquisa.php" method="post">
                    	<input type="text" id="txtbusca" placeholder="Buscar..."/>
                    	<input type=image src="imagens/img_busca.jpeg" id="btnbusca"/>
		    </form>
                    
                </div>
                
                <div class="header_carrinho">
                    <a href="index.php">
                        <img src="imagens/img_carrinho.jpeg" id="img_carrinho"/>
                    </a>
                    <br>
                    
                </div>
                
            </center>
        </div>
        
        <br><br><br>
        
        <center>
            <div class="div_principal"> <section>
       
               <br><br><br>
                <?php
                    require "conexao1.php";
                    $sql = "SELECT * FROM produto WHERE excluido='n' ORDER BY musica";
                    $res = pg_query($conecta, $sql);
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
                            $linha=pg_fetch_array($res);
                            echo "<td  class='produtos'>";
                            echo "<center><img src='image/".$linha['imagem']."'>";
                            echo "<h2><a class='nomes_produtos'>".$linha['musica']."</a></h2>";
                            echo "<h3>".$linha['cantor']."</h3>";
                            $preco= number_format($linha['preco'], 2, ',', '.');
                            echo "Preço: R$ ".$preco."<br>";
                            echo "<br><a class='prod_btn' href='carrinho.php?acao=add&id_produto=".$linha['id_produto']."'>Comprar</a></center><br><br><hr><br>";
                            echo "</td>";
                            $num++;
                        }
                        echo "</tr>";
                        echo "</table>";
                    }
                    else
                        echo "<br>Não há produtos disponíveis!<br>";
                ?>
        
        <br><br><br><br>
               
               </section> </div>
        </center>
                
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
                        26 - Luana Lima | 
                        30 - Sara Ceschin | 
                        33 - Sofia Conti
                        
                        <br><br><br>
                    </center>
                </div>

    </body>
</html>