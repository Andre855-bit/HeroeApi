<?php
 
class DbOperationTbUsuarios
{
    
    private $con;
 
 
    function __construct()
    {
  
        require_once dirname(__FILE__) . '/DbConnect.php';
 
     
        $db = new DbConnect();
 

        $this->con = $db->connect();
    }
	
	
	function createUsuario($nome, $usuario, $senha, $email, $cel){
		$stmt = $this->con->prepare("INSERT INTO tbUsuarios (cod_usua, nome_usua, usuario_usua, senha_usua, email_usua, cel_usua) VALUES (?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("sssss", $nome, $usuario, $senha, $email, $cel);
		if($stmt->execute())
			return true; 			
		return false;
	}
	
	function getUsuarios(){
		$stmt = $this->con->prepare("SELECT cod_usua, nome_usua, usuario_usua, senha_usua, email_usua, cel_usua FROM tbUsuarios");
		$stmt->execute();
		$stmt->bind_result($cod, $nome, $usuario, $senha, $email, $cel);
		
		$usuarios = array(); 
		
		while ($stmt->fetch()) {
        		$usuario = array();
        		$usuario['cod_usua'] = $cod;
        		$usuario['nome_usua'] = $nome;
        		$usuario['usuario_usua'] = $usuario;
        		$usuario['senha_usua'] = $senha;
        		$usuario['email_usua'] = $email;
        		$usuario['cel_usua'] = $cel;
			
			array_push($usuarios, $usuario); 
		}
		
		return $usuarios; 
	}
	
	
	function updateUsuario($cod, $nome, $usuario, $senha, $email, $cel){
		$stmt = $this->con->prepare("UPDATE tbUsuarios SET
			nome_usua = ?, 
            usuario_usua = ?, 
            senha_usua = ?, 
            email_usua = ?, 
            cel_usua = ?
        WHERE cod_usua = ?");
		$stmt->bind_param("sssssi", $cod, $nome, $usuario, $senha, $email, $cel, $cod);
		if($stmt->execute())
			return true; 
		return false; 
	}
	
	
	function deleteUsuario($cod){
		$stmt = $this->con->prepare("DELETE FROM tbUsuarios WHERE cod_usua = ? ");
		$stmt->bind_param("i", $cod);
		if($stmt->execute())
			return true; 
		return false; 
	}
}
