
<?php
require('fpdf.php');

class PDF extends FPDF
{
// Page header
    function Header()
    {
        // Logo
    	$this->Image('imagens/logomarca.jpg',6,13,50);
        // Arial bold 15
        $this->SetFont('Arial','B',17);
        // Move to the right
        $this->Cell(60);
        // Title
        $this->Cell(25,22,'Comprovante de compra');
        // Line break
        $this->Ln(20);
    }

    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(0,10,'Página '.$this->PageNo().'/{nb}',0,0,'C');
    }
}

// Instanciation of inherited class

                    session_start();
                    $email=$_SESSION['usuario'];
                    include "conexao1.php";
                    
                    $pdf = new PDF();
                    $pdf->AliasNbPages();
                    $pdf->AddPage();
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
                    $pdf->SetFont('Arial','',12);
                    //ok
                    $pdf->Cell(0,7," Cliente: ".$email,0,1);
                    for($i=1;$i<=$maior;$i++)
                    {
                        if(isset($_SESSION['carrinho'][$i]))
                        {
                            $sql="SELECT * FROM produto where id_produto=$i AND excluido='n';";
                            
                            $resultado=pg_query($conecta,$sql);
                            $linhas=pg_num_rows($resultado);
                            if($linhas>0)
                            {
                                //////
                                $linha=pg_fetch_array($resultado);
                                $musica=$linha['musica'];
                                $cantor=$linha['cantor'];
                                ///////
                                $pdf->Cell(60);
                                $pdf->Cell(0,7,$musica." - ".$cantor,0,1);
                                $preco= number_format($linha['preco'], 2, ',', '.');
                                $pdf->Cell(60);
                                $quant=$_SESSION['carrinho'][$i];
                                $pdf->Cell(0,10,"Preço: R$ ".$preco."......".$quant."x   ",0,1);
                                $preco=$linha['preco'];
                                
                                $mult=$preco*$quant;
                                $total+=$mult;
                            }
                        }
                    }
                    $total= number_format($total, 2, ',', '.');
                    $pdf->Cell(60);
                    $pdf->Cell(0,15,"Total: R$".$total,0,1);
                    $pdf->Output();
                    unset($_SESSION['carrinho']);
?>
