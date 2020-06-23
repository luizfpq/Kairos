<?php
/*
* Classe para upload de arquivos simples.
* @autor Vinícius Lourenço
* @since 13/08/2012
* @version 0.1
* http://blog.vilourenco.com.br
*/
class Upload {

	// Constante responsável por guardar a pasta de onde os arquivos estarão.
	const _FOLDER_DIR = "/app/upload/";

	// Variável para guardar o array relacionado ao arquivo.
	public $_file;

	// Método construtor que recebe o array com os arquivos via POST
	// Verifica se já existe diretório, caso não; é criado.
	function __construct($curFile){
		if(!file_exists(self::_FOLDER_DIR)){
			mkdir(self::_FOLDER_DIR);
		}
		$this->_file = $curFile;
	}

	//Metódo para:
	//Verificar se existe arquivo;
	//Setar nome aleatório para evitar repetição e substiuição de arquivos;
	//Cria nome de arquivo concatenando DIRETÓRIO + NOME ALEATÓRIO + NOME DO ARQUIVO ENVIADO.
	//Verifica se o arquivo foi realizado o upload
	//Move o arquivo para o diretório escolhido, inserido na concatenação realizada.
	//Retorna true em casos de upload com sucesso e false com erro.
	function makeUpload(){
		if(isset($this->_file)){
			$randomName = md5(rand(00,9999999));
			$fileName = self::_FOLDER_DIR . "_" . $randomName . "_" . trim($this->_file["name"]);
			if(is_uploaded_file($this->_file["tmp_name"])){
				if(move_uploaded_file($this->_file["tmp_name"], $fileName)){
					return "_" . $randomName . "_" . trim($this->_file["name"]);
				}else{
					return false;
				}
			}
		}
	}
}
?>
