-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 09-Ago-2023 às 11:29
-- Versão do servidor: 5.7.11
-- PHP Version: 5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bibliotech`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `emprestimos`
--

CREATE TABLE `emprestimos` (
  `id` int(11) NOT NULL,
  `codigo_livro` int(11) NOT NULL,
  `nome_aluno` varchar(100) NOT NULL,
  `data_retirada` date NOT NULL,
  `data_entrega` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `emprestimos`
--

INSERT INTO `emprestimos` (`id`, `codigo_livro`, `nome_aluno`, `data_retirada`, `data_entrega`) VALUES
(1, 12345, 'Vitor', '2023-08-03', '2023-08-31'),
(2, 214365, 'Pedro', '2023-08-01', '2023-08-04'),
(3, 214365, 'Pedro', '2023-08-01', '2023-08-04'),
(4, 214365, 'Pedro', '2023-08-01', '2023-08-04'),
(5, 214365, 'Pedro', '2023-08-01', '2023-08-04'),
(6, 214365, 'Pedro', '2023-08-01', '2023-08-04'),
(7, 214365, 'Pedro', '2023-08-01', '2023-08-04'),
(8, 214365, 'Pedro', '2023-08-01', '2023-08-04'),
(9, 214365, 'Pedro', '2023-08-01', '2023-08-04'),
(10, 214365, 'Pedro', '2023-08-01', '2023-08-04'),
(11, 19203, 'Vitor', '2023-08-03', '2023-08-31');

-- --------------------------------------------------------

--
-- Estrutura da tabela `livros`
--

CREATE TABLE `livros` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `autor` varchar(255) NOT NULL,
  `classificacao` varchar(50) NOT NULL,
  `paginas` int(11) NOT NULL,
  `ano` int(11) NOT NULL,
  `editora` varchar(100) NOT NULL,
  `idioma` varchar(100) NOT NULL,
  `posicao` varchar(100) NOT NULL,
  `sinopse` text NOT NULL,
  `unidade` int(11) DEFAULT '0',
  `codigo` varchar(255) NOT NULL,
  `imagens` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `livros`
--

INSERT INTO `livros` (`id`, `nome`, `autor`, `classificacao`, `paginas`, `ano`, `editora`, `idioma`, `posicao`, `sinopse`, `unidade`, `codigo`, `imagens`) VALUES
(4, 'O Pequeno PrÃ­ncipe', 'Antoine de Saint-ExupÃ©ry', ' Livre', 96, 1943, 'Agir', 'PortuguÃªs', 'Prateleira A, Setor Literatura Infantojuvenil', 'O Pequeno PrÃ­ncipe" Ã© uma obra clÃ¡ssica da literatura infantojuvenil que encanta leitores de todas as idades. A histÃ³ria narra as aventuras de um pequeno prÃ­ncipe que viaja por diferentes planetas, encontrando personagens peculiares e refletindo sobre questÃµes profundas da vida e da natureza humana. ', 3, '', NULL),
(5, 'Harry Potter e a Pedra Filosofal', 'J.K. Rowling', '+9', 223, 1997, ' Bloomsbury Publishing', ' InglÃªs', 'Prateleira B, Setor Fantasia', 'O livro narra as aventuras de Harry Potter, um jovem bruxo Ã³rfÃ£o que descobre que Ã© famoso no mundo mÃ¡gico. Ele ingressa na Escola de Magia e Bruxaria de Hogwarts, onde enfrenta desafios, faz amigos e descobre segredos sobre seu passado.', 1, '', NULL),
(6, 'Harry Potter e a Pedra Filosofal', 'J.K. Rowling', '+9', 225, 1999, ' Bloomsbury Publishing', 'PortuguÃªs', 'Prateleira B, Setor Fantasia', '1sdasdweasdwa', 1, '12345', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `professores`
--

CREATE TABLE `professores` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `disciplina` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `codigo_acesso` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `professores`
--

INSERT INTO `professores` (`id`, `nome`, `cpf`, `disciplina`, `email`, `codigo_acesso`) VALUES
(2, 'Vitor', '123.123.123-72', 'Matematica', 'vitor@gmail.com', '121314'),
(3, 'Bernado', '123.123.123-72', 'Matematica', 'bernado@gmail.com', '121314'),
(4, 'Paulo', '123.123.123-72', 'Matematica', 'paulo@gmai.com', '121314');

-- --------------------------------------------------------

--
-- Estrutura da tabela `renovacoes_emprestimos`
--

CREATE TABLE `renovacoes_emprestimos` (
  `id` int(11) NOT NULL,
  `codigo_livro` int(11) NOT NULL,
  `nome_aluno` varchar(100) NOT NULL,
  `nova_data_retirada` date NOT NULL,
  `nova_data_entrega` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `matricula` varchar(255) NOT NULL,
  `ano` int(11) NOT NULL,
  `turma` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `matricula`, `ano`, `turma`) VALUES
(1, 'Vitor', 'vitor@gmail.com', '1234567891', 3, '301');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `emprestimos`
--
ALTER TABLE `emprestimos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `professores`
--
ALTER TABLE `professores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `renovacoes_emprestimos`
--
ALTER TABLE `renovacoes_emprestimos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `emprestimos`
--
ALTER TABLE `emprestimos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `professores`
--
ALTER TABLE `professores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `renovacoes_emprestimos`
--
ALTER TABLE `renovacoes_emprestimos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
