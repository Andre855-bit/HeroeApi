<?php 

	require_once '../includes/DbOperationTbLojas.php';

	function isTheseParametersAvailable($params){
	
		$available = true; 
		$missingparams = ""; 
		
		foreach($params as $param){
			if(!isset($_POST[$param]) || strlen($_POST[$param])<=0){
				$available = false; 
				$missingparams = $missingparams . ", " . $param; 
			}
		}
		
		
		if(!$available){
			$response = array(); 
			$response['error'] = true; 
			$response['message'] = 'Parameters ' . substr($missingparams, 1, strlen($missingparams)) . ' missing';
			
		
			echo json_encode($response);
			
		
			die();
		}
	}
	
	
	$response = array();
	

	if(isset($_GET['apicall'])){
		
		switch($_GET['apicall']){
	
			case 'createloja':
				
				isTheseParametersAvailable(array('usuario_loja', 'cnpj_loja', 'nome_loja', 'imagem_loja', 'descricao_loja', 'endereco_loja', 'email_loja', 'tel_loja', 'cel_loja'));
				
				$db = new DbOperationTbLojas();
				
				$result = $db->createLoja(
					$_POST['cod_usua'],
					$_POST['cnpj_cod'],
					$_POST['nome_loja'],
					$_POST['imagem_loja'],
					$_POST['desc_loja'],
					$_POST['end_loja'],
					$_POST['email_loja'],
					$_POST['tel_loja'],
					$_POST['cel_loja']
					
				);
				

			
				if($result){
					
					$response['error'] = false; 

					
					$response['message'] = 'Herói adicionado com sucesso';

					
					$response['lojas'] = $db->getLojas();
				}else{

					
					$response['error'] = true; 

				
					$response['message'] = 'Algum erro ocorreu por favor tente novamente';
				}
				
			break; 
			
		
			case 'getlojas':
				$db = new DbOperationTbLojas();
				$response['error'] = false; 
				$response['message'] = 'Pedido concluído com sucesso';
				$response['lojas'] = $db->getLojas();
			break; 
			
			
		
			case 'updateloja':
				isTheseParametersAvailable(array('cod_loja','usuario_loja', 'cnpj_loja', 'nome_loja', 'imagem_loja', 'descricao_loja', 'endereco_loja', 'email_loja', 'tel_loja', 'cel_loja'));
				$db = new DbOperationTbLojas();
				$result = $db->updateLoja(
					$_POST['cod_loja'],
					$_POST['cod_usua'],
					$_POST['cnpj_cod'],
					$_POST['nome_loja'],
					$_POST['imagem_loja'],
					$_POST['desc_loja'],
					$_POST['end_loja'],
					$_POST['email_loja'],
					$_POST['tel_loja'],
					$_POST['cel_loja']
				);
				
				if($result){
					$response['error'] = false; 
					$response['message'] = 'Herói atualizado com sucesso';
					$response['lojas'] = $db->getLojas();
				}else{
					$response['error'] = true; 
					$response['message'] = 'Algum erro ocorreu por favor tente novamente';
				}
			break; 
			
			
			case 'deleteloja':

				
				if(isset($_GET['cod_loja'])){
					$db = new DbOperationTbLojas();
					if($db->deleteLojas($_GET['cod_loja'])){
						$response['error'] = false; 
						$response['message'] = 'Herói excluído com sucesso';
						$response['lojas'] = $db->getLojas();
					}else{
						$response['error'] = true; 
						$response['message'] = 'Algum erro ocorreu por favor tente novamente';
					}
				}else{
					$response['error'] = true; 
					$response['message'] = 'Não foi possível deletar, forneça um id por favor';
				}
			break; 
		}
		
	}else{
		 
		$response['error'] = true; 
		$response['message'] = 'Chamada de API inválida';
	}
	

	echo json_encode($response);