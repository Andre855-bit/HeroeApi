<?php 

	require_once '../includes/DbOperationTbServicos.php';

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
	
			case 'createservico':
				
				isTheseParametersAvailable(array('cod_usua', 'nome_serv', 'desc_serv', 'valor_serv',
'imagem_serv'));
				
				$db = new DbOperationTbServicos();
				
				$result = $db->createServico(
					$_POST['cod_usua'],
					$_POST['nome_serv'],
					$_POST['desc_serv'],
					$_POST['valor_serv'],
					$_POST['imagem_serv']
				);
				

			
				if($result){
					
					$response['error'] = false; 

					
					$response['message'] = 'Serviço adicionado com sucesso';

					
					$response['servicos'] = $db->getServicos();
				}else{

					
					$response['error'] = true; 

				
					$response['message'] = 'Algum erro ocorreu por favor tente novamente';
				}
				
			break; 
			
		
			case 'getservicos':
				$db = new DbOperationTbServicos();
				$response['error'] = false; 
				$response['message'] = 'Pedido concluído com sucesso';
				$response['servicos'] = $db->getServicos();
			break; 
			
			
		
			case 'updateservico':
				isTheseParametersAvailable(array('cod_serv','cod_usua', 'nome_serv', 'desc_serv', 'valor_serv',
'imagem_serv'));
				$db = new DbOperationTbServicos();
				$result = $db->updateServico(
					$_POST['cod_serv'],
					$_POST['cod_usua'],
					$_POST['nome_serv'],
					$_POST['desc_serv'],
					$_POST['valor_serv'],
					$_POST['imagem_serv']
				);
				
				if($result){
					$response['error'] = false; 
					$response['message'] = 'Herói atualizado com sucesso';
					$response['servicos'] = $db->getServicos();
				}else{
					$response['error'] = true; 
					$response['message'] = 'Algum erro ocorreu por favor tente novamente';
				}
			break; 
			
			
			case 'deleteservico':

				
				if(isset($_GET['cod_serv'])){
					$db = new DbOperationTbServicos();
					if($db->deleteServico($_GET['id'])){
						$response['error'] = false; 
						$response['message'] = 'Herói excluído com sucesso';
						$response['servicos'] = $db->getServicos();
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