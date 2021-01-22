<!DOCTYPE html>
<html lang="pt-br">
    <head>
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="utf-8" />
        
        <link rel="stylesheet" type="text/css" href="design.css">
        <link rel="icon" type="imagem/png" href="imagens/icone.jpg">
       
        <title>Pesquisa</title>
    </head>
    <body>
       
       <!-- HEADER -->
        <div class="header">
          <center>
               
               <div class="logo">
                    <a href="index.php">
                        <img id="header_logo" src="imagens/logomarca.jpg">
                    </a>
                </div>
               
               <div class="links">
                    <a class="a_header" href="index.php">HOME</a>
                    &nbsp;&nbsp;&nbsp;
                    <a class="a_header" href="index1.php">PRODUTOS</a>
                    &nbsp;&nbsp;&nbsp;
                    
                    <?php
                   //Modificado por Luana Rodrigues da Silva e Lima
                   //Modificado em:16/09/2020
                   //Códigos abaixo
                        session_start();
                        if(isset($_SESSION['usuario']))
                        {
                           echo "<a class=\"a_header\" href=\"perfil.php\">PERFIL</a>";
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
                    	<input type="text" id="txtbusca" name="txtbusca" placeholder="Buscar..."/>
                    	<input type=image src="imagens/img_busca.jpeg" id="btnbusca"/>
		             </form>
                    
                </div>
                
                <div class="header_carrinho">
                    <a href="carrinho.php">
                        <img src="imagens/img_carrinho.jpeg" id="img_carrinho"/>
                    </a>
                    <br>
                    
                </div>
                
            </center>
        </div>
        
        <!-- DIV PRINCIPAL -->
        <center>
            <div class="div_principal"> <section>
               
                a<br><br><br><br><br><br>
                
                <div align="center" style="color:  #300b59">
                    <h1>Resultados da pesquisa:</h1><br>
                    <?php
                        include "conexao1.php";
                        if(isset($_POST))
                        { 
                            $pesquisa = strtolower($_POST["txtbusca"]);
                            $sql="SELECT * FROM produto WHERE excluido='n' AND lower(musica) LIKE '%$pesquisa%' OR lower(cantor) LIKE '%$pesquisa%' ORDER BY musica;";
                            $resultado= pg_query($conecta, $sql);
                            $x=pg_num_rows($resultado);
                            if ($x > 0)
                            {
                                while($linha = pg_fetch_array($resultado))
                                {
                                    echo "<br><img src='image/".$linha['imagem']."'>";
                                    echo "<h2>".$linha['musica']." - ".$linha['cantor']."</h2>";
                                    $preco= number_format($linha['preco'], 2, ',', '.');
                                    echo "Preço: R$ ".$preco."<br><br><br>";
                                    echo "<a class='prod_btn' class=\"cadastro\" href='carrinho.php?acao=add&id_produto=".$linha['id_produto']."'>Comprar</a>";
                                    echo "<br><br><br><hr><br>";
                                }
                            }
                            else
                                echo "<br>Não há produtos disponíveis!<br>";            
                            pg_close($conecta);
                        }
                    ?>

                </div>
        
        <br><br>
                
                <!-- FOOTER -->
                <div class="footer">
                   <center>
                       <br><br>
                        <a class="a_header" href="index.php">HOME</a>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <a class="a_header" href="index1.php">PRODUTOS</a>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <a class="a_header" href="form_login.php">LOGIN</a>
                        &nbsp;&nbsp;&nbsp;&nbsp;
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
                
           </section> </div>
        </center>
        
    </body>
</html>