<?php
session_start();
ob_start();
$btnCadUsuario = filter_input(INPUT_POST,'btnCadUsuario',FILTER_SANITIZE_STRING);
if($btnCadUsuario){
	include_once 'conexao.php';
	//recebe todos os dados do formulário juntos.
	$dados_rc = filter_input_array(INPUT_POST,FILTER_DEFAULT);
	$erro=false;
	
	//retirar simbolos teg e espaços em branco
	$dados_st = array_map('strip_tags',$dados_rc);
	$dados = array_map('trim',$dados_st);
	if(in_array('',$dados)){
		$erro=true;
		$_SESSION['msg']="Necessario digitar todos os campos";
		//senha com mais de 4 digitos
	}elseif((strlen ($dados['senha']))<3){
		$erro=true;
		//verificar senha com  ' ou outro caracter que o usuario queira
		$_SESSION['msg']= "necessario digitar senha com mais de três digitos";
	}elseif (stristr($dados['senha'],"'")){
		
		$erro=true;
		$_SESSION['msg']= "Caracter (') na senha é invalido";
	}else {
		$result_usuario = "SELECT id FROM usuarios WHERE usuario='".$dados['usuario']."'";
		$resultado_usuario= mysqli_query($conn, $result_usuario);
		if(($resultado_usuario) AND ($resultado_usuario->num_rows != 0)){
		$erro =true;
		$_SESSION['msg']= "Este usuário já está sendo utilizado ";
		}
		$result_usuario = "SELECT id FROM usuarios WHERE email='".$dados['email']."'";
		$resultado_usuario= mysqli_query($conn, $result_usuario);
		if(($resultado_usuario) AND ($resultado_usuario->num_rows != 0)){
		$erro =true;
		$_SESSION['msg']= "Este e-mail já está sendo utilizado ";
		}
	}
	 // var_dump($dados);echo '<br>';
	if (!$erro){
		
		// ver dados cravados
   //var_dump($dados);echo '<br>';
	//Criptografar senha e retornar para variavel senha
	$dados ['senha'] = password_hash($dados['senha'],PASSWORD_DEFAULT);
	
	//criar query para salvar no banco
	$result_usuario= "INSERT INTO usuarios (nome, email, usuario, senha)VALUES(
	'".$dados['nome']."',
	'".$dados['email']."',
	'".$dados['usuario']."',
	'".$dados['senha']."'
	
		)";
		//fazendo a conexão
		$resultado_usuario = mysqli_query($conn,$result_usuario);
		if(mysqli_insert_id($conn)) {
			$_SESSION['msgcad']="Cadastrado com sucesso";
			header ("Location: logiin.php");
		}else{
			$_SESSION['msg']="Erro ao cadastrar o usuário";
		}
	}
	
}