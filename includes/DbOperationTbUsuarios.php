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
	
	
	function createUsuario($name, $email, $login, $senha, $endereco, $profissao, $tel, $cel, $cpf, $sexo){
		$stmt = $this->con->prepare("INSERT INTO tbUsuarios (cod_usua, name_usua, login_usua, senha_usua, end_usua, profis_usua, email_usua, tel_usua, cel_usua, sexo_usua) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("ssssssiiis", $nome, $email, $login, $senha, $endereco, $profissao, $tel, $cel, $cpf, $sexo);
		if($stmt->execute())
			return true; 			
		return false;
	}
	
	function getUsuarios(){
		$stmt = $this->con->prepare("SELECT cod_usua, nome_usua, login_usua, senha_usua, end_usua, profis_usua, email_usua, tel_usua, cel_usua, cpf_usua, sexo_usua FROM tbUsuarios");
		$stmt->execute();
		$stmt->bind_result($cod, $nome, $login, $senha, $endereco, $profissao, $email, $tel, $cel, $cpf, $sexo);
		
		$usuarios = array(); 
		
		while ($stmt->fetch()) {
        		$usuario = array();
        		$usuario['cod_usua'] = $cod;
        		$usuario['nome_usua'] = $nome;
        		$usuario['login_usua'] = $login;
        		$usuario['senha_usua'] = $senha;
        		$usuario['end_usua'] = $endereco;
        		$usuario['profis_usua'] = $profissao;
        		$usuario['email_usua'] = $email;
        		$usuario['tel_usua'] = $tel;
        		$usuario['cel_usua'] = $cel;
        		$usuario['cpf_usua'] = $cpf;
        		$usuario['sexo_usua'] = $sexo; 
			
			array_push($usuarios, $usuario); 
		}
		
		return $usuarios; 
	}
	
	
	function updateUsuario($cod, $nome, $email, $login, $senha, $endereco, $profissao, $tel, $cel, $cpf, $sexo){
		$stmt = $this->con->prepare("UPDATE tbUsuarios SET nome_usua = ?, 
            login_usua = ?, 
            senha_usua = ?, 
            end_usua = ?, 
            profis_usua = ?, 
            email_usua = ?, 
            tel_usua = ?, 
            cel_usua = ?, 
            cpf_usua = ?, 
            sexo_usua = ?
        WHERE cod_usua = ?");
		$stmt->bind_param("ssssssssssi", $nome, $email, $login, $senha, $endereco, $profissao, $tel, $cel, $cpf, $sexo, $cod);
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
