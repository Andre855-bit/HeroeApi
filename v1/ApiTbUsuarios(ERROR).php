<?php 

	require_once '../includes/DbOperationTbUsuarios.php';

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
	
			case 'createusuario':
				
				isTheseParametersAvailable(array('nome_usua','login_usua','senha_usua','end_usua','profis_usua','email_usua','tel_usua','cel_usua','cpf_usua','sexo_usua'));
				
				$db = new DbOperationTbUsuarios();
				
				$result = $db->createUsuario(
					$_POST['nome_usua'],
					$_POST['login_usua'],
					$_POST['senha_usua'],
					$_POST['end_usua'],
					$_POST['profis_usua'],
					$_POST['email_usua'],
					$_POST['tel_usua'],
					$_POST['cel_usua'],
					$_POST['cpf_usua'],
					$_POST['sexo_usua']
				);
				

			
				if($result){
					
					$response['error'] = false; 

					
					$response['message'] = 'Usuário adicionado com sucesso';

					
					$response['usuarios'] = $db->getUsuarios();
				}else{

					
					$response['error'] = true; 

				
					$response['message'] = 'Algum erro ocorreu por favor tente novamente';
				}
				
			break; 
			
		
			case 'getusuarios':
				$db = new DbOperationTbUsuarios();
				$response['error'] = false; 
				$response['message'] = 'Pedido concluído com sucesso';
				$response['usuarios'] = $db->getUsuarios();
			break; 
			
			
		
			case 'updateusuarios':
				isTheseParametersAvailable(array('cod_usua','nome_usua','login_usua','senha_usua','end_usua','profis_usua','email_usua','tel_usua','cel_usua','cpf_usua','sexo_usua'));
				$db = new DbOperationTbUsuarios();
				$result = $db->updateUsuario(
					$_POST['nome_usua'],
					$_POST['login_usua'],
					$_POST['senha_usua'],
					$_POST['end_usua'],
					$_POST['profis_usua'],
					$_POST['email_usua'],
					$_POST['tel_usua'],
					$_POST['cel_usua'],
					$_POST['cpf_usua'],
					$_POST['sexo_usua']
				);
				
				if($result){
					$response['error'] = false; 
					$response['message'] = 'Usuário atualizado com sucesso';
					$response['usuarios'] = $db->getUsuarios();
				}else{
					$response['error'] = true; 
					$response['message'] = 'Algum erro ocorreu por favor tente novamente';
				}
			break; 
			
			
			case 'deleteusuario':

				
				if(isset($_GET['cod_usua'])){
					$db = new DbOperationTbUsuarios();
					if($db->deleteUsuario($_GET['cod_usua'])){
						$response['error'] = false; 
						$response['message'] = 'Usuário excluído com sucesso';
						$response['usuarios'] = $db->getUsuarios();
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