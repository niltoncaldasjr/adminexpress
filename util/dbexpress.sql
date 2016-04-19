-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           5.6.15 - MySQL Community Server (GPL)
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Copiando estrutura do banco de dados para dbexpress
CREATE DATABASE IF NOT EXISTS `dbexpress` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `dbexpress`;


-- Copiando estrutura para tabela dbexpress.banco
CREATE TABLE IF NOT EXISTS `banco` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) DEFAULT NULL,
  `febran` varchar(4) DEFAULT NULL,
  `datacadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dataedicao` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela dbexpress.banco: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `banco` DISABLE KEYS */;
INSERT INTO `banco` (`id`, `descricao`, `febran`, `datacadastro`, `dataedicao`) VALUES
	(2, 'Banco do Brasil', '001', '2016-03-11 18:59:36', NULL);
/*!40000 ALTER TABLE `banco` ENABLE KEYS */;


-- Copiando estrutura para tabela dbexpress.certidao
CREATE TABLE IF NOT EXISTS `certidao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) NOT NULL,
  `prazo` int(11) NOT NULL,
  `valor` float NOT NULL,
  `datacadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dataedicao` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela dbexpress.certidao: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `certidao` DISABLE KEYS */;
INSERT INTO `certidao` (`id`, `descricao`, `prazo`, `valor`, `datacadastro`, `dataedicao`) VALUES
	(1, 'ITBI', 2, 500, '2016-04-07 16:44:59', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `certidao` ENABLE KEYS */;


-- Copiando estrutura para tabela dbexpress.checklist
CREATE TABLE IF NOT EXISTS `checklist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idservico` int(11) NOT NULL DEFAULT '0',
  `ordem` int(11) NOT NULL DEFAULT '0',
  `item` varchar(100) NOT NULL DEFAULT '0',
  `datacadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dataedicao` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `FK_checklist_servico` (`idservico`),
  CONSTRAINT `FK_checklist_servico` FOREIGN KEY (`idservico`) REFERENCES `servico` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela dbexpress.checklist: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `checklist` DISABLE KEYS */;
INSERT INTO `checklist` (`id`, `idservico`, `ordem`, `item`, `datacadastro`, `dataedicao`) VALUES
	(1, 1, 1, 'teste 1', '2016-04-07 16:46:00', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `checklist` ENABLE KEYS */;


-- Copiando estrutura para tabela dbexpress.contabanco
CREATE TABLE IF NOT EXISTS `contabanco` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `agencia` varchar(10) DEFAULT NULL,
  `digitoAgencia` char(1) DEFAULT NULL,
  `numeroConta` varchar(10) DEFAULT NULL,
  `digitoConta` char(1) DEFAULT NULL,
  `numeroCarteira` varchar(10) DEFAULT NULL,
  `numeroConvenio` varchar(10) DEFAULT NULL,
  `nomeContato` varchar(70) DEFAULT NULL,
  `telefoneContato` varchar(30) DEFAULT NULL,
  `endereco` varchar(70) DEFAULT NULL,
  `idbanco` int(11) DEFAULT NULL,
  `datacadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dataedicao` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idbanco` (`idbanco`),
  CONSTRAINT `contabanco_ibfk_1` FOREIGN KEY (`idbanco`) REFERENCES `banco` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela dbexpress.contabanco: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `contabanco` DISABLE KEYS */;
INSERT INTO `contabanco` (`id`, `agencia`, `digitoAgencia`, `numeroConta`, `digitoConta`, `numeroCarteira`, `numeroConvenio`, `nomeContato`, `telefoneContato`, `endereco`, `idbanco`, `datacadastro`, `dataedicao`) VALUES
	(1, '1231', '2', '322', '5', '01010', '010101', 'Julio', '9928929', 'RUA DOS ANDRADAS', 2, '2016-03-21 10:17:03', NULL);
/*!40000 ALTER TABLE `contabanco` ENABLE KEYS */;


