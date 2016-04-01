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

-- Copiando estrutura para tabela laravel.pessoa
CREATE TABLE IF NOT EXISTS `pessoa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` enum('PF','PJ','CO') NOT NULL,
  `datacadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dataedicao` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela laravel.pessoa: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `pessoa` DISABLE KEYS */;
INSERT INTO `pessoa` (`id`, `tipo`, `datacadastro`, `dataedicao`) VALUES
	(1, 'PJ', '2016-04-01 00:33:53', '0000-00-00 00:00:00'),
	(2, 'PF', '2016-04-01 00:34:17', '0000-00-00 00:00:00'),
	(3, 'PJ', '2016-04-01 00:36:53', '0000-00-00 00:00:00'),
	(4, 'PJ', '2016-04-01 00:54:15', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `pessoa` ENABLE KEYS */;


-- Copiando estrutura para tabela laravel.pessoafisica
CREATE TABLE IF NOT EXISTS `pessoafisica` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `rg` varchar(14) NOT NULL,
  `sexo` enum('M','F') NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK__pessoa` FOREIGN KEY (`id`) REFERENCES `pessoa` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela laravel.pessoafisica: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `pessoafisica` DISABLE KEYS */;
INSERT INTO `pessoafisica` (`id`, `nome`, `rg`, `sexo`, `email`) VALUES
	(2, 'Fabiano Costa', '1379126-5', 'M', 'fabiano_81@hotmail.com');
/*!40000 ALTER TABLE `pessoafisica` ENABLE KEYS */;


-- Copiando estrutura para tabela laravel.pessoajuridica
CREATE TABLE IF NOT EXISTS `pessoajuridica` (
  `id` int(11) NOT NULL,
  `razaosocial` varchar(100) NOT NULL,
  `cnpj` varchar(14) NOT NULL,
  `insmunicipal` varchar(9) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_pessoajuridica_pessoa` FOREIGN KEY (`id`) REFERENCES `pessoa` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela laravel.pessoajuridica: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `pessoajuridica` DISABLE KEYS */;
INSERT INTO `pessoajuridica` (`id`, `razaosocial`, `cnpj`, `insmunicipal`) VALUES
	(1, 'Corretores online', '02123321000101', '8879001'),
	(3, 'Corretores online', '02123321000101', '8879001'),
	(4, 'Corretores online', '02123321000101', '8879001');
/*!40000 ALTER TABLE `pessoajuridica` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
