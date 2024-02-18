

--
-- Banco de dados: `controleestoque`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `fornecedores`
--

CREATE TABLE `fornecedores` (
  `id` int(11) NOT NULL,
  `nome_fornecedor` varchar(255) NOT NULL,
  `endereco_fornecedor` varchar(255) NOT NULL,
  `telefone_fornecedor` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



--
-- Estrutura para tabela `funcionarios`
--

CREATE TABLE `funcionarios` (
  `id` int(11) NOT NULL,
  `nomeFuncionario` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




--
-- Estrutura para tabela `historico_acoes`
--

CREATE TABLE `historico_acoes` (
  `id` int(11) NOT NULL,
  `dataRegistrada` datetime NOT NULL,
  `funcionario_id` int(11) NOT NULL,
  `acao` varchar(255) NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `dadoAnterior` varchar(255) NOT NULL,
  `dadoAlterado` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- Estrutura para tabela `historico_acoes_fornecedores`
--

CREATE TABLE `historico_acoes_fornecedores` (
  `id` int(11) NOT NULL,
  `dataRegistrada` datetime NOT NULL,
  `funcionario_id` int(11) NOT NULL,
  `acao` varchar(255) NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `dadoAnterior` varchar(255) NOT NULL,
  `dadoAlterado` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome_produto` varchar(255) NOT NULL,
  `descricao_produto` varchar(255) NOT NULL,
  `preco_produto` varchar(255) NOT NULL,
  `quantidade_estoque` varchar(255) NOT NULL,
  `id_fornecedor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

