<?php
 
class DbOperationTbServicos
{
    
    private $con;
 
 
    function __construct()
    {
  
        require_once dirname(__FILE__) . '/DbConnect.php';
 
     
        $db = new DbConnect();
 

        $this->con = $db->connect();
    }
	
	
	function createServico($usuario, $nome, $descricao, $valor, $imagem){
		$stmt = $this->con->prepare("INSERT INTO tbServicos ( cod_usua, nome_serv, desc_serv, valor_serv,
imagem_serv) VALUE(?,?,?,?,?)");
		$stmt->bind_param("issib", $usuario, $nome, $descricao, $valor, $imagem);
		if($stmt->execute())
			return true; 			
		return false;
	}
	
	function getServicos(){
		$stmt = $this->con->prepare("SELECT cod_serv, cod_usua, nome_serv, desc_serv, valor_serv,
imagem_serv FROM tbServicos");
		$stmt->execute();
		$stmt->bind_result($cod, $usuario, $nome, $descricao, $valor, $imagem);
		
		$servicos = array(); 
		
		while($stmt->fetch()){
			$servico  = array();
			$servico['cod_serv'] = $cod; 
			$servico['cod_usua'] = $usuario; 
			$servico['nome_serv'] = $nome; 
			$servico['desc_serv'] = $descricao; 
			$servico['valor_serv'] = $valor;
			$servico['imagem_serv'] = $imagem; 
			
			array_push($servicos, $servico); 
		}
		
		return $servicos; 
	}
	
	
	function updateServico($cod, $usuario, $nome, $descricao, $valor, $imagem){
		$stmt = $this->con->prepare("UPDATE tbServicos SET cod_usua = ?, nome_serv = ?, desc_serv = ?, valor_serv = ?, imagem_serv = ? WHERE cod_serv = ?");
		$stmt->bind_param("issibi", $usuario, $nome, $descricao, $valor, $imagem, $cod);
		if($stmt->execute())
			return true; 
		return false; 
	}
	
	
	function deleteServico($cod){
		$stmt = $this->con->prepare("DELETE FROM tbServicos WHERE cod_serv = ? ");
		$stmt->bind_param("i", $cod);
		if($stmt->execute())
			return true; 
		return false; 
	}
}