# Host: localhost  (Version: 5.6.24)
# Date: 2016-03-11 10:10:38
# Generator: MySQL-Front 5.3  (Build 5.19)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "banco"
#

DROP TABLE IF EXISTS `banco`;
CREATE TABLE `banco` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) DEFAULT NULL,
  `febran` varchar(4) DEFAULT NULL,
  `datacadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dataedicao` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "banco"
#


#
# Structure for table "contabanco"
#

DROP TABLE IF EXISTS `contabanco`;
CREATE TABLE `contabanco` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`Id`),
  KEY `idbanco` (`idbanco`),
  CONSTRAINT `contabanco_ibfk_1` FOREIGN KEY (`idbanco`) REFERENCES `banco` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "contabanco"
#


#
# Structure for table "indicacao"
#

DROP TABLE IF EXISTS `indicacao`;
CREATE TABLE `indicacao` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "indicacao"
#


#
# Structure for table "servico"
#

DROP TABLE IF EXISTS `servico`;
CREATE TABLE `servico` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  `datacadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dataedicao` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "servico"
#


#
# Structure for table "statusprocesso"
#

DROP TABLE IF EXISTS `statusprocesso`;
CREATE TABLE `statusprocesso` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  `web` enum('SIM',' NAO') DEFAULT NULL,
  `datacadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dataedicao` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "statusprocesso"
#

