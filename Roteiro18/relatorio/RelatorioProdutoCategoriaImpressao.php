<?php

	require_once("./mpdf/mpdf.php");
	require_once '../class/CategoriaDAO.php';
	require_once '../class/ProdutoDAO.php';

	$mpdf = new mPDF();
	$mpdf->SetDisplayMode("fullpage");


	$categoriaDAO = new CategoriaDAO();
	$listaCategoria = $categoriaDAO->listar();	

	$produtoDAO = new ProdutoDAO();
	$listaProduto = $produtoDAO->listar();	
		
	
	$html = "<div id='area01'>
				<img class='figura' src='imagens/logo.jpg'>
			</div>	
			<div id='area02'>	
				<h1 class='titulo'>Estoque por Categoria</h1>
			</div>	
			
			";

	$html = $html . "<div id='area03'> <hr>";

	foreach($listaCategoria as $categoria){

		$html = $html ."
					<label class='negrito'>Categoria:</label>
					<label>{$categoria->getDescricao()}</label>

					<hr>
					<table class='tabela'>
						<thead>
							<tr>
								<th width='60%'>Produto</th>
								<th width='7%'>Quant.</th>								
								<th width='15%'>Valor</th>
								<th width='18%'>SubTotal </th>
							</tr>
						</thead>
						<tbody>";
		
		$somaCategoria = 0;

		foreach($listaProduto as $produto){
			if($categoria->getIdCategoria() == $produto->getCategoria()->getIdCategoria()){
				$html = $html . "<tr>";								
				$html = $html .	"<td>{$produto->getNome()}</td>";
				$html = $html . "<td class='centralizar'>{$produto->getQuantidade()}</td>";				
				$html = $html .	"<td>R$ ".number_format($produto->getValor(), 2, ',', '.')."</td>";
				$subTotal = $produto->getQuantidade() * $produto->getValor();
				$html = $html .	"<td>R$ ".number_format($subTotal, 2, ',', '.')."</td>";
				$html = $html . "</tr>";	

				$somaCategoria = $somaCategoria +  $subTotal;
			}
		}	
						
		$html = $html . "</tbody>";

		$html = $html . "<tfoot>
							<tr>
								<td></td>
								<td></td>
								<td class='direita negrito'>Total</td>
								<td class='negrito'>R$ ".number_format($somaCategoria, 2, ',', '.')."</td>
							</tr>
						</tfoot>";

		$html = $html . "</table> </div> <hr>";

	
	}

	$dataEmissao = date("d/m/Y H:i:s");
	
	$css = file_get_contents('css/RelatorioProdutoCategoriaImpressao.css');
	
	$mpdf->WriteHTML($css, 1);		
	$mpdf->SetHeader("Programação para Web |  | Emissão: {$dataEmissao}");
	$mpdf->setFooter("{PAGENO} de {nb}"); 
	$mpdf->WriteHTML($html, 2);
	
	$mpdf->Output('RelatorioProdutoCategoriaImpressao.pdf',I);

	exit();
	
?>