-- Copiando estrutura para tabela dbexpress.grupo
CREATE TABLE IF NOT EXISTS `grupo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) DEFAULT NULL,
  `tipo` enum('PF','PJ','AMBOS') DEFAULT NULL,
  `datacadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dataedicao` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela dbexpress.grupo: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `grupo` DISABLE KEYS */;
INSERT INTO `grupo` (`id`, `descricao`, `tipo`, `datacadastro`, `dataedicao`) VALUES
	(1, 'orgaos', 'PJ', '2016-03-30 13:08:36', NULL),
	(2, 'corretores', 'PF', '2016-04-08 17:27:01', NULL),
	(3, 'cartorio', 'PJ', '2016-04-08 17:36:23', NULL),
	(4, 'cliente', 'AMBOS', '2016-04-08 17:37:39', NULL);
/*!40000 ALTER TABLE `grupo` ENABLE KEYS */;


-- Copiando estrutura para tabela dbexpress.grupopessoa
CREATE TABLE IF NOT EXISTS `grupopessoa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idgrupo` int(11) DEFAULT NULL,
  `idpessoa` int(11) DEFAULT NULL,
  `informacao` text,
  `datacadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dataedicao` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idgrupo` (`idgrupo`),
  KEY `idpessoa` (`idpessoa`),
  CONSTRAINT `grupopessoa_ibfk_1` FOREIGN KEY (`idgrupo`) REFERENCES `grupo` (`id`),
  CONSTRAINT `grupopessoa_ibfk_2` FOREIGN KEY (`idpessoa`) REFERENCES `pessoa` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela dbexpress.grupopessoa: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `grupopessoa` DISABLE KEYS */;
INSERT INTO `grupopessoa` (`id`, `idgrupo`, `idpessoa`, `informacao`, `datacadastro`, `dataedicao`) VALUES
	(1, 1, 1, 'dsdadad', '2016-04-05 19:30:24', '2016-04-08 00:00:00'),
	(2, 1, 3, 'sadadad', '2016-04-05 19:44:47', '2016-04-08 00:00:00'),
	(3, 1, 5, 'FSFSFSFSFS', '2016-04-09 10:22:36', NULL);
/*!40000 ALTER TABLE `grupopessoa` ENABLE KEYS */;


-- Copiando estrutura para tabela dbexpress.honorario
CREATE TABLE IF NOT EXISTS `honorario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idservico` int(11) NOT NULL DEFAULT '0',
  `valor` decimal(10,2) NOT NULL DEFAULT '0.00',
  `datacadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dataedicao` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `FK__servico` (`idservico`),
  CONSTRAINT `FK__servico` FOREIGN KEY (`idservico`) REFERENCES `servico` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela dbexpress.honorario: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `honorario` DISABLE KEYS */;
INSERT INTO `honorario` (`id`, `idservico`, `valor`, `datacadastro`, `dataedicao`) VALUES
	(1, 1, 350.00, '2016-04-07 16:44:28', '0000-00-00 00:00:00'),
	(2, 4, 1200.00, '2016-04-09 09:37:06', '2016-04-09 15:37:37'),
	(3, 3, 1200.50, '2016-04-09 09:38:16', '2016-04-09 15:38:37');
/*!40000 ALTER TABLE `honorario` ENABLE KEYS */;


