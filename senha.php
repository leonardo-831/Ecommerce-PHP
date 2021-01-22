<!--
Programado por: Luana Rodrigues da Silva e Lima
Criação:12/09/2020
Última alteração: 13/09/2020
-->
<!DOCTYPE html>
<html lang="pt-br">
   
    <head>
       
        <meta charset="UTF-8">
        <title>Framefy - Redefinir senha</title>
        <link rel="stylesheet" type="text/css" href="design.css">
        <link rel="stylesheet" type="text/css" href="design2.css">
        <link rel="icon" type="imagem/png" href="imagens/icone.jpg">
        
    </head>

    <body>
        <?php
            include "conexao1.php";
            $usuario=$_GET['usuario'];
            $confirmar=$_GET['confirmar'];
            $sql="SELECT * from redefinir WHERE email='$usuario' AND confirmar='$confirmar';";
            $resultado=pg_query($conecta,$sql);
            $linhas=pg_num_rows($resultado);
            if($linhas>0)
            {
                session_start();
                $usuario=$_SESSION['usuario'];
            }
            else
            {
                echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=index.php'>";
                exit();
            }
        
        ?>
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
                        <a class="a_header" href="form_login.php">LOGIN</a>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <a class="a_header" href="dev.html">DEVS</a>

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
                            <img src="imagens/img_carrinho.png" id="img_carrinho"/>
                        </a>
                        <br>

                    </div>

            </center>
        </div>
        </center>
        <!-- DIV PRINCIPAL -->
            
            
                <font color=#300b59>
                    
                     <div id="email">
                        <center>
                            <h2>Redefinir senha</h2>
                        <br>
                        
                        <form  method="post" action="redefinir.php">
                            <label>
                                Nova senha<sup>*</sup>: 
                            </label>
                            <input type="password" name="senha" required>
                            <br><br>
                            <label>
                                Confirmar senha<sup>*</sup>: 
                            </label>
                            <input type="password" name="confirme" required>
                            <br><br>
                                <input type="submit" value="Mudar senha" class="email">
                        </form> <br><br>
                        </center>
                    </div>
                                 
                </font>
                <center>
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
                        <a class="a_header" href="dev.html">DEVS</a>
                        
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
                </center>
           </section></div>
        </center>
        
    </body>

</html>