-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 05-Out-2018 às 08:33
-- Versão do servidor: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `roteiro18`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbAcesso`
--

CREATE TABLE IF NOT EXISTS `tbAcesso` (
`idAcesso` int(11) NOT NULL,
  `descricao` varchar(255) CHARACTER SET latin1 NOT NULL,
  `menu` varchar(255) CHARACTER SET latin1 NOT NULL,
  `arquivo` varchar(255) CHARACTER SET latin1 NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `idAcessoPai` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbAcesso`
--

INSERT INTO `tbAcesso` (`idAcesso`, `descricao`, `menu`, `arquivo`, `tipo`, `idAcessoPai`) VALUES
(1, 'Dashboard', 'Início', 'Menu.php', 'menu', NULL),
(2, 'Tabela de Usuários', 'Usuário', 'UsuarioTabela.php', 'menu', NULL),
(3, 'Formulário de Usuários', 'Usuário', 'UsuarioFormulario.php', 'formulario', NULL),
(4, 'Tabela de Grupos de Usuários', 'Grupo de Usuário', 'GrupoTabela.php', 'menu', NULL),
(5, 'Formulário de Grupos de Usuários', 'Grupo de Usuário', 'GrupoFormulario.php', 'formulario', NULL),
(6, 'Tabela de Categorias', 'Categoria', 'CategoriaTabela.php', 'menu', NULL),
(7, 'Formulário de Categorias', 'Categoria', 'CategoriaFormulario.php', 'formulario', NULL),
(8, 'Tabela de Produtos', 'Produto', 'ProdutoTabela.php', 'menu', NULL),
(9, 'Formulário de Produtos', 'Produto', 'ProdutoFormulario.php', 'formulario', NULL),
(10, 'Tabela de Pedidos', 'Pedido', 'PedidoTabela.php', 'menu', NULL),
(11, 'Formulário de Pedidos', 'Pedido', 'PedidoFormulario.php', 'formulario', NULL),
(12, 'Relatórios', 'Relatórios', '#', 'subMenu', NULL),
(13, 'Relatório de Estoque por Categoria', 'Estoque por Categoria', 'RelatorioProdutoCategoriaFormulario.php', 'itemSubMenu', 12),
(14, 'Relatório de Usuários por Grupo de Acesso', 'Usuários por Grupo de Acesso', '#', 'itemSubMenu', 12),
(15, 'Relatório de Pedidos por Usuário', 'Pedidos por Usuário', '#', 'itemSubMenu', 12),
(16, 'Tabela Venda', 'Venda', 'VendaTabela.php', 'menu', NULL),
(17, 'Formulario de Venda', 'Venda', 'VendaFormulario.php', 'formulario', NULL);
-- --------------------------------------------------------

--
-- Estrutura da tabela `tbCategoria`
--