-- Copiando estrutura para tabela dbexpress.indicacao
CREATE TABLE IF NOT EXISTS `indicacao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(70) DEFAULT NULL,
  `cep` varchar(10) DEFAULT NULL,
  `endereco` varchar(150) DEFAULT NULL,
  `numero` varchar(20) DEFAULT NULL,
  `complemento` varchar(100) DEFAULT NULL,
  `bairro` varchar(100) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `uf` varchar(100) DEFAULT NULL,
  `telefone` varchar(30) DEFAULT NULL,
  `email1` varchar(150) DEFAULT NULL,
  `email2` varchar(150) DEFAULT NULL,
  `celular1` varchar(30) DEFAULT NULL,
  `celular2` varchar(30) DEFAULT NULL,
  `atividade` varchar(150) DEFAULT NULL,
  `observacao` text,
  `senhaweb` varchar(50) DEFAULT NULL,
  `datacadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dataedicao` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela dbexpress.indicacao: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `indicacao` DISABLE KEYS */;
INSERT INTO `indicacao` (`id`, `nome`, `cep`, `endereco`, `numero`, `complemento`, `bairro`, `cidade`, `uf`, `telefone`, `email1`, `email2`, `celular1`, `celular2`, `atividade`, `observacao`, `senhaweb`, `datacadastro`, `dataedicao`) VALUES
	(1, 'Adelson Gomes', '69058030', 'Av. Prof. Nilton Lins 877 - T. Barc - Ap 803', '5435', 'fsfsfsf', 'Flores', 'Manaus', 'AM', '9233032718', 'niltonbox@gmail.com', 'niltonbox@gmail.com', '92968686', '868686868', 'Corretor', 'sdadad', '123', '2016-03-22 15:24:12', NULL),
	(2, 'Fl�vio Costa', '8080', 'mggg', '909', 'kjhkhkh', 'kbkjhkj', 'kjhkh', 'kjhk', '980808', 'khkhkk', 'kjhkjh', '098098', '080980', 'Amigo', 'm,mn,', '31', '2016-03-22 15:25:04', NULL);
/*!40000 ALTER TABLE `indicacao` ENABLE KEYS */;


-- Copiando estrutura para tabela dbexpress.menu
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `href` varchar(50) NOT NULL,
  `arrow` varchar(50) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `sub` int(11) NOT NULL,
  `class` varchar(50) DEFAULT NULL,
  `datacadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dataedicao` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela dbexpress.menu: ~29 rows (aproximadamente)
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` (`id`, `nome`, `href`, `arrow`, `icon`, `sub`, `class`, `datacadastro`, `dataedicao`) VALUES
	(1, 'CADASTROSGERAIS', 'cadastro', 'fa arrow', 'fa fa-table', 0, 'NULL', '2016-03-08 10:08:07', NULL),
	(2, 'AUTENTICACAO', 'auth', 'fa arrow', 'fa fa-lock', 0, 'NULL', '2016-03-08 10:14:05', NULL),
	(3, 'CADASTROSADMINISTRATIVOS', 'admin', 'fa arrow', 'fa fa-suitcase', 0, NULL, '2016-03-08 10:14:53', NULL),
	(4, 'UTILITARIOS', 'util', 'fa arrow', 'fa fa-cog', 0, NULL, '2016-03-08 10:16:07', NULL),
	(5, 'SERVICOS', 'cadastro/servico', '', '', 4, NULL, '2016-03-08 14:45:05', NULL),
	(6, 'STATUSPROCESSO', 'cadastro/statusprocesso', '', '', 4, NULL, '2016-03-08 14:46:42', NULL),
	(7, 'INDICACOES', 'cadastro/indicacoes', '', '', 4, NULL, '2016-03-08 14:47:13', NULL),
	(8, 'CORRETORES', 'cadastro/corretores', '', '', 1, NULL, '2016-03-08 14:47:38', NULL),
	(9, 'BANCOAGENCIA', 'cadastro/banco', '', '', 4, NULL, '2016-03-08 14:48:24', NULL),
	(10, 'CARTORIO', 'cadastro/cartorio', '', '', 1, NULL, '2016-03-08 14:48:48', NULL),
	(11, 'ORGAOS', 'cadastro/orgaos', '', '', 1, NULL, '2016-03-08 14:49:12', NULL),
	(12, 'CERTIDOES', 'cadastro/certidoes', '', '', 1, NULL, '2016-03-08 14:49:47', NULL),
	(13, 'CLIENTE', 'admin/cliente', '', '', 1, NULL, '2016-03-08 14:50:49', NULL),
	(15, 'PROCESSO', 'admin/processo', '', '', 1, NULL, '2016-03-08 14:51:13', NULL),
	(16, 'ANDAMENTODOPROCESSO', 'admin/andamento', '', '', 1, NULL, '2016-03-08 14:51:30', NULL),
	(17, 'CONTACORRENTE', 'admin/contacorrente', '', '', 1, NULL, '2016-03-08 14:51:55', NULL),
	(18, 'CLIENTEEMPOTENCIAL', 'admin/clienteempotencial', '', '', 1, NULL, '2016-03-08 14:52:13', NULL),
	(19, 'PEDIDODECERTIDAO', 'admin/pedidodecertidao', '', '', 1, NULL, '2016-03-08 14:52:29', NULL),
	(20, 'USUARIO', 'auth/usuario', '', '', 2, NULL, '2016-03-08 14:55:19', NULL),
	(21, 'PERFIL', 'auth/perfil', '', '', 2, NULL, '2016-03-08 14:55:24', NULL),
	(22, 'MENU', 'auth/menu', '', '', 3, NULL, '2016-03-08 14:55:31', NULL),
	(23, 'PERMISSOES', 'auth/permissoes', '', '', 3, NULL, '2016-03-08 14:55:39', NULL),
	(24, 'ARQUIVOVIRTUAL', 'util/arquivovirtual', '', '', 4, NULL, '2016-03-08 14:57:37', NULL),
	(25, 'BOLETO', 'util/boleto', '', '', 4, NULL, '2016-03-08 14:57:42', NULL),
	(26, 'PARAMETROSDOSISTEMA', 'util/parametrodosistema', '', '', 4, NULL, '2016-03-08 14:57:56', NULL),
	(27, 'RELATORIOS', 'relatorio', 'fa arrow', 'fa fa-copy', 0, NULL, '2016-03-08 14:59:40', NULL),
	(28, 'PROCESSOS', 'relatorio/processo', '', '', 27, NULL, '2016-03-08 14:59:55', NULL),
	(29, 'CONTACORRENTE', 'relatorio/contacorrente', '', '', 27, NULL, '2016-03-08 15:00:06', NULL),
	(30, 'HONORARIO', 'cadastro/honorario', '', '', 4, NULL, '2015-04-05 19:50:38', NULL),
	(31, 'CERTIDOES', 'cadastro/certidoes', '', '', 4, NULL, '2016-04-05 19:51:26', NULL),
	(32, 'CHECKLIST', 'cadastro/checklist', '', '', 4, NULL, '2016-04-05 19:52:34', NULL);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;


