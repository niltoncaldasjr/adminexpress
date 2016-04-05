# Host: localhost  (Version: 5.6.24)
# Date: 2016-04-04 19:14:50
# Generator: MySQL-Front 5.3  (Build 5.19)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "grupo"
#

DROP TABLE IF EXISTS `grupo`;
CREATE TABLE `grupo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) DEFAULT NULL,
  `tipo` enum('PF','PJ','AMBOS') DEFAULT NULL,
  `datacadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dataedicao` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

#
# Data for table "grupo"
#

INSERT INTO `grupo` VALUES (1,'orgaos','PJ','2016-03-30 13:08:36',NULL);

#
# Structure for table "grupopessoa"
#

DROP TABLE IF EXISTS `grupopessoa`;
CREATE TABLE `grupopessoa` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "grupopessoa"
#


#
# Structure for table "profissao"
#

DROP TABLE IF EXISTS `profissao`;
CREATE TABLE `profissao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) DEFAULT NULL,
  `datacadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dataedicao` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

#
# Data for table "profissao"
#

INSERT INTO `profissao` VALUES (1,'Desenvolvedor','2016-04-01 18:47:21',NULL),(2,'Pedreiro','2016-04-01 18:47:27',NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "pessoafisica"
#


#
# Structure for table "representantepj"
#

DROP TABLE IF EXISTS `representantepj`;
CREATE TABLE `representantepj` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "representantepj"
#

