<?php
namespace App\Config;

/**********************************************************************
 * BANCO DE DADOS
 */

 define('HOST', 'localhost');
 define('USER', 'root');
 define('SENHA', '');
 define('BD', 'mini_loja');
 define('TIPO_BANCO', 'mysql'); 

// define('HOST', 'localhost');
// define('USER', '');
// define('SENHA', '');
// define('BD', '');
// define('TIPO_BANCO', 'mysql');

// DEFINE A URL DO SITE

define("NOME_SITE", "");
define('URL', 'localhost/'.NOME_SITE.'/');



/**********************************************************************
 * DADOS DO SITE 
 */
define('CHAVE_PAGSEGURO', '');
define('CORREIOS_TOKEN', '');

define('SITEDESC', '');
define('FONE', '');
define('CNPJ', '');
define('CELULAR', '');
define('EMAIL', '');
define('EMAIL_PARA_AVISOS', '');
define('SENHA_DO_EMAIL_PARA_AVISOS', '');
define('HOST_DO_EMAIL_PARA_AVISOS', 'smtp.titan.email');
define('NOME_DE_SAIDA_DO_EMAIL_PARA_AVISOS', '');
define('PORTA_DO_EMAIL_PARA_AVISOS', '587');
define('ENDERECO', '');
define('NUMERO', '');
define('CEP', '');
define('CIDADE', '');
define('ESTADO', '');



/**********************************************************************
 * PHPMAILER 
 */
define('EMAIL_PHPMAILER_SECURE', 'tls');
define('EMAIL_PHPMAILER_CHARSET', 'utf-8');
define('EMAIL_PHPMAILER_HOST', '');
define('EMAIL_PHPMAILER_USERNAME', '');
define('EMAIL_PHPMAILER_PASS', '');
define('EMAIL_PHPMAILER_PORT', '');