-- Copiando estrutura para tabela dbexpress.perfil
CREATE TABLE IF NOT EXISTS `perfil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `ativo` int(11) NOT NULL,
  `datacadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dataedicao` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela dbexpress.perfil: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `perfil` DISABLE KEYS */;
INSERT INTO `perfil` (`id`, `nome`, `ativo`, `datacadastro`, `dataedicao`) VALUES
	(1, 'Administrador', 0, '2016-03-08 13:15:13', '2016-03-08 13:15:11'),
	(2, 'Visitante', 0, '2016-04-09 10:07:56', NULL);
/*!40000 ALTER TABLE `perfil` ENABLE KEYS */;


-- Copiando estrutura para tabela dbexpress.permissoes
CREATE TABLE IF NOT EXISTS `permissoes` (
  `id_menu` int(11) NOT NULL,
  `id_perfil` int(11) NOT NULL,
  KEY `fk_permissao_perfil` (`id_perfil`),
  KEY `fk_permissao_menu` (`id_menu`),
  CONSTRAINT `fk_permissao_menu` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id`),
  CONSTRAINT `fk_permissao_perfil` FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela dbexpress.permissoes: ~29 rows (aproximadamente)
/*!40000 ALTER TABLE `permissoes` DISABLE KEYS */;
INSERT INTO `permissoes` (`id_menu`, `id_perfil`) VALUES
	(1, 1),
	(2, 1),
	(3, 1),
	(4, 1),
	(5, 1),
	(6, 1),
	(7, 1),
	(8, 1),
	(9, 1),
	(10, 1),
	(11, 1),
	(12, 1),
	(13, 1),
	(15, 1),
	(16, 1),
	(17, 1),
	(18, 1),
	(19, 1),
	(20, 1),
	(21, 1),
	(22, 1),
	(23, 1),
	(24, 1),
	(25, 1),
	(26, 1),
	(27, 1),
	(28, 1),
	(29, 1),
	(30, 1),
	(31, 1),
	(32, 1),
	(4, 2),
	(30, 2),
	(31, 2),
	(32, 2);
