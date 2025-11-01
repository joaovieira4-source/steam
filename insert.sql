
USE mydb;

INSERT INTO categoria (nome, descricao) VALUES
('Ação', 'Jogos de ação e combate'),
('Aventura', 'Jogos de exploração e narrativa'),
('RPG', 'Jogos de interpretação de personagens'),
('Esportes', 'Jogos esportivos'),
('Corrida', 'Jogos de corrida'),
('Simulação', 'Jogos simuladores'),
('Estratégia', 'Jogos estratégicos'),
('Terror', 'Jogos com temática de horror'),
('Puzzle', 'Jogos de quebra-cabeça'),
('Plataforma', 'Jogos de plataforma');
INSERT INTO tb_usuario (nome, email, senha) VALUES
('Joao Silva', 'joao@email.com', '123'),
('Maria Souza', 'maria@email.com', '123'),
('Carlos Lima', 'carlos@email.com', '123'),
('Ana Santos', 'ana@email.com', '123'),
('Lucas Rocha', 'lucas@email.com', '123'),
('Julia Alves', 'julia@email.com', '123'),
('Roberto Dias', 'roberto@email.com', '123'),
('Fernanda Costa', 'fernanda@email.com', '123'),
('Diego Ramos', 'diego@email.com', '123'),
('Beatriz Melo', 'beatriz@email.com', '123');
INSERT INTO tb_adm (nome, email, senha) VALUES
('Admin1', 'adm1@loja.com', '123'),
('Admin2', 'adm2@loja.com', '123'),
('Admin3', 'adm3@loja.com', '123'),
('Admin4', 'adm4@loja.com', '123'),
('Admin5', 'adm5@loja.com', '123'),
('Admin6', 'adm6@loja.com', '123'),
('Admin7', 'adm7@loja.com', '123'),
('Admin8', 'adm8@loja.com', '123'),
('Admin9', 'adm9@loja.com', '123'),
('Admin10', 'adm10@loja.com', '123');
INSERT INTO tb_jogos (titulo, descricao, preco, foto, estoque, plataforma, categoria_id, adm_id) VALUES
('God of War', 'Ação com Kratos', 199.90, 'god.jpg', 50, 'PlayStation', 1, 1),
('Zelda TOTK', 'Aventura em mundo aberto', 349.90, 'zelda.jpg', 80, 'Switch', 2, 2),
('The Witcher 3', 'RPG do bruxo Geralt', 149.90, 'witcher.jpg', 100, 'PC', 3, 3),
('FIFA 24', 'Simulação de futebol', 299.90, 'fifa.jpg', 200, 'Xbox', 4, 4),
('Forza Horizon 5', 'Corrida em mundo aberto', 249.90, 'forza.jpg', 120, 'Xbox', 5, 5),
('The Sims 4', 'Simulação de vida', 99.90, 'sims.jpg', 150, 'PC', 6, 6),
('Age of Empires IV', 'Estratégia histórica', 159.90, 'aoe4.jpg', 90, 'PC', 7, 7),
('Resident Evil Village', 'Terror e sobrevivência', 199.90, 're8.jpg', 60, 'PlayStation', 8, 8),
('Tetris Effect', 'Puzzle clássico moderno', 49.90, 'tetris.jpg', 300, 'PC', 9, 9),
('Celeste', 'Plataforma indie', 59.90, 'celeste.jpg', 110, 'Switch', 9, 10);
INSERT INTO tb_usuario_jogos (usuario_id, jogo_id) VALUES
(1, 1),
(1, 3),
(2, 2),
(3, 4),
(4, 5),
(5, 6),
(6, 8),
(7, 7),
(8, 9),
(9, 10);
