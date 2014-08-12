
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 31/07/2014 às 06:22:37
-- Versão do Servidor: 5.1.66
-- Versão do PHP: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `u128784088_prtal`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `log_sistema`
--

CREATE TABLE IF NOT EXISTS `log_sistema` (
  `idlog` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` int(11) DEFAULT NULL,
  `datahora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `texto` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `so` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idlog`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=20 ;

--
-- Extraindo dados da tabela `log_sistema`
--

INSERT INTO `log_sistema` (`idlog`, `idusuario`, `datahora`, `texto`, `so`) VALUES
(1, NULL, '2014-07-31 01:16:25', 'Login -> teste@gmail.com Retorno-> 0 - Login e/ou senha inválidos!', 'iPhone'),
(2, 1, '2014-07-31 01:18:25', 'Login -> teste@gmail.com Retorno-> 1 - Logado', 'iPhone'),
(3, 1, '2014-07-31 01:23:45', 'Login -> teste@gmail.com Retorno-> 1 - Logado', 'WinNT'),
(4, 1, '2014-07-31 01:42:09', 'Login -> teste@gmail.com Retorno-> 1 - Logado', 'WinNT'),
(5, 66, '2014-07-31 02:22:21', 'Login -> senha@gmail.com Retorno-> 66 - Logado', 'WinNT'),
(6, 66, '2014-07-31 02:22:45', 'Login -> senha@gmail.com Retorno-> 66 - Logado', 'WinNT'),
(7, 66, '2014-07-31 02:23:43', 'Login -> senha@gmail.com Retorno-> 66 - Logado', 'WinNT'),
(8, NULL, '2014-07-31 02:24:38', 'Login -> senha@gmail.com Retorno-> 0 - Usuário inativo!', 'WinNT'),
(9, 1, '2014-07-31 02:24:43', 'Login -> teste@gmail.com Retorno-> 1 - Logado', 'WinNT'),
(10, 1, '2014-07-31 03:01:49', 'Login -> teste@gmail.com Retorno-> 1 - Logado', 'Windows 7'),
(11, NULL, '2014-07-31 03:02:07', 'Login -> teste@gmail.com Retorno-> 0 - Login e/ou senha inválidos!', 'Windows 7'),
(12, NULL, '2014-07-31 03:02:43', 'Recuperar senha : teste@gmail.com', 'Windows 7'),
(13, NULL, '2014-07-31 03:02:47', 'Recuperar senha : teste@gmail.com', 'Windows 7'),
(14, 1, '2014-07-31 03:03:01', 'Login -> teste@gmail.com Retorno-> 1 - Logado', 'Windows 7'),
(15, NULL, '2014-07-31 03:03:11', 'Login -> teste@gmail.com Retorno-> 0 - Login e/ou senha inválidos!', 'Windows 7'),
(16, 1, '2014-07-31 03:03:13', 'Login -> teste@gmail.com Retorno-> 1 - Logado', 'Windows 7'),
(17, 1, '2014-07-31 03:03:52', 'Login -> teste@gmail.com Retorno-> 1 - Logado', 'WinNT'),
(18, 1, '2014-07-31 03:07:28', 'Login -> teste@gmail.com Retorno-> 1 - Logado', 'Ubuntu'),
(19, NULL, '2014-07-31 03:18:16', 'Recuperar senha : mavidea@gmail.com', 'Ubuntu');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa`
--

CREATE TABLE IF NOT EXISTS `pessoa` (
  `idpessoa` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `telefone` varchar(18) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `ativo` char(1) NOT NULL,
  `senha` varchar(100) DEFAULT NULL,
  `idtipo` int(11) NOT NULL,
  `dtcadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tentativalogin` int(11) DEFAULT NULL,
  PRIMARY KEY (`idpessoa`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=67 ;

--
-- Extraindo dados da tabela `pessoa`
--

INSERT INTO `pessoa` (`idpessoa`, `nome`, `telefone`, `email`, `ativo`, `senha`, `idtipo`, `dtcadastro`, `tentativalogin`) VALUES
(1, 'Teste da silva', NULL, 'teste@gmail.com', 'T', 'c4ca4238a0b923820dcc509a6f75849b', 1, '2014-07-31 03:03:13', 0),
(63, 'Teste da silva', NULL, 'teste@gmail.com asds', 'T', '••••••', 2, '2014-07-31 01:59:26', NULL),
(66, 'teste senha', NULL, 'senha@gmail.com', 'F', '81dc9bdb52d04dc20036dbd8313ed055', 1, '2014-07-31 02:24:25', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `publicacao`
--

CREATE TABLE IF NOT EXISTS `publicacao` (
  `idpublicacao` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `corpo_formatado` text COLLATE utf8_unicode_ci NOT NULL,
  `dtpublicacao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idpessoa` int(11) NOT NULL,
  `flagvisivel` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idpublicacao`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Extraindo dados da tabela `publicacao`
--

INSERT INTO `publicacao` (`idpublicacao`, `titulo`, `corpo_formatado`, `dtpublicacao`, `idpessoa`, `flagvisivel`) VALUES
(14, 'Marco véio descendo o morro da vó Solvelina', '<div><iframe allowfullscreen=.EcMA..EcMA. frameborder=.EcMA.0.EcMA. height=.EcMA.315.EcMA. src=.EcMA.//www.youtube.com/embed/DahLMjDwSPo.EcMA. width=.EcMA.560.EcMA.></iframe></div>\n\n<p>.EcM.nbsp;</p>', '2014-07-31 06:08:55', 1, 'T'),
(12, 'Carro teste', '<h2>Post com uma imagem aleat&oacute;rea de um carro<img alt=.EcMA..EcMA. src=.EcMA.http://wowslider.com/images/demo/terse-blur/data1/images/gtravalanche06_07.jpg.EcMA. style=.EcMA.height:360px; width:960px.EcMA. /></h2>', '2014-07-31 05:37:40', 1, 'T');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_pessoa`
--

CREATE TABLE IF NOT EXISTS `tipo_pessoa` (
  `idtipo` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idtipo`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `tipo_pessoa`
--

INSERT INTO `tipo_pessoa` (`idtipo`, `descricao`) VALUES
(1, 'Administrador'),
(2, 'Professor');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