/*!40000 ALTER TABLE `permissoes` ENABLE KEYS */;


-- Copiando estrutura para tabela dbexpress.pessoa
CREATE TABLE IF NOT EXISTS `pessoa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` enum('PF','PJ') CHARACTER SET utf8 DEFAULT NULL,
  `CEP` varchar(9) CHARACTER SET utf8 DEFAULT NULL,
  `endereco` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `numero` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `complemento` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `bairro` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `telefone` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `fax` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `celular` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `email1` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `email2` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `site` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `datacadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dataedicao` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela dbexpress.pessoa: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `pessoa` DISABLE KEYS */;
INSERT INTO `pessoa` (`id`, `tipo`, `CEP`, `endereco`, `numero`, `complemento`, `bairro`, `telefone`, `fax`, `celular`, `email1`, `email2`, `site`, `datacadastro`, `dataedicao`) VALUES
	(1, 'PJ', '69058030', 'Teste', 'Teste', '111', 'Teste', 'Centro', '575757', '778778', '', 'nkn,m,mn@kjlk', 'nkn,m,mn@kjlk', '2016-04-05 19:30:24', '2016-04-09 00:00:00'),
	(2, 'PF', '69058030', 'AV. PROFESSOR NILTON LINS', '877', 'EM FRENTE AO AEROCLUBE', 'FLORES', '981440856', '1111', '1111', 'niltonbox@gmail.com', 'niltoncaldasjr@hotmail.com', 'www.akto.com', '2016-04-05 19:30:24', '2016-04-09 00:00:00'),
	(3, 'PJ', '9879797', 'khkjhk', 'khkjhk', '78979', 'kjhkjhk', 'kjjkhgkh', '09808', '0980980', '', 'khkjhkhk', 'ljljljlj', '2016-04-05 19:44:47', '2016-04-08 00:00:00'),
	(4, 'PF', '42424', 'fsfsf', 'fsfsf', '442', 'safsfs', 'fafsf', '4224', '2424', '', 'fsfsfsf', 'afafa', '2016-04-05 19:44:47', '2016-04-08 00:00:00'),
	(5, 'PJ', '656', 'GFXGVXV', '434', 'CZCZC', 'XCZCZC', '42432', '42424', '2424', 'XVXVX', 'XCVX', 'VXV', '2016-04-09 10:22:36', '2016-04-09 00:00:00'),
	(6, 'PF', '69058030', 'AV. PROFESSOR NILTON LINS', '877', 'EM FRENTE AO AEROCLUBE', 'FLORES', '981440856', '1111', '1111', 'niltonbox@gmail.com', 'niltoncaldasjr@hotmail.com', 'www.akto.com', '2016-04-09 10:22:36', '2016-04-09 00:00:00');
/*!40000 ALTER TABLE `pessoa` ENABLE KEYS */;


-- Copiando estrutura para tabela dbexpress.pessoafisica
CREATE TABLE IF NOT EXISTS `pessoafisica` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idpessoa` int(11) DEFAULT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `cpf` varchar(15) DEFAULT NULL,
  `nacionalidade` varchar(100) DEFAULT NULL,
  `naturalidade` varchar(100) DEFAULT NULL,
  `datanascimento` timestamp NULL DEFAULT NULL,
  `estadocivil` enum('SOLTEIRO','CASADO','VIUVO','DIVORCIADO') DEFAULT NULL,
  `nomeconjuge` varchar(100) DEFAULT NULL,
  `idprofissao` int(11) DEFAULT NULL,
  `tipodoc` enum('RG',' CNH',' OAB',' OUTROS') DEFAULT NULL,
  `numerodoc` varchar(30) DEFAULT NULL,
  `orgaodoc` varchar(60) DEFAULT NULL,
  `dataemissaodoc` timestamp NULL DEFAULT NULL,
  `pai` varchar(100) DEFAULT NULL,
  `mae` varchar(100) DEFAULT NULL,
  `sexo` enum('MASCULINO','FEMININO') DEFAULT NULL,
  `datacadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dataedicao` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idpessoa` (`idpessoa`),
  KEY `idprofissao` (`idprofissao`),
  CONSTRAINT `pessoafisica_ibfk_1` FOREIGN KEY (`idpessoa`) REFERENCES `pessoa` (`id`),
  CONSTRAINT `pessoafisica_ibfk_2` FOREIGN KEY (`idprofissao`) REFERENCES `profissao` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela dbexpress.pessoafisica: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `pessoafisica` DISABLE KEYS */;
