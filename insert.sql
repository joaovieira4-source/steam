use mydb;

-- =====================================================
-- 3️⃣ INSERTS (na ordem correta)
-- =====================================================

-- 🧩 Categoria
INSERT INTO categoria (nome, descricao) VALUES
('Ação', 'Jogos com muita adrenalina e combate'),
('Aventura', 'Jogos com foco em exploração e história'),
('RPG', 'Jogos de interpretação e evolução de personagens'),
('Esportes', 'Jogos de futebol, basquete, etc.'),
('Corrida', 'Corridas de carros e motos'),
('Simulação', 'Simula a vida real ou profissões'),
('Estratégia', 'Planejamento e tática em tempo real'),
('Terror', 'Jogos assustadores e de sobrevivência'),
('Puzzle', 'Jogos de lógica e quebra-cabeça'),
('Plataforma', 'Jogos com foco em saltos e desafios');

-- 👤 Usuários
INSERT INTO tb_usuario (nome, email, senha) VALUES
('João Lucas', 'joao@exemplo.com', 'senha123'),
('Maria Silva', 'maria@exemplo.com', 'senha456'),
('Carlos Souza', 'carlos@exemplo.com', 'senha789'),
('Ana Paula', 'ana@exemplo.com', 'senha321'),
('Rafael Lima', 'rafael@exemplo.com', 'senha654'),
('Fernanda Alves', 'fernanda@exemplo.com', 'senha987'),
('Pedro Gomes', 'pedro@exemplo.com', 'senha159'),
('Juliana Rocha', 'juliana@exemplo.com', 'senha753'),
('Bruno Costa', 'bruno@exemplo.com', 'senha852'),
('Larissa Melo', 'larissa@exemplo.com', 'senha951');

-- 👨‍💼 Administradores
INSERT INTO tb_adm (nome, email, senha) VALUES
('Administrador 1', 'adm1@loja.com', 'adm001'),
('Administrador 2', 'adm2@loja.com', 'adm002'),
('Administrador 3', 'adm3@loja.com', 'adm003'),
('Administrador 4', 'adm4@loja.com', 'adm004'),
('Administrador 5', 'adm5@loja.com', 'adm005'),
('Administrador 6', 'adm6@loja.com', 'adm006'),
('Administrador 7', 'adm7@loja.com', 'adm007'),
('Administrador 8', 'adm8@loja.com', 'adm008'),
('Administrador 9', 'adm9@loja.com', 'adm009'),
('Administrador 10', 'adm10@loja.com', 'adm010');

-- 🎮 Jogos
INSERT INTO tb_jogos (titulo, descricao, preco, foto, estoque, plataforma, categoria_id, adm_id) VALUES
('God of War', 'Ação épica com Kratos em combate intenso', 199.90, 'godofwar.jpg', 50, 'PlayStation', 1, 1),
('The Witcher 3', 'RPG de mundo aberto com Geralt de Rívia', 149.90, 'witcher3.jpg', 40, 'PC', 3, 2),
('FIFA 25', 'Jogo de futebol realista da EA Sports', 299.90, 'fifa25.jpg', 80, 'Xbox', 4, 3),
('Forza Horizon 6', 'Corridas em mundo aberto e gráficos incríveis', 249.90, 'forza6.jpg', 60, 'Xbox', 5, 4),
('Minecraft', 'Construa e explore mundos infinitos em blocos', 89.90, 'minecraft.jpg', 200, 'PC', 6, 5),
('Resident Evil 9', 'Sobrevivência e terror com zumbis', 279.90, 're9.jpg', 35, 'PlayStation', 8, 6),
('Age of Empires IV', 'Estratégia em tempo real histórica', 159.90, 'aoe4.jpg', 70, 'PC', 7, 7),
('Celeste', 'Plataforma desafiadora com bela trilha sonora', 59.90, 'celeste.jpg', 120, 'Switch', 10, 8),
('Tetris Effect', 'Versão moderna do clássico puzzle', 49.90, 'tetris.jpg', 100, 'PC', 9, 9),
('Horizon Forbidden West', 'Aventura com Aloy em um mundo futurista', 299.90, 'horizon.jpg', 45, 'PlayStation', 2, 10);

-- 💳 Pagamentos
INSERT INTO pagamento (forma, data, usuario_id) VALUES
('Cartão de Crédito', '2025-10-01', 1),
('Pix', '2025-10-02', 2),
('Boleto', '2025-10-03', 3),
('Cartão de Débito', '2025-10-04', 4),
('Pix', '2025-10-05', 5),
('Transferência', '2025-10-06', 6),
('Cartão de Crédito', '2025-10-07', 7),
('Pix', '2025-10-08', 8),
('Boleto', '2025-10-09', 9),
('Cartão de Débito', '2025-10-10', 10);