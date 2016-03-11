# Host: localhost  (Version: 5.6.24)
# Date: 2016-03-11 10:12:25
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
# Structure for table "menu"
#

DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
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
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

#
# Data for table "menu"
#

INSERT INTO `menu` VALUES (1,'CADASTROS GERAIS','cadastro','fa arrow','fa fa-table',0,'NULL','2016-03-08 10:08:07',NULL),(2,'AUTENTICACAO','auth','fa arrow','fa fa-key',0,'NULL','2016-03-08 10:14:05',NULL),(3,'CADASTROS ADMINISTRATIVOS','admin','fa arrow','fa fa-user',0,NULL,'2016-03-08 10:14:53',NULL),(4,'UTILITARIOS','util','fa arrow','fa fa-user',0,NULL,'2016-03-08 10:16:07',NULL),(5,'SERVICOS','cadastro/servico','','',1,NULL,'2016-03-08 14:45:05',NULL),(6,'STATUSPROCESSO','cadastro/processo','','',1,NULL,'2016-03-08 14:46:42',NULL),(7,'INDICACOES','cadastro/indicacoes','','',1,NULL,'2016-03-08 14:47:13',NULL),(8,'CORRETORES','cadastro/corretores','','',1,NULL,'2016-03-08 14:47:38',NULL),(9,'BANCOAGENCIA','cadastro/banco','','',1,NULL,'2016-03-08 14:48:24',NULL),(10,'CARTORIO','cadastro/cartorio','','',1,NULL,'2016-03-08 14:48:48',NULL),(11,'ORGAOS','cadastro/orgaos','','',1,NULL,'2016-03-08 14:49:12',NULL),(12,'CERTIDOES','cadastro/certidoes','','',1,NULL,'2016-03-08 14:49:47',NULL),(13,'CLIENTEPJ','admin/clientepj','','',3,NULL,'2016-03-08 14:50:49',NULL),(14,'CLIENTEPF','admin/clientepf','','',3,NULL,'2016-03-08 14:51:01',NULL),(15,'PROCESSO','admin/processo','','',3,NULL,'2016-03-08 14:51:13',NULL),(16,'ANDAMENTODOPROCESSO','admin/andamento','','',3,NULL,'2016-03-08 14:51:30',NULL),(17,'CONTACORRENTE','admin/contacorrente','','',3,NULL,'2016-03-08 14:51:55',NULL),(18,'CLIENTEEMPOTENCIAL','admin/clienteempotencial','','',3,NULL,'2016-03-08 14:52:13',NULL),(19,'PEDIDODECERTIDAO','admin/pedidodecertidao','','',3,NULL,'2016-03-08 14:52:29',NULL),(20,'USUARIO','auth/usuario','','',2,NULL,'2016-03-08 14:55:19',NULL),(21,'PERFIL','auth/perfil','','',2,NULL,'2016-03-08 14:55:24',NULL),(22,'MENU','auth/menu','','',2,NULL,'2016-03-08 14:55:31',NULL),(23,'PERMISSOES','auth/permissoes','','',2,NULL,'2016-03-08 14:55:39',NULL),(24,'ARQUIVOVIRTUAL','util/arquivovirtual','','',4,NULL,'2016-03-08 14:57:37',NULL),(25,'BOLETO','util/boleto','','',4,NULL,'2016-03-08 14:57:42',NULL),(26,'PARAMETROSDOSISTEMA','util/parametrodosistema','','',4,NULL,'2016-03-08 14:57:56',NULL),(27,'RELATORIOS','relatorio','fa arrow','fa fa-edit',0,NULL,'2016-03-08 14:59:40',NULL),(28,'PROCESSOS','relatorio/processo','','',27,NULL,'2016-03-08 14:59:55',NULL),(29,'CONTACORRENTE','relatorio/contacorrente','','',27,NULL,'2016-03-08 15:00:06',NULL);

#
# Structure for table "perfil"
#

DROP TABLE IF EXISTS `perfil`;
CREATE TABLE `perfil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `ativo` int(11) NOT NULL,
  `datacadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dataedicao` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

#
# Data for table "perfil"
#

INSERT INTO `perfil` VALUES (1,'Administrador',0,'2016-03-08 13:15:13','2016-03-08 13:15:11');

#
# Structure for table "permissoes"
#

DROP TABLE IF EXISTS `permissoes`;
CREATE TABLE `permissoes` (
  `id_menu` int(11) NOT NULL,
  `id_perfil` int(11) NOT NULL,
  KEY `fk_permissao_perfil` (`id_perfil`),
  KEY `fk_permissao_menu` (`id_menu`),
  CONSTRAINT `fk_permissao_menu` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id`),
  CONSTRAINT `fk_permissao_perfil` FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "permissoes"
#

INSERT INTO `permissoes` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(11,1),(12,1),(13,1),(14,1),(15,1),(16,1),(17,1),(18,1),(19,1),(20,1),(21,1),(22,1),(23,1),(24,1),(25,1),(26,1),(27,1),(28,1),(29,1);

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


#
# Structure for table "usuario"
#

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) DEFAULT NULL,
  `usuario` varchar(30) DEFAULT NULL,
  `senha` varchar(40) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefone` varchar(30) DEFAULT NULL,
  `ativo` int(11) DEFAULT NULL,
  `datacadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dataedicao` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `idperfil` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usuario_perfil1_idx` (`idperfil`),
  CONSTRAINT `fk_usuario_perfil1` FOREIGN KEY (`idperfil`) REFERENCES `perfil` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

#
# Data for table "usuario"
#

INSERT INTO `usuario` VALUES (1,'Administrador','admin','21232f297a57a5a743894a0e4a801fc3','admin@admin.com.br',NULL,NULL,'2016-03-08 13:15:58','0000-00-00 00:00:00',1);
