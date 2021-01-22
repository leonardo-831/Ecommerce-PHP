 <!DOCTYPE html>
<html lang="pt-br">
    
    <head>
        <meta charset="UTF-8">
        <title>Enviar</title>
    </head>

    <style> #email{display: hidden;} </style>
    
    <body>
        <div id="email">
            <?php
            
                 session_start();

                use PHPMailer\PHPMailer\PHPMailer;
                use PHPMailer\PHPMailer\Exception;

                require './PHPMailer/src/Exception.php';
                require './PHPMailer/src/PHPMailer.php';
                require './PHPMailer/src/SMTP.php';

                //smtp-mail.outlook.com-->SMTP do outlook
                //smtp.gmail.com-->Google

                $destino= $_POST['email'];
                $msg= "Olá!, obrigado por se cadastrar na nossa loja!!.";
                $mail = new PHPMailer(true);

                try
                {
                    $mail->SMTPDebug=2;
                    $mail->isSMTP();
                    $mail->Host='smtp.gmail.com';
                    $mail->SMTPAuth=true;
                    $mail->Username= 'framefy.equipee@gmail.com';
                    $mail->Password= 'framefy2020';
                    $mail->SMTPSecure='tls';
                    $mail->Port=587;
                    //recepiente
                    $mail->setFrom('framefy.equipee@gmail.com','Equipe framefy- Cadastro');
                    $mail->addAddress($destino);
                    $mail->addReplyTo($destino);
                    //conteudo
                    $mail->isHTML(true);
                    $mail->Subject= 'Cadastro';
                    $mail->Body= $msg;
                    if( $mail->send() ) { $result="Email enviado"; }
                }
                 
                catch(Excemption $e)
                { echo 'Ocorreu um erro:'.$e; }
            ?>

        </div>
        <?php echo $result; ?>
    </body>  
</html>