CREATE TABLE IF NOT EXISTS `tbCategoria` (
`idCategoria` int(11) NOT NULL,
  `descricao` varchar(255) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbCategoria`
--

INSERT INTO `tbCategoria` (`idCategoria`, `descricao`) VALUES
(1, 'Informática'),
(2, 'Móveis');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbGrupo`
--

CREATE TABLE IF NOT EXISTS `tbGrupo` (
`idGrupo` int(11) NOT NULL,
  `descricao` varchar(255) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbGrupo`
--

INSERT INTO `tbGrupo` (`idGrupo`, `descricao`) VALUES
(1, 'Administrador'),
(2, 'Gerente'),
(23, 'Teste1'),
(25, 'Teste A'),
(26, 'teste 4'),
(28, 'teste'),
(29, 'Turma 2'),
(30, 'Turma 1'),
(31, '1'),
(32, 'teste'),
(33, 'joao lindo'),
(34, 'ys'),
(35, 'teste');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbGrupoAcesso`
--

CREATE TABLE IF NOT EXISTS `tbGrupoAcesso` (
`idGrupoAcesso` int(11) NOT NULL,
  `idGrupo` int(11) NOT NULL,
  `idAcesso` int(11) NOT NULL,
  `permissao` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbGrupoAcesso`
--

INSERT INTO `tbGrupoAcesso` (`idGrupoAcesso`, `idGrupo`, `idAcesso`, `permissao`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 2),
(3, 1, 3, 2),
(4, 1, 4, 2),
(5, 1, 5, 2),
(6, 1, 6, 2),
(7, 1, 7, 2),
(8, 1, 8, 2),
(9, 1, 9, 2),
(10, 1, 10, 2),
(11, 1, 11, 2),
(14, 2, 1, 1),
(15, 2, 2, 1),
(16, 2, 3, 1),
(17, 2, 4, 2),
(18, 2, 5, 2),
(19, 23, 6, 1),
(20, 23, 2, 1),
(21, 23, 8, 2),
(22, 23, 1, 2),
(23, 26, 1, 1),
(24, 2, 8, 1),
(25, 30, 1, 2),
(26, 30, 2, 1),
(27, 30, 3, 1),
(30, 30, 4, 2),
(31, 1, 12, 2),
(32, 1, 13, 2),
(33, 1, 14, 2),
(34, 1, 15, 2);

-- --------------------------------------------------------
--
-- Estrutura da tabela `tbvenda`
--

CREATE TABLE `tbvenda` (
  `id` int(11) NOT NULL,
  `cliente` varchar(255) NOT NULL,
  `cpf` varchar(25) NOT NULL,
  `dataVenda` date NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Estrutura da tabela `tbPedido`
--

CREATE TABLE IF NOT EXISTS `tbPedido` (
`idPedido` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `dataPedido` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbPedido`
--

INSERT INTO `tbPedido` (`idPedido`, `idUsuario`, `dataPedido`) VALUES
(21, 1, '2011-11-30 00:00:00'),
(22, 4, '2012-10-18 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbPedidoProduto`
--

CREATE TABLE IF NOT EXISTS `tbPedidoProduto` (
`idPedidoProduto` int(11) NOT NULL,
  `idPedido` int(11) DEFAULT NULL,
  `idProduto` int(11) DEFAULT NULL,
  `quantidade` int(11) NOT NULL,
  `valor` decimal(9,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbPedidoProduto`
--

INSERT INTO `tbPedidoProduto` (`idPedidoProduto`, `idPedido`, `idProduto`, `quantidade`, `valor`) VALUES
(6, 21, 1, 1, '1.00'),
(7, 21, 2, 2, '2.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbProduto`
--

CREATE TABLE IF NOT EXISTS `tbProduto` (
`idProduto` int(11) NOT NULL,
  `nome` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `descricao` varchar(3000) CHARACTER SET latin1 NOT NULL,
  `valor` decimal(9,2) NOT NULL,
  `quantidadeEstoque` int(11) NOT NULL,
  `foto` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `idCategoria` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbProduto`
--

INSERT INTO `tbProduto` (`idProduto`, `nome`, `descricao`, `valor`, `quantidadeEstoque`, `foto`, `idCategoria`) VALUES
(1, 'Notebook Ideapad', 'Foto 6 - Notebook Lenovo Ideapad 330 Intel Core i5-8250u 8GB 1TB  Tela HD 15.6"  Windows 10 - Prata', '2299.99', 10, '0102_foto_pequena.jpg', 1),
(2, 'Cadeira Presidente', 'Cadeira Presidente MB-C730 Giratória Base Cromada Preto - Travel Max', '509.00', 5, '0101_foto_pequena.jpg', 2),
(3, 'Notebook Positivo', 'Notebook Positivo Stilo XCI7660 Intel Core i3 4GB 1TB Tela LED 14" Linux - Cinza Escuro', '1496.99', 1, '0103_foto_pequena.png', 1),
(4, 'Poltrona Do Papai', 'Poltrona Do Papai Retrátil E Reclinável Marron Café', '732.00', 10, '5bb6f3d0497a031500348_1GG.jpg', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbUsuario`
--

CREATE TABLE IF NOT EXISTS `tbUsuario` (
`idUsuario` int(11) NOT NULL,
  `nome` varchar(255) CHARACTER SET latin1 NOT NULL,
  `login` varchar(255) CHARACTER SET latin1 NOT NULL,
  `senha` varchar(255) CHARACTER SET latin1 NOT NULL,
  `email` varchar(255) CHARACTER SET latin1 NOT NULL,
  `ultimoAcesso` datetime DEFAULT NULL,
  `situacao` tinyint(1) NOT NULL,
  `foto` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `idGrupo` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbUsuario`
--

INSERT INTO `tbUsuario` (`idUsuario`, `nome`, `login`, `senha`, `email`, `ultimoAcesso`, `situacao`, `foto`, `idGrupo`) VALUES
(1, 'admin', 'admin', 'admin', 'admin@admin.com', '2018-10-05 03:12:16', 1, '5b8e0f62795430_foto_pequena.jpg', 1),
(2, 'Joao Carlos', 'joao', 'joao', 'joao@gmail.com', '2018-09-21 09:18:44', 1, '5b8e0f62795430_foto_pequena.jpg', 2),
(4, 'Paulo Cesar', 'paulo', 'paulo', 'paulo@gmail.com', '2018-09-21 09:17:49', 1, '5b8e0f62795430_foto_pequena.jpg', 30),
(6, 'Ana Maria da Silva', 'ana', 'ana', 'ana@ana.com.br', '2018-09-21 09:59:37', 1, '5b8e0f62795430_foto_pequena.jpg', 23);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbAcesso`
--
ALTER TABLE `tbAcesso`
 ADD PRIMARY KEY (`idAcesso`);

--
-- Indexes for table `tbCategoria`
--
ALTER TABLE `tbCategoria`
 ADD PRIMARY KEY (`idCategoria`);

--
-- Indexes for table `tbGrupo`
--
ALTER TABLE `tbGrupo`
 ADD PRIMARY KEY (`idGrupo`);

--
-- Indexes for table `tbGrupoAcesso`
--
ALTER TABLE `tbGrupoAcesso`
 ADD PRIMARY KEY (`idGrupoAcesso`), ADD KEY `FK_tbGrupoAcesso_Ref_tbAcesso` (`idAcesso`), ADD KEY `FK_tbGrupoAcesso_Ref_tbGrupo` (`idGrupo`);

--
-- Indexes for table `tbPedido`
--
ALTER TABLE `tbPedido`
 ADD PRIMARY KEY (`idPedido`), ADD KEY `FK_tbPed_Ref_tbUsu` (`idUsuario`);

--
-- Indexes for table `tbPedidoProduto`
--
ALTER TABLE `tbPedidoProduto`
 ADD PRIMARY KEY (`idPedidoProduto`), ADD KEY `FK_tbPedPro_Ref_tbPed` (`idPedido`), ADD KEY `FK_tbPedPro_Ref_tbPro` (`idProduto`);

--
-- Indexes for table `tbProduto`
--
ALTER TABLE `tbProduto`
 ADD PRIMARY KEY (`idProduto`), ADD KEY `FK_tbPro_Ref_tbCat` (`idCategoria`);

--
-- Indexes for table `tbUsuario`
--
ALTER TABLE `tbUsuario`
 ADD PRIMARY KEY (`idUsuario`), ADD KEY `FK_tbUsuario_Ref_tbGrupo` (`idGrupo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbAcesso`
--
ALTER TABLE `tbAcesso`
MODIFY `idAcesso` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `tbCategoria`
--
ALTER TABLE `tbCategoria`
MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tbGrupo`
--
ALTER TABLE `tbGrupo`
MODIFY `idGrupo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `tbGrupoAcesso`
--
ALTER TABLE `tbGrupoAcesso`
MODIFY `idGrupoAcesso` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `tbPedido`
--
ALTER TABLE `tbPedido`
MODIFY `idPedido` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `tbPedidoProduto`
--
ALTER TABLE `tbPedidoProduto`
MODIFY `idPedidoProduto` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tbProduto`
--
ALTER TABLE `tbProduto`
MODIFY `idProduto` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbUsuario`
--
ALTER TABLE `tbUsuario`
MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `tbGrupoAcesso`
--
ALTER TABLE `tbGrupoAcesso`
ADD CONSTRAINT `FK_tbGrupoAcesso_Ref_tbAcesso` FOREIGN KEY (`idAcesso`) REFERENCES `tbAcesso` (`idAcesso`),
ADD CONSTRAINT `FK_tbGrupoAcesso_Ref_tbGrupo` FOREIGN KEY (`idGrupo`) REFERENCES `tbGrupo` (`idGrupo`);

--
-- Limitadores para a tabela `tbPedido`
--
ALTER TABLE `tbPedido`
ADD CONSTRAINT `FK_tbPed_Ref_tbUsu` FOREIGN KEY (`idUsuario`) REFERENCES `tbUsuario` (`idUsuario`);

--
-- Limitadores para a tabela `tbPedidoProduto`
--
ALTER TABLE `tbPedidoProduto`
ADD CONSTRAINT `FK_tbPedPro_Ref_tbPed` FOREIGN KEY (`idPedido`) REFERENCES `tbPedido` (`idPedido`),
ADD CONSTRAINT `FK_tbPedPro_Ref_tbPro` FOREIGN KEY (`idProduto`) REFERENCES `tbProduto` (`idProduto`);

--
-- Limitadores para a tabela `tbProduto`
--
ALTER TABLE `tbProduto`
ADD CONSTRAINT `FK_tbPro_Ref_tbCat` FOREIGN KEY (`idCategoria`) REFERENCES `tbCategoria` (`idCategoria`);

--
-- Limitadores para a tabela `tbUsuario`
--
ALTER TABLE `tbUsuario`
ADD CONSTRAINT `FK_tbUsuario_Ref_tbGrupo` FOREIGN KEY (`idGrupo`) REFERENCES `tbGrupo` (`idGrupo`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
