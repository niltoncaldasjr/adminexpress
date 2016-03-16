# Host: localhost  (Version: 5.6.24)
# Date: 2016-03-16 16:32:14
# Generator: MySQL-Front 5.3  (Build 5.19)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "pessoa"
#

DROP TABLE IF EXISTS `pessoa`;
CREATE TABLE `pessoa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `CEP` varchar(9) DEFAULT NULL,
  `endereco` varchar(150) DEFAULT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `complemento` varchar(150) DEFAULT NULL,
  `bairro` varchar(100) DEFAULT NULL,
  `telefone` varchar(50) DEFAULT NULL,
  `fax` varchar(50) DEFAULT NULL,
  `celular` varchar(50) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `email2` varchar(150) DEFAULT NULL,
  `site` varchar(150) DEFAULT NULL,
  `datacadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dataedicao` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "pessoa"
#


#
# Structure for table "pessoafisica"
#

DROP TABLE IF EXISTS `pessoafisica`;
CREATE TABLE `pessoafisica` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idpessoa` int(11) DEFAULT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `cpf` varchar(15) DEFAULT NULL,
  `nacionalidade` varchar(100) DEFAULT NULL,
  `datanascimento` timestamp NULL DEFAULT NULL,
  `estadocivil` enum('SOLTEIRO','CASADO','VIUVO','DIVORCIADO') DEFAULT NULL,
  `nomeconjuge` varchar(100) DEFAULT NULL,
  `profissao` int(11) DEFAULT NULL,
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
  CONSTRAINT `pessoafisica_ibfk_1` FOREIGN KEY (`idpessoa`) REFERENCES `pessoa` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "pessoafisica"
#


#
# Structure for table "pessoajuridica"
#

DROP TABLE IF EXISTS `pessoajuridica`;
CREATE TABLE `pessoajuridica` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "pessoajuridica"
#

