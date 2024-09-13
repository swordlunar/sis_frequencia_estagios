-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 13/09/2024 às 20:07
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sis_frequencia_estagio`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `aluno`
--

CREATE TABLE `aluno` (
  `id_aluno` int(11) NOT NULL,
  `nome_aluno` varchar(255) NOT NULL,
  `matricula_aluno` varchar(50) NOT NULL,
  `telefone_aluno` varchar(20) NOT NULL,
  `cod_curso` int(11) NOT NULL,
  `nome_curso` varchar(50) NOT NULL,
  `periodo_letivo` varchar(10) NOT NULL,
  `email_aluno` varchar(255) NOT NULL,
  `turma` varchar(10) NOT NULL,
  `turno` varchar(20) DEFAULT NULL,
  `status_estagio` int(11) NOT NULL,
  `criado_em` datetime NOT NULL,
  `criado_por` varchar(255) NOT NULL,
  `editado_em` datetime NOT NULL,
  `editado_por` varchar(255) NOT NULL,
  `id_setor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `aluno`
--

INSERT INTO `aluno` (`id_aluno`, `nome_aluno`, `matricula_aluno`, `telefone_aluno`, `cod_curso`, `nome_curso`, `periodo_letivo`, `email_aluno`, `turma`, `turno`, `status_estagio`, `criado_em`, `criado_por`, `editado_em`, `editado_por`, `id_setor`) VALUES
(2, 'DARIO HUGO BALBINO DA CRUZ', '2016105444', 'Não cadastrado', 1016, 'MEDICINA VETERINÁRIA', '20242', 'dariohugo0897@gmail.com', 'VET108-10', NULL, 0, '2024-09-13 14:05:48', '2016105444', '2024-09-13 14:05:48', '2016105444', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `coordenador`
--

CREATE TABLE `coordenador` (
  `id_coordenador` int(11) NOT NULL,
  `nome_coordenador` varchar(255) NOT NULL,
  `matricula_coordenador` int(11) NOT NULL,
  `nome_curso` varchar(255) NOT NULL,
  `cod_curso` int(11) NOT NULL,
  `criado_em` datetime NOT NULL,
  `criado_por` varchar(255) NOT NULL,
  `editado_em` datetime NOT NULL,
  `editado_por` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `registro_frequencia`
--

CREATE TABLE `registro_frequencia` (
  `id_registro` int(11) NOT NULL,
  `status_registro` varchar(255) NOT NULL,
  `data_referencia` datetime NOT NULL,
  `aprovado_por` varchar(255) NOT NULL,
  `entrada_1` datetime NOT NULL,
  `saida_1` datetime NOT NULL,
  `entrada_2` datetime NOT NULL,
  `saida_2` datetime NOT NULL,
  `criado_em` datetime NOT NULL,
  `criado_por` varchar(255) NOT NULL,
  `editado_em` datetime NOT NULL,
  `editado_por` varchar(255) NOT NULL,
  `id_aluno` int(11) NOT NULL,
  `id_setor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `setor`
--

CREATE TABLE `setor` (
  `id_setor` int(11) NOT NULL,
  `nome_setor` varchar(255) NOT NULL,
  `nome_curso` varchar(255) NOT NULL,
  `cod_curso` int(11) NOT NULL,
  `token_qrcode` int(11) NOT NULL,
  `data_expiracao_token` datetime NOT NULL,
  `criado_em` datetime NOT NULL,
  `criado_por` varchar(255) NOT NULL,
  `editado_em` datetime NOT NULL,
  `editado_por` varchar(255) NOT NULL,
  `id_aluno` int(11) NOT NULL,
  `id_supervisor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `supervisor`
--

CREATE TABLE `supervisor` (
  `id_supervisor` int(11) NOT NULL,
  `nome_supervisor` varchar(255) NOT NULL,
  `cod_curso` int(11) NOT NULL,
  `nome_curso` varchar(255) NOT NULL,
  `criado_em` datetime NOT NULL,
  `criado_por` varchar(255) NOT NULL,
  `editado_em` datetime NOT NULL,
  `editado_por` varchar(255) NOT NULL,
  `id_setor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`id_aluno`),
  ADD UNIQUE KEY `matricula_aluno` (`matricula_aluno`,`cod_curso`,`periodo_letivo`,`turma`);

--
-- Índices de tabela `coordenador`
--
ALTER TABLE `coordenador`
  ADD PRIMARY KEY (`id_coordenador`);

--
-- Índices de tabela `registro_frequencia`
--
ALTER TABLE `registro_frequencia`
  ADD PRIMARY KEY (`id_registro`);

--
-- Índices de tabela `setor`
--
ALTER TABLE `setor`
  ADD PRIMARY KEY (`id_setor`);

--
-- Índices de tabela `supervisor`
--
ALTER TABLE `supervisor`
  ADD PRIMARY KEY (`id_supervisor`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `aluno`
--
ALTER TABLE `aluno`
  MODIFY `id_aluno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `coordenador`
--
ALTER TABLE `coordenador`
  MODIFY `id_coordenador` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `registro_frequencia`
--
ALTER TABLE `registro_frequencia`
  MODIFY `id_registro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `setor`
--
ALTER TABLE `setor`
  MODIFY `id_setor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `supervisor`
--
ALTER TABLE `supervisor`
  MODIFY `id_supervisor` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
