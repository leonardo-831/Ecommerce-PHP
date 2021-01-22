<!--
Programado por: Luana Rodrigues da Silva e Lima
Criação:11/09/2020
Última alteração: 12/09/2020
-->
<!DOCTYPE html>
<html lang="pt-br">
   
    <head>
       
        <meta charset="UTF-8">
        <title>Framefy - Login</title>
        <link rel="stylesheet" type="text/css" href="design.css">
        <link rel="stylesheet" type="text/css" href="design2.css">
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
                        <a class="a_header" href="login.php">LOGIN</a>
                        &nbsp;&nbsp;&nbsp;&nbsp;
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
                            <img src="imagens/img_carrinho.png" id="img_carrinho"/>
                        </a>
                        <br>

                    </div>

            </center>
        </div>
        </center>
        <!-- DIV PRINCIPAL -->


                <font color=#300b59>
                    <br><br><br><br><br><br><br><br>
                    <div id="login"><section>
                        <center>
                        <div style="text-align: left; width: 320px">

                                        <center><h1 style="color: #300b59; font-size: 30px; font-style: bold">Login</h1></center>
                                    <br>

                                    <form  method="post" action="login.php">
                                        <label>
                                            E-mail<sup>*</sup>: 
                                        </label><br>
                                        <input type="email" name="mail" required>
                                        
                                        <br><br>
                                        
                                        <label>
                                            Senha<sup>*</sup>:
                                        </label><br>
                                        <input type="password" name="senha" required>
                                        <br><br>
                            
                                        <center><input type="submit" value="Logar" class="btn"></center>
                                    </form>
                            <?php
                                session_start();
                                if(isset($_SESSION['login']))
                                {
                                    if(!$_SESSION['login'])
                                    {
                                        echo "Usuário ou senha incorretos";
                                        $_SESSION['login']=true;
                                    }
                                        
                                }
                            ?>
                            <br>
                            <br>
                                <center>
                                    <p style="font-size: 15px">Não possui login? &nbsp; <a class="cadastro" href="form_cadastro1.html" style="font-size: 15px">Faça seu cadastro!</a></p>
                                    <a class="cadastro" href="email.html" style="font-size: 15px">Esqueceu sua senha?</a><br><br>
                                </center>
                            </div>
                        </center>
                    </section></div>
                                 
                </font>
           </section></div>
        </center>
        
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
                        <a class="a_header" href="dev.php">DEVS</a>
                        
                        <br><br>
                        
                        01 - Ana Silva | 
                        08 - Diego Rodrigues | 
                        21 - Leonardo Muto | 
                        25 - Luana Lima | 
                        30 - Sara Ceschin | 
                        32 - Sofia Conti
                        
                        <br>
                    </center>
                </div>
                </center>
        
    </body>

</html>