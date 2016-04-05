-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.1.8-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win32
-- HeidiSQL Versão:              9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Copiando estrutura para tabela dbexpress.certidao
CREATE TABLE IF NOT EXISTS `certidao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) NOT NULL,
  `prazo` int(11) NOT NULL,
  `valor` float NOT NULL,
  `datacadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dataedicao` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela dbexpress.certidao: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `certidao` DISABLE KEYS */;
INSERT INTO `certidao` (`id`, `descricao`, `prazo`, `valor`, `datacadastro`, `dataedicao`) VALUES
	(1, 'Casamento', 2, 100, '2016-03-26 12:30:19', '2016-03-28 00:00:00'),
	(2, 'Nascimento', 3, 500, '2016-03-27 19:50:12', '0000-00-00 00:00:00');
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela dbexpress.checklist: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `checklist` DISABLE KEYS */;
INSERT INTO `checklist` (`id`, `idservico`, `ordem`, `item`, `datacadastro`, `dataedicao`) VALUES
	(1, 1, 1, '2', '2016-03-27 17:00:51', '0000-00-00 00:00:00'),
	(4, 1, 3, 'RG', '2016-03-27 17:33:10', '2016-03-27 23:33:36');
/*!40000 ALTER TABLE `checklist` ENABLE KEYS */;


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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela dbexpress.honorario: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `honorario` DISABLE KEYS */;
INSERT INTO `honorario` (`id`, `idservico`, `valor`, `datacadastro`, `dataedicao`) VALUES
	(1, 1, 150.00, '2016-03-26 20:30:54', '2016-03-27 22:57:09'),
	(5, 1, 2100.00, '2016-03-27 16:56:39', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `honorario` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
