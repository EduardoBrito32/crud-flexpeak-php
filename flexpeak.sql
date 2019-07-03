-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 03-Jul-2019 às 16:58
-- Versão do servidor: 5.7.26
-- versão do PHP: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flexpeak`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `curso`
--

DROP TABLE IF EXISTS `curso`;
CREATE TABLE IF NOT EXISTS `curso` (
  `id_curso` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(80) NOT NULL,
  `id_professor` varchar(80) NOT NULL,
  `data_criacao` datetime DEFAULT NULL,
  PRIMARY KEY (`id_curso`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `curso`
--

INSERT INTO `curso` (`id_curso`, `nome`, `id_professor`, `data_criacao`) VALUES
(2, 'Filosofia', '3', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa`
--

DROP TABLE IF EXISTS `pessoa`;
CREATE TABLE IF NOT EXISTS `pessoa` (
  `id_aluno` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `logradouro` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `numero` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `bairro` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `cidade` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `estado` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `cep` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `data_nascimento` date DEFAULT NULL,
  `id_curso` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `data_criacao` datetime DEFAULT NULL,
  PRIMARY KEY (`id_aluno`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `pessoa`
--

INSERT INTO `pessoa` (`id_aluno`, `nome`, `logradouro`, `numero`, `bairro`, `cidade`, `estado`, `cep`, `data_nascimento`, `id_curso`, `data_criacao`) VALUES
(25, 'JoÃ£o Pedro', 'Avenida TefÃ©', '34', 'Japiim', 'Manaus', 'AM', '69078000', '1998-08-23', '11', NULL),
(27, 'Diego Fabio', 'Avenida Paulista', '121', 'Bela Vista', 'SÃ£o Paulo', 'SP', '01310-924', '1970-08-12', '12', NULL),
(28, 'fabio assunÃ§Ã£o', 'Rua Trajano', '332', 'Centro', 'FlorianÃ³polis', 'SC', '88010-010', '1966-02-04', '1', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `professor`
--

DROP TABLE IF EXISTS `professor`;
CREATE TABLE IF NOT EXISTS `professor` (
  `id_professor` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(80) NOT NULL,
  `data_nascimento` date DEFAULT NULL,
  `data_criacao` datetime DEFAULT NULL,
  PRIMARY KEY (`id_professor`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `professor`
--

INSERT INTO `professor` (`id_professor`, `nome`, `data_nascimento`, `data_criacao`) VALUES
(3, 'Marcos query', '1970-12-01', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
