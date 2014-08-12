
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 12/08/2014 às 04:03:28
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
-- Estrutura da tabela `categoria_publicacao`
--

CREATE TABLE IF NOT EXISTS `categoria_publicacao` (
  `idcategoria` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idcategoria`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `categoria_publicacao`
--

INSERT INTO `categoria_publicacao` (`idcategoria`, `descricao`) VALUES
(1, 'Notícias'),
(2, 'Artigos');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=27 ;

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
(19, NULL, '2014-07-31 03:18:16', 'Recuperar senha : mavidea@gmail.com', 'Ubuntu'),
(20, 1, '2014-07-31 06:35:05', 'Login -> teste@gmail.com Retorno-> 1 - Logado', 'WinNT'),
(21, 1, '2014-07-31 15:29:19', 'Login -> teste@gmail.com Retorno-> 1 - Logado', 'Android'),
(22, 1, '2014-07-31 16:51:15', 'Login -> teste@gmail.com Retorno-> 1 - Logado', 'WinNT'),
(23, 1, '2014-07-31 18:04:08', 'Login -> teste@gmail.com Retorno-> 1 - Logado', 'WinNT'),
(24, 67, '2014-07-31 18:04:53', 'Login -> utfpr@gmail.com Retorno-> 67 - Logado', 'WinNT'),
(25, 1, '2014-07-31 21:35:47', 'Login -> teste@gmail.com Retorno-> 1 - Logado', 'Linux'),
(26, 1, '2014-08-12 02:56:02', 'Login -> teste@gmail.com Retorno-> 1 - Logado', 'WinNT');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=68 ;

--
-- Extraindo dados da tabela `pessoa`
--

INSERT INTO `pessoa` (`idpessoa`, `nome`, `telefone`, `email`, `ativo`, `senha`, `idtipo`, `dtcadastro`, `tentativalogin`) VALUES
(1, 'Teste da silva', NULL, 'teste@gmail.com', 'T', 'c4ca4238a0b923820dcc509a6f75849b', 1, '2014-07-31 03:03:13', 0),
(63, 'Teste da silva', NULL, 'teste@gmail.com asds', 'T', '••••••', 2, '2014-07-31 01:59:26', NULL),
(66, 'teste senha', NULL, 'senha@gmail.com', 'F', '81dc9bdb52d04dc20036dbd8313ed055', 1, '2014-07-31 02:24:25', 0),
(67, 'Teste cadastro', NULL, 'utfpr@gmail.com', 'T', 'c4ca4238a0b923820dcc509a6f75849b', 1, '2014-07-31 18:04:53', 0);

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
  `idcategoria` int(11) NOT NULL,
  PRIMARY KEY (`idpublicacao`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=18 ;

--
-- Extraindo dados da tabela `publicacao`
--

INSERT INTO `publicacao` (`idpublicacao`, `titulo`, `corpo_formatado`, `dtpublicacao`, `idpessoa`, `flagvisivel`, `idcategoria`) VALUES
(14, 'Marco véio descendo o morro da vó Solvelina', '<div><iframe allowfullscreen=.EcMA..EcMA. frameborder=.EcMA.0.EcMA. height=.EcMA.315.EcMA. src=.EcMA.//www.youtube.com/embed/DahLMjDwSPo.EcMA. width=.EcMA.560.EcMA.></iframe></div>\n\n<p>.EcM.nbsp;</p>', '2014-07-31 06:08:55', 1, 'T', 1),
(12, 'Carro teste', '<h2>Post com uma imagem aleat&oacute;rea de um carro<img alt=.EcMA..EcMA. src=.EcMA.http://wowslider.com/images/demo/terse-blur/data1/images/gtravalanche06_07.jpg.EcMA. style=.EcMA.height:360px; width:960px.EcMA. /></h2>', '2014-07-31 05:37:40', 1, 'T', 1),
(15, 'Sistema de seleção', '<p>Publicada a rela&ccedil;&atilde;o de convocados na 5&ordf; chamada; matr&iacute;culas nesta sexta</p>\n\n<p><a href=.EcMA.http://www.utfpr.edu.br/estrutura-universitaria/diretorias-de-gestao/dircom/noticias/noticias/sistema-de-selecao-1/image/image_view_fullscreen.EcMA.><img alt=.EcMA.Sistema de Seleção.EcMA. src=.EcMA.http://www.utfpr.edu.br/estrutura-universitaria/diretorias-de-gestao/dircom/noticias/noticias/sistema-de-selecao-1/image_mini.EcMA. style=.EcMA.height:156px; margin:auto !important; width:200px.EcMA. /></a></p>\n\n<p>J&aacute; est&aacute; dispon&iacute;vel a rela&ccedil;&atilde;o de candidatos convocados na&nbsp;<a href=.EcMA.http://www.utfpr.edu.br/futuros-alunos/sisu-2014-2/copy_of_5_chamada.pdf.EcMA. target=.EcMA._self.EcMA.>5&ordf; chamada</a>&nbsp;da edi&ccedil;&atilde;o de inverno do Sistema de Sele&ccedil;&atilde;o Unificada (SiSU) 2014. Os candidatos listados devem fazer o requerimento de matr&iacute;cula presencialmente no Departamento de Registros Acad&ecirc;micos (Derac) do respectivo c&acirc;mpus, no dia 01&deg; de agosto, ou enviar a documenta&ccedil;&atilde;o pelos Correios, via Sedex, at&eacute; esta quinta-feira, dia 31.</p>\n\n<p>Antes de protocolar o requerimento, o candidato deve observar a rela&ccedil;&atilde;o de documentos exigidos e os procedimentos para matr&iacute;cula via Sedex, dispon&iacute;veis no<a href=.EcMA.http://www.utfpr.edu.br/futuros-alunos/sisu-2014-2/Edital021PROGRAD_SISU2014_2Retificadoem11062014.pdf.EcMA. target=.EcMA._self.EcMA.>Edital do SiSU-UTFPR</a>. Os modelos de declara&ccedil;&otilde;es tamb&eacute;m est&atilde;o dispon&iacute;veis no documento normativo.</p>\n\n<p>A rela&ccedil;&atilde;o de convocados nesta chamada &eacute; composta por at&eacute; 50% de candidatos a mais em rela&ccedil;&atilde;o ao n&uacute;mero de vagas ainda existentes em cada curso e em cada categoria, cotista ou n&atilde;o cotista. O objetivo &eacute; ocupar as vagas remanescentes em menor tempo. A 6&ordf; do Sistema, para os cursos que ainda tenham vagas, est&aacute; programa para ser divulgada na pr&oacute;xima ter&ccedil;a-feira, dia 05 de agosto.</p>\n\n<p>Atualizado em 30/07/2014</p>\n\n<p>Acompanhe as not&iacute;cias da UTFPR no&nbsp;<a href=.EcMA.http://www.twitter.com/UTFPR_.EcMA.>twitter</a>&nbsp;e no&nbsp;<a href=.EcMA.https://www.facebook.com/UTFPR.EcMA.>facebook</a>.</p>', '2014-07-31 06:36:22', 1, 'T', 1),
(16, 'O que é Post?', '<p>Origem: Wikip&eacute;dia, a enciclop&eacute;dia livre.</p>\n\n<hr />\n<table>\n	<tbody>\n		<tr>\n			<td><a href=.EcMA.http://pt.wikipedia.org/wiki/Wikipédia:Desambiguação.EcMA.><img alt=.EcMA.Desambiguação.EcMA. src=.EcMA.http://upload.wikimedia.org/wikipedia/commons/thumb/7/72/Disambig.svg/35px-Disambig.svg.png.EcMA. style=.EcMA.height:28px; width:35px.EcMA. /></a></td>\n			<td><em>Esta &eacute; uma p&aacute;gina de&nbsp;<a href=.EcMA.http://pt.wikipedia.org/wiki/Ajuda:Guia_de_edição/Desambiguação.EcMA.>desambigua&ccedil;&atilde;o</a>, a qual lista artigos associados a um mesmo t&iacute;tulo.<br />\n			<small>Se uma&nbsp;<a href=.EcMA.http://pt.wikipedia.org/wiki/Especial:Páginas_afluentes/Post.EcMA.>liga&ccedil;&atilde;o interna</a>&nbsp;o conduziu at&eacute; aqui, sugerimos que a corrija para apont&aacute;-la diretamente ao artigo adequado.</small></em></td>\n		</tr>\n	</tbody>\n</table>\n\n<hr />\n<p><br />\n<em><strong>Post</strong></em>&nbsp;pode referir-se a:</p>\n\n<ul>\n	<li><a href=.EcMA.http://pt.wikipedia.org/w/index.php?title=Post_(publicação)&amp;action=edit&amp;redlink=1.EcMA.>Post (publica&ccedil;&atilde;o)</a>, entradas de texto cronol&oacute;gicas em&nbsp;<a href=.EcMA.http://pt.wikipedia.org/wiki/Websites.EcMA.>websites</a>/<a href=.EcMA.http://pt.wikipedia.org/wiki/Blogs.EcMA.>blogs</a></li>\n	<li><a href=.EcMA.http://pt.wikipedia.org/wiki/POST.EcMA.>POST</a>&nbsp;(<em>Power On Self Test</em>), um teste feito pela&nbsp;<a href=.EcMA.http://pt.wikipedia.org/wiki/BIOS.EcMA.>BIOS</a>&nbsp;no&nbsp;<a href=.EcMA.http://pt.wikipedia.org/wiki/Computador.EcMA.>computador</a></li>\n	<li><a href=.EcMA.http://pt.wikipedia.org/wiki/Post_(álbum).EcMA.>Post</a>&nbsp;2&deg; &aacute;lbum da cantora islandesa&nbsp;<a href=.EcMA.http://pt.wikipedia.org/wiki/Björk.EcMA.>Bj&ouml;rk</a>.</li>\n	<li><a href=.EcMA.http://pt.wikipedia.org/wiki/HTTP#M.C3.A9todos.EcMA.>POST</a>, um dos v&aacute;rios m&eacute;todos de requisi&ccedil;&atilde;o fornecidos pelo&nbsp;<a href=.EcMA.http://pt.wikipedia.org/wiki/Protocolo_de_comunicação.EcMA.>protocolo</a>&nbsp;<a href=.EcMA.http://pt.wikipedia.org/wiki/HTTP.EcMA.>HTTP</a>.</li>\n</ul>\n\n<p>&eacute; um verbo masculino</p>', '2014-07-31 06:38:23', 1, 'T', 1),
(17, 'Teste categoria', '<p>asd aasd asd a d</p>', '2014-08-12 03:53:18', 1, 'T', 2);

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
