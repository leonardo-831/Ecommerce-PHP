<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <?php
            include "conexao1.php";
            $nome=$_POST['nome'];
            $endereco=$_POST['endereco'];
            $cep=$_POST['cep'];
            $cpf=$_POST['cpf'];
            $data_nasc=$_POST['data_nasc'];
            $sexo=$_POST['sexo'];
            $email=$_POST['email'];
            $s=$_POST['senha'];
	    $senha=md5($s);
            $tipo=$_POST['tipo'];
            $excluido='n';

            $sql="INSERT INTO cadastro VALUES(default,'$nome', '$endereco', '$cep', '$cpf', '$data_nasc', '$sexo', '$email', '$senha', '$tipo', '$excluido');";
            $valida=pg_query($conecta, "SELECT * FROM cadastro WHERE email='{$email}'");
	    $x = pg_num_rows($valida);
	    if ($x > 0) 
            {
		echo "O email inserido já foi cadastrado, faça login ou cadastre-se com outro email!";
	    }
	    else
	    {
	    	$resultado=pg_query($conecta,$sql);
           	$linhas=pg_affected_rows($resultado);
		if ($linhas > 0)
	    	{
            include "PHPMailer/envia_email.php";
			echo "Cadastro concluído!";
            	}
	    	else
            	{
			echo "Não foi possível fazer o cadastro.";
            	}
	    }
	    pg_close($conecta);
	    
        ?>  
    </body>
</html>