INSERT INTO `pessoafisica` (`id`, `idpessoa`, `nome`, `cpf`, `nacionalidade`, `naturalidade`, `datanascimento`, `estadocivil`, `nomeconjuge`, `idprofissao`, `tipodoc`, `numerodoc`, `orgaodoc`, `dataemissaodoc`, `pai`, `mae`, `sexo`, `datacadastro`, `dataedicao`) VALUES
	(1, 2, 'Nilton Caldas Junior', '33708118200', 'Brasileiro', 'Manausw', '2006-01-02 00:00:00', 'CASADO', 'TATIANA CALDAS', 1, 'RG', '3131', '313132', '2016-04-11 00:00:00', 'NILTON CALDAS', 'MARIA LUCIA', 'MASCULINO', '2016-04-05 19:30:24', '2016-04-09 00:00:00'),
	(3, 6, 'Nilton Caldas Junior', '33708118200', 'Brasileiro', 'Manausw', '2006-01-17 00:00:00', 'CASADO', 'TATIANA CALDAS', 1, 'RG', '3131', '313132', '2016-02-08 00:00:00', 'NILTON CALDAS', 'MARIA LUCIA', 'MASCULINO', '2016-04-09 10:22:36', NULL);
/*!40000 ALTER TABLE `pessoafisica` ENABLE KEYS */;


-- Copiando estrutura para tabela dbexpress.pessoajuridica
CREATE TABLE IF NOT EXISTS `pessoajuridica` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idpessoa` int(11) DEFAULT NULL,
  `razao` varchar(100) DEFAULT NULL,
  `cnpj` varchar(18) CHARACTER SET latin1 DEFAULT NULL,
  `nire` varchar(15) DEFAULT NULL,
  `inscestadual` varchar(15) DEFAULT NULL,
  `inscmunicipal` varchar(15) DEFAULT NULL,
  `representante` varchar(100) DEFAULT NULL,
  `datacadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dataedicao` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idpessoa` (`idpessoa`),
  CONSTRAINT `pessoajuridica_ibfk_1` FOREIGN KEY (`idpessoa`) REFERENCES `pessoa` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela dbexpress.pessoajuridica: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `pessoajuridica` DISABLE KEYS */;
INSERT INTO `pessoajuridica` (`id`, `idpessoa`, `razao`, `cnpj`, `nire`, `inscestadual`, `inscmunicipal`, `representante`, `datacadastro`, `dataedicao`) VALUES
	(1, 1, 'SEMEF', '11111111', '1111', '11111', '11111', '', '2016-04-05 19:30:24', '2016-04-09 00:00:00'),
	(2, 3, 'SEMOSB', '798798', '98779', '79879', '79879', '', '2016-04-05 19:44:47', '2016-04-08 00:00:00'),
	(3, 5, 'TRIBUNAL', '33333', '3333', '333', '333', '', '2016-04-09 10:22:36', '2016-04-09 00:00:00');
/*!40000 ALTER TABLE `pessoajuridica` ENABLE KEYS */;


