<?php
 
class DbOperationTbLojas
{
    
    private $con;
 
 
    function __construct()
    {
  
        require_once dirname(__FILE__) . '/DbConnect.php';
 
     
        $db = new DbConnect();
 

        $this->con = $db->connect();
    }
	
	
	function createLoja($usuario, $cnpj, $nome, $imagem, $descricao, $endereco, $email, $tel, $cel){
		$stmt = $this->con->prepare("INSERT INTO tbLoja( cod_usua, cnpj_loja, nome_loja, imagem_loja, desc_loja, end_loja,
email_loja, cel_loja, tel_loja) VALUE (?,?,?,?,?,?,?,?,?,?)");
		$stmt->bind_param("issssssss", $usuario, $cnpj, $nome, $imagem, $descricao, $endereco, $email, $tel, $cel);
		if($stmt->execute())
			return true; 			
		return false;
	}
	
	function getLojas(){
		$stmt = $this->con->prepare("SELECT cod_loja, cod_usua, cnpj_loja, nome_loja, imagem_loja, desc_loja, end_loja,
email_loja, cel_loja, tel_loja FROM tbLojas");
		$stmt->execute();
		$stmt->bind_result($cod, $usuario, $cnpj, $nome, $imagem, $descricao, $endereco, $email, $tel, $cel);
		
		$lojas = array(); 
		
		while($stmt->fetch()){
			$loja['cod_loja'] = $cod;
        	$loja['cod_usua'] = $usuario;
        	$loja['cnpj_loja'] = $cnpj;
        	$loja['nome_loja'] = $nome;
        	$loja['imagem_loja'] = $imagem;
        	$loja['desc_loja'] = $descricao;
        	$loja['end_loja'] = $endereco;
        	$loja['email_loja'] = $email;
        	$loja['tel_loja'] = $tel;
        	$loja['cel_loja'] = $cel; 
			
			array_push($lojas, $loja); 
		}
		
		return $lojas; 
	}
	
	
	function updateLoja($cod, $usuario, $cnpj, $nome, $imagem, $descricao, $endereco, $email, $tel, $cel){
		$stmt = $this->con->prepare("UPDATE tbLojas SET cnpj_loja = ?, cnpj_loja = ?, nome_loja = ?, imagem_loja = ?, desc_loja = ?, end_loja = ?, email_loja = ?, tel_loja = ?, cel_loja = ? WHERE cod_loja = ?");
		$stmt->bind_param("issssssssi", $usuario, $cnpj, $nome, $imagem, $descricao, $endereco, $email, $tel, $cel, $cod);
		if($stmt->execute())
			return true; 
		return false; 
	}
	
	
	function deleteLoja($cod){
		$stmt = $this->con->prepare("DELETE FROM tbLojas WHERE cod_loja = ? ");
		$stmt->bind_param("i", $cod);
		if($stmt->execute())
			return true; 
		return false; 
	}
}