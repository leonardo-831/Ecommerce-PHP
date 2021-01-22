<?php
//Sara Burgo Ceschin - Última alteração: 16/09

      session_start();
       
      if(!isset($_SESSION['carrinho'])){
         $_SESSION['carrinho'] = array();
      }
       
      //adiciona produto
       
      if(isset($_GET['acao'])){
          
         //ADICIONAR CARRINHO
         if($_GET['acao'] == 'add'){
            $id_produto = intval($_GET['id_produto']); // Código do produto que vem da página index.php
            if(!isset($_SESSION['carrinho'][$id_produto])){
               $_SESSION['carrinho'][$id_produto] = 1;
            }else{
               $_SESSION['carrinho'][$id_produto] += 1;
            }
         }
          
         //REMOVER CARRINHO
         if($_GET['acao'] == 'del'){
            $id_produto = intval($_GET['id_produto']);
            if(isset($_SESSION['carrinho'][$id_produto])){
               unset($_SESSION['carrinho'][$id_produto]);
            }
         }
          
         //ALTERAR QUANTIDADE
         if($_GET['acao'] == 'up'){
            if(is_array($_POST['prod'])){
               foreach($_POST['prod'] as $id_produto => $qtd){
                  $id_produto = intval($id_produto);
				  //desprezar a parte decimal
                  $qtd = intval($qtd);
                  if(!empty($qtd) && $qtd > 0){
                     $_SESSION['carrinho'][$id_produto] = $qtd;
                  }else{
                     unset($_SESSION['carrinho'][$id_produto]);
                  }
               }
            }
         }
       
		 // Modifica a url para remover qualquer uma das ações: add, del ou up, evita que a ação seja
		 // processada novamente caso a página seja recarregada
		 header("location:./carrinho.php");

      }
       
       
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="icon" type="imagem/png" href="imagens/icone.jpg">
<link rel="stylesheet" type="text/css" href="design.css">
<link rel="icon" type="imagem/png" href="imagens/icone.jpg">
<title>Carrinho de compras</title>
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
                    	<input type="text" name="txtbusca" id="txtbusca" placeholder="Buscar..."/>
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
    <br><br><br><br>
    <!-- DIV PRINCIPAL -->
    <center><div class="div_principal"><section>
    <br><br><br>
	<h1 style="color: #300b59">Carrinho de Compras</h1><br>
	<table>
		<table border="1" style="color: #300b59">
		<thead>
			<tr>
				<th class="h_car" width="244">Música</th>
				<th class="h_car"  width="244">Cantor</th>
				<th class="h_car"  width="79">Quantidade</th>
				<th class="h_car"  width="89">Pre&ccedil;o</th>
				<th class="h_car"  width="100">SubTotal</th>
				<th class="h_car"  width="64">Remover</th>
			</tr>
		</thead>
		<form action="?acao=up" method="post">
		
		  
		<tbody>
		   <?php
			if(count($_SESSION['carrinho']) == 0)
			{
				echo '<tr><td colspan="5">N&atilde;o h&aacute; produtos no carrinho</td></tr>';
			}
			else
			{
				require("conexao1.php");
				$total = 0;
				
				foreach($_SESSION['carrinho'] as $id_produto => $qtd)
				{ // Início do FOREACH
					$sql = "SELECT * FROM produto WHERE id_produto=$id_produto AND excluido='n' ORDER BY musica";
					$res = pg_query($conecta, $sql);
					$regs = pg_num_rows($res);
					if($regs>0)
					{
						$linha = pg_fetch_array($res);
						$musica = $linha['musica'];
                        			$cantor = $linha['cantor'];
						$preco = $linha['preco'];
						$sub = $preco * $qtd;
						$total += $sub;
						$preco = number_format($preco, 2, ',', '.');
						$sub = number_format($sub, 2, ',', '.');//formata para padrão brasileiro.
					}

					echo '<tr>    
						 <td>'.$musica.'</td>
                         			 <td>'.$cantor.'</td>
						 <td><input type="text" size="3" name="prod['.$id_produto.']" value="'.$qtd.'" /></td>
						 <td> R$'.$preco.'</td>
						 <td> R$ '.$sub.'</td>
						 <td><a class="remover" href="?acao=del&id_produto='.$id_produto.'">Remover</a></td>
					  	</tr>';
				}// Término do FOREACH
				 
				$total = number_format($total, 2, ',', '.');
				echo '<tr><td colspan="3">Total</td><td> R$ '.$total.'</td></tr>';
			 }//FECHA ELSE
		   ?>
		
		 </tbody>
		 </table>
		 	<br>		
			<input type="submit" value="Atualizar Carrinho" style="font-size: 15px; background-color: transparent; border: 2px solid #5C1B89; border-radius: 4px; padding: 6px; color: #5C1B89"><br><br>
			<a class="prod_btn" style="font-size: 15px; padding: 6px" href="index1.php">Voltar</a><br><br>
			<a class="prod_btn" style="font-size: 15px; padding: 6px" href="finalizacompra.php">Finalizar Compra</a><br>
		</form>
	<br><br><br>
 </section></div></center>
 
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