-- Copiando estrutura para tabela dbexpress.profissao
CREATE TABLE IF NOT EXISTS `profissao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) DEFAULT NULL,
  `datacadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dataedicao` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela dbexpress.profissao: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `profissao` DISABLE KEYS */;
INSERT INTO `profissao` (`id`, `descricao`, `datacadastro`, `dataedicao`) VALUES
	(1, 'Desenvolvedor', '2016-04-01 18:47:21', NULL),
	(2, 'Pedreiro', '2016-04-01 18:47:27', NULL);
/*!40000 ALTER TABLE `profissao` ENABLE KEYS */;


-- Copiando estrutura para tabela dbexpress.representantepj
CREATE TABLE IF NOT EXISTS `representantepj` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idpessoapj` int(11) DEFAULT NULL,
  `idpessoapf` int(11) DEFAULT NULL,
  `funcao` enum('Presidente','Sócio','Gerente') DEFAULT NULL,
  `representante` enum('SIM','NAO') DEFAULT NULL,
  `datacadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dataedicao` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idpessopj` (`idpessoapj`),
  KEY `idpessoapf` (`idpessoapf`),
  CONSTRAINT `representantepj_ibfk_1` FOREIGN KEY (`idpessoapj`) REFERENCES `pessoa` (`id`),
  CONSTRAINT `representantepj_ibfk_2` FOREIGN KEY (`idpessoapf`) REFERENCES `pessoa` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela dbexpress.representantepj: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `representantepj` DISABLE KEYS */;
INSERT INTO `representantepj` (`id`, `idpessoapj`, `idpessoapf`, `funcao`, `representante`, `datacadastro`, `dataedicao`) VALUES
	(1, 1, 2, 'Presidente', 'SIM', '2016-04-05 19:30:24', '2016-04-09 00:00:00'),
	(2, 3, 4, 'Presidente', 'SIM', '2016-04-05 19:44:47', '2016-04-08 00:00:00'),
	(4, 5, 6, 'Sócio', 'SIM', '2016-04-09 10:22:36', NULL);
/*!40000 ALTER TABLE `representantepj` ENABLE KEYS */;


-- Copiando estrutura para tabela dbexpress.servico
CREATE TABLE IF NOT EXISTS `servico` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  `datacadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dataedicao` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela dbexpress.servico: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `servico` DISABLE KEYS */;
INSERT INTO `servico` (`id`, `nome`, `datacadastro`, `dataedicao`) VALUES
	(1, 'Crendenciamento', '2016-03-21 10:14:54', NULL),
	(2, 'Certidões', '2016-03-22 15:20:49', '2016-04-09 00:00:00'),
	(3, 'Usucapião', '2016-04-09 09:35:36', NULL),
	(4, 'Retificação de Area', '2016-04-09 09:36:06', NULL);
/*!40000 ALTER TABLE `servico` ENABLE KEYS */;


-- Copiando estrutura para tabela dbexpress.statusprocesso
CREATE TABLE IF NOT EXISTS `statusprocesso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  `web` enum('SIM',' NAO') DEFAULT NULL,
  `datacadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dataedicao` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela dbexpress.statusprocesso: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `statusprocesso` DISABLE KEYS */;
INSERT INTO `statusprocesso` (`id`, `nome`, `web`, `datacadastro`, `dataedicao`) VALUES
	(1, 'Em andamento', 'SIM', '2016-03-22 15:23:14', NULL),
	(2, 'Parado', 'SIM', '2016-03-22 15:23:22', NULL);
/*!40000 ALTER TABLE `statusprocesso` ENABLE KEYS */;


-- Copiando estrutura para tabela dbexpress.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) DEFAULT NULL,
  `usuario` varchar(30) DEFAULT NULL,
  `senha` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefone` varchar(30) DEFAULT NULL,
  `ativo` int(11) DEFAULT NULL,
  `datacadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dataedicao` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `idperfil` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usuario_perfil1_idx` (`idperfil`),
  CONSTRAINT `fk_usuario_perfil1` FOREIGN KEY (`idperfil`) REFERENCES `perfil` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela dbexpress.usuario: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`id`, `nome`, `usuario`, `senha`, `email`, `telefone`, `ativo`, `datacadastro`, `dataedicao`, `idperfil`) VALUES
	(1, 'Administrador', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@admin.com.br', NULL, NULL, '2016-03-08 13:15:58', '0000-00-00 00:00:00', 1),
	(2, 'Nilton Caldas J�nior', 'ncaldas', '202cb962ac59075b964b07152d234b70', 'niltonbox@gmail.com', '9233032718', 1, '2016-03-11 17:52:18', '2016-04-09 16:11:45', 2);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
