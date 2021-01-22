<!DOCTYPE html>
<html lang="pt-br">
   
    <head>
       
        <meta charset="UTF-8">
        <title>Framefy - Página Inicial</title>
        <link rel="stylesheet" type="text/css" href="design.css">
        <link rel="stylesheet" type="text/css" href="design2.css">
        <link rel="icon" type="imagem/png" href="imagens/icone.jpg">
        
    </head>

    <body>
        
        <!-- HEADER -->
        <div class="header">
          <center>
               
               <div class="logo">
                    <a href="index.html">
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
                    	<input type="text" id="txtbusca" name="txtbusca" placeholder="Buscar..."/>
                    	<input type=image src="imagens/img_busca.jpeg" id="btnbusca"/>
		             </form>
                    
                </div>
                
                <div class="header_carrinho">
                    <a href="index.html">
                        <img src="imagens/img_carrinho.jpeg" id="img_carrinho"/>
                    </a>
                    <br>
                    
                </div>
                
            </center>
        </div>
        
        <!-- DIV PRINCIPAL -->
        <center>
            <div class="div_principal"> <section>
               
                
                <br><br><br><br><br><br><br>
                
                <div class="dev_box">
                    <img src="imagens/dev1.jpg" class="dev_foto">
                    <div class="dev">
                        <h3>Ana Beatriz da Silva</h3>
                        Nº01 - 72B <br><br><br><br>
                    </div>
                </div>
                
                &nbsp;
                
                <div class="dev_box">
                    <img src="imagens/dev2.jpeg" class="dev_foto"> &nbsp;
                    <div class="dev">
                        <h3>Diego Rodrigues Carvalho</h3>
                        Nº08 - 72B <br><br><br><br>
                    </div>
                </div>
                
                <br><br>
                
                <div class="dev_box">
                    <img src="imagens/dev3.jpeg" class="dev_foto"> &nbsp;
                    <div class="dev">
                        <h3>Leonardo Belíssimo Muto</h3>
                        Nº21 - 72B <br><br><br><br>
                    </div>
                </div>
                
                &nbsp;
                
                <div class="dev_box">
                    <img src="imagens/dev4.jpg" class="dev_foto"> &nbsp;
                    <div class="dev">
                        <h3>Luana Rodrigues Silva e Lima</h3>
                        Nº26 - 72B <br><br><br><br>
                    </div>
                </div>
                
                <br><br>
                
                <div class="dev_box">
                    <img src="imagens/dev5.jpeg" class="dev_foto"> &nbsp;
                    <div class="dev">
                        <h3>Sara Burgo Ceschin</h3>
                        Nº30 - 72B <br><br><br><br>
                    </div>
                </div>
                
                &nbsp;
                
                <div class="dev_box">
                    <img src="imagens/dev6.jpeg" class="dev_foto"> &nbsp;
                    <div class="dev">
                        <h3>Sofia Ferreira Conti</h3>
                        Nº32 - 72B <br><br><br><br>
                    </div>
                </div>
                
                <br><br>
                
                
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