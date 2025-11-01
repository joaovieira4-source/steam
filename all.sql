-- Script gerado conforme solicitado
-- Schema: mydb
-- Inclui AUTO_INCREMENT onde faltava e 20 inserts por tabela
-- Datas simbólicas: '2025-01-01'

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA mydb DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`tb_adm`
-- -----------------------------------------------------
CREATE TABLE mydb. tb_adm (
  `idtb_adm` INT NOT NULL AUTO_INCREMENT,
  `adm_nome` VARCHAR(255) NOT NULL UNIQUE,
  `adm_email` VARCHAR(255) NOT NULL UNIQUE,
  `amd_senha` VARCHAR(255)  NOT NULL UNIQUE,
  PRIMARY KEY (`idtb_adm`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `mydb`.`tb_usuarios`
-- (mantida conforme original, agora com AUTO_INCREMENT)
-- -----------------------------------------------------
CREATE TABLE  mydb.tb_usuarios (
  `id_usuarios` INT NOT NULL AUTO_INCREMENT,
  `usuarios_nome` VARCHAR(255)  NOT NULL UNIQUE,
  `usuarios_email` VARCHAR(255)  NOT NULL UNIQUE,
  `usuarios_senha` VARCHAR(255)  NOT NULL UNIQUE,
  PRIMARY KEY (`id_usuarios`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `mydb`.`categoria`
-- -----------------------------------------------------
CREATE TABLE  mydb.categoria (
  `id_categoria` INT NOT NULL AUTO_INCREMENT,
  `categoria_nome` VARCHAR(255) NOT NULL UNIQUE,
  `categoria_descricao` VARCHAR(255) NULL,
  PRIMARY KEY (`id_categoria`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `mydb`.`tb_jogos`
-- (já tinha AUTO_INCREMENT no id_jogos; mantido)
-- -----------------------------------------------------
CREATE TABLE  mydb.tb_jogos (
  `id_jogos` INT NOT NULL AUTO_INCREMENT,
  `jogos_titulo` VARCHAR(255) NOT NULL,
  `jogos_descricao` VARCHAR(255)  NOT NULL,
  `jogos_preco` VARCHAR(255)  NOT NULL,
  `jogos_estoque` VARCHAR(255)  NOT NULL,
  `jogos_plataforma` VARCHAR(255) NULL,
`jogos_categoria` VARCHAR(255)  NOT NULL,
  `tb_adm_idtb_adm` INT NOT NULL,
  PRIMARY KEY (`id_jogos`),
  INDEX `fk_tb_jogos_tb_adm_idx` (`tb_adm_idtb_adm` ASC) VISIBLE,
  CONSTRAINT `fk_tb_jogos_tb_adm`
    FOREIGN KEY (`tb_adm_idtb_adm`)
    REFERENCES `mydb`.`tb_adm` (`idtb_adm`)
    ON DELETE NO ACTI    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `mydb`.`usuarios`
-- (esta tabela é referenciada por FKs; adiciono AUTO_INCREMENT)
-- -----------------------------------------------------
CREATE TABLE  mydb.usuarios (
  `id_usuarios` INT NOT NULL AUTO_INCREMENT,
  `usuarios_nome` VARCHAR(255)  NOT NULL UNIQUE,
  `usuarios_email` VARCHAR(255)  NOT NULL UNIQUE,
  `usuarios_senha` VARCHAR(255)  NOT NULL UNIQUE,
  `usuarios_telefone` CHAR(15)  NOT NULL UNIQUE,
  PRIMARY KEY (`id_usuarios`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `mydb`.`carrinho`
-- -----------------------------------------------------
CREATE TABLE  mydb.carrinho (
  `id_carrinho` INT NOT NULL AUTO_INCREMENT,
  `carrinho_status` VARCHAR(255) NULL,
  `usuarios_id_usuarios` INT NOT NULL,
  `tb_jogos_id_jogos` INT NOT NULL,
  PRIMARY KEY (`id_carrinho`),
  INDEX `fk_carrinho_usuarios1_idx` (`usuarios_id_usuarios` ASC) VISIBLE,
  INDEX `fk_carrinho_tb_jogos1_idx` (`tb_jogos_id_jogos` ASC) VISIBLE,
  CONSTRAINT `fk_carrinho_usuarios1`
    FOREIGN KEY (`usuarios_id_usuarios`)
    REFERENCES `mydb`.`usuarios` (`id_usuarios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_carrinho_tb_jogos1`
    FOREIGN KEY (`tb_jogos_id_jogos`)
    REFERENCES `mydb`.`tb_jogos` (`id_jogos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `mydb`.`pagamento`
-- -----------------------------------------------------
CREATE TABLE  mydb.pagamento (
  `id_pagamento` INT NOT NULL AUTO_INCREMENT,
  `forma_pagamento` VARCHAR(255)  NOT NULL,
  `data_pagamento` VARCHAR(255) NULL,
  `usuarios_id_usuarios` INT NOT NULL,
  PRIMARY KEY (`id_pagamento`),
  INDEX `fk_pagamento_usuarios1_idx` (`usuarios_id_usuarios` ASC) VISIBLE,
  CONSTRAINT `fk_pagamento_usuarios1`
    FOREIGN KEY (`usuarios_id_usuarios`)
    REFERENCES `mydb`.`usuarios` (`id_usuarios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Inserts para a tabela `mydb.tb_adm`
-- -----------------------------------------------------
INSERT INTO `mydb`.`tb_adm` (`adm_nome`, `adm_email`, `amd_senha`) VALUES
('Admin 1', 'admin1@lojaexemplo.com', '123'),
('Admin 2', 'admin2@lojaexemplo.com', '234'),
('Admin 3', 'admin3@lojaexemplo.com', '345'),
('Admin 4', 'admin4@lojaexemplo.com', '456'),
('Admin 5', 'admin5@lojaexemplo.com', '567'),
('Admin 6', 'admin6@lojaexemplo.com', '678'),
('Admin 7', 'admin7@lojaexemplo.com', '789'),
('Admin 8', 'admin8@lojaexemplo.com', '890'),
('Admin 9', 'admin9@lojaexemplo.com', '901'),
('Admin 10', 'admin10@lojaexemplo.com', '112'),
('Admin 11', 'admin11@lojaexemplo.com', '223'),
('Admin 12', 'admin12@lojaexemplo.com', '334'),
('Admin 13', 'admin13@lojaexemplo.com', '445'),
('Admin 14', 'admin14@lojaexemplo.com', '556'),
('Admin 15', 'admin15@lojaexemplo.com', '667'),
('Admin 16', 'admin16@lojaexemplo.com', '778'),
('Admin 17', 'admin17@lojaexemplo.com', '889'),
('Admin 18', 'admin18@lojaexemplo.com', '990'),
('Admin 19', 'admin19@lojaexemplo.com', '111'),
('Admin 20', 'admin20@lojaexemplo.com', '222');

-- -----------------------------------------------------
-- Inserts para a tabela `mydb.tb_usuarios`
-- -----------------------------------------------------
INSERT INTO `mydb`.`tb_usuarios` (`usuarios_nome`, `usuarios_email`, `usuarios_senha`) VALUES
('Cliente 1', 'cliente1@gmail.com', '123'),
('Cliente 2', 'cliente2@gmail.com', '234'),
('Cliente 3', 'cliente3@gmail.com', '345'),
('Cliente 4', 'cliente4@gmail.com', '456'),
('Cliente 5', 'cliente5@gmail.com', '567'),
('Cliente 6', 'cliente6@gmail.com', '678'),
('Cliente 7', 'cliente7@gmail.com', '789'),
('Cliente 8', 'cliente8@gmail.com', '890'),
('Cliente 9', 'cliente9@gmail.com', '901'),
('Cliente 10', 'cliente10@gmail.com', '112'),
('Cliente 11', 'cliente11@gmail.com', '223'),
('Cliente 12', 'cliente12@gmail.com', '334'),
('Cliente 13', 'cliente13@gmail.com', '445'),
('Cliente 14', 'cliente14@gmail.com', '556'),
('Cliente 15', 'cliente15@gmail.com', '667'),
('Cliente 16', 'cliente16@gmail.com', '778'),
('Cliente 17', 'cliente17@gmail.com', '889'),
('Cliente 18', 'cliente18@gmail.com', '990'),
('Cliente 19', 'cliente19@gmail.com', '111'),
('Cliente 20', 'cliente20@gmail.com', '222');

-- -----------------------------------------------------
-- Inserts para a tabela `mydb.categoria`
-- -----------------------------------------------------
INSERT INTO `mydb`.`categoria` (`categoria_nome`, `categoria_descricao`) VALUES
('Ação', 'Jogos de ação com combate e aventura'),
('Aventura', 'Jogos com narrativas envolventes e exploração'),
('Esportes', 'Jogos que simulam esportes reais ou fictícios'),
('RPG', 'Jogos de interpretação de papéis'),
('Estratégia', 'Jogos de planejamento e tomada de decisões'),
('Corrida', 'Jogos de corrida e velocidade'),
('Simulação', 'Jogos que simulam atividades do mundo real'),
('Luta', 'Jogos de combate corpo a corpo'),
('Plataforma', 'Jogos com a mecânica de pular e escalar plataformas'),
('Puzzle', 'Jogos de quebra-cabeças e lógica'),
('Terror', 'Jogos de suspense e medo'),
('Aventura Gráfica', 'Jogos com elementos de aventura e resolução de enigmas'),
('Futebol', 'Simulação de futebol'),
('Tiro', 'Jogos de tiro em primeira ou terceira pessoa'),
('Luta Livre', 'Jogos de luta estilo WWE'),
('Simulador de Vida', 'Simulações de vida real e relacionamentos'),
('Survival', 'Jogos de sobrevivência em ambientes hostis'),
('Casual', 'Jogos para relaxamento e diversão rápida'),
('Indie', 'Jogos independentes criados por pequenos estúdios'),
('Mobile', 'Jogos para dispositivos móveis');

-- -----------------------------------------------------
-- Inserts para a tabela `mydb.tb_jogos`
-- -----------------------------------------------------
INSERT INTO `mydb`.`tb_jogos` (`jogos_titulo`, `jogos_descricao`, `jogos_preco`, `jogos_estoque`, `jogos_plataforma`, `jogos_categoria`, `tb_adm_idtb_adm`) VALUES
('Super Aventura', 'Jogo de ação e aventura no mundo aberto', '49.99', '100', 'PC', 'Ação', 1),
('Futebol Pro', 'Simulação de futebol com times reais', '59.99', '200', 'PS4', 'Esportes', 2),
('RPG Fantasia', 'Jogo de RPG com magia e fantasia', '79.99', '150', 'Xbox', 'RPG', 3),
('Corrida Radical', 'Jogo de corrida com carros tunados', '39.99', '120', 'PC', 'Corrida', 4),
('Puzzle Mania', 'Jogo de quebra-cabeças desafiadores', '19.99', '180', 'Switch', 'Puzzle', 5),
('Simulador de Vida', 'Simulação de vida real com escolhas', '29.99', '250', 'PC', 'Simulação', 6),
('Tiro Mortal', 'Jogo de tiro em primeira pessoa', '69.99', '80', 'PS5', 'Tiro', 7),
('Luta Livre', 'Simulação de luta livre estilo WWE', '59.99', '90', 'PS4', 'Luta', 8),
('Aventura Gráfica', 'Jogo de aventura com gráficos cinematográficos', '89.99', '60', 'PC', 'Aventura Gráfica', 9),
('Horror Extremo', 'Jogo de terror com cenas assustadoras', '69.99', '70', 'PC', 'Terror', 10),
('Survival Island', 'Jogo de sobrevivência em uma ilha deserta', '49.99', '140', 'Xbox', 'Survival', 11),
('Indie Spirit', 'Jogo indie com mecânicas únicas', '19.99', '160', 'Switch', 'Indie', 12),
('Jogo de Luta', 'Jogo de luta 2D com personagens diversos', '29.99', '200', 'PC', 'Luta', 13),
('Aventura Espacial', 'Explore o universo em uma aventura épica', '79.99', '120', 'PS4', 'Aventura', 14),
('Futebol Manager', 'Simulador de gestão de times de futebol', '59.99', '300', 'PC', 'Esportes', 15),
('Plataforma Hero', 'Jogo de plataforma com heróis e inimigos', '39.99', '130', 'Switch', 'Plataforma', 16),
('Corrida Extreme', 'Corrida de motos em alta velocidade', '49.99', '90', 'PC', 'Corrida', 17),
('Terror Psicológico', 'Jogo de terror psicológico com enigmas', '69.99', '50', 'PS5', 'Terror', 18),
('Simulador de Fazenda', 'Simulação de vida em uma fazenda', '29.99', '110', 'Switch', 'Simulação', 19),
('Jogo de Aventura', 'Aventura com exploração e ação', '59.99', '200', 'PC', 'Aventura', 20);

-- -----------------------------------------------------
-- Inserts para a tabela `mydb.usuarios`
-- -----------------------------------------------------
INSERT INTO `mydb`.`usuarios` (`usuarios_nome`, `usuarios_email`, `usuarios_senha`, `usuarios_telefone`) VALUES
('Cliente 1', 'cliente1@gmail.com', '101', '1234567890'),
('Cliente 2', 'cliente2@gmail.com', '102', '1234567891'),
('Cliente 3', 'cliente3@gmail.com', '103', '1234567892'),
('Cliente 4', 'cliente4@gmail.com', '104', '1234567893'),
('Cliente 5', 'cliente5@gmail.com', '105', '1234567894'),
('Cliente 6', 'cliente6@gmail.com', '106', '1234567895'),
('Cliente 7', 'cliente7@gmail.com', '107', '1234567896'),
('Cliente 8', 'cliente8@gmail.com', '108', '1234567897'),
('Cliente 9', 'cliente9@gmail.com', '109', '1234567898'),
('Cliente 10', 'cliente10@gmail.com', '110', '1234567899'),
('Cliente 11', 'cliente11@gmail.com', '111', '1234567800'),
('Cliente 12', 'cliente12@gmail.com', '112', '1234567801'),
('Cliente 13', 'cliente13@gmail.com', '113', '1234567802'),
('Cliente 14', 'cliente14@gmail.com', '114', '1234567803'),
('Cliente 15', 'cliente15@gmail.com', '115', '1234567804'),
('Cliente 16', 'cliente16@gmail.com', '116', '1234567805'),
('Cliente 17', 'cliente17@gmail.com', '117', '1234567806'),
('Cliente 18', 'cliente18@gmail.com', '118', '1234567807'),
('Cliente 19', 'cliente19@gmail.com', '119', '1234567808'),
('Cliente 20', 'cliente20@gmail.com', '120', '1234567809');

-- -----------------------------------------------------
-- Inserts para a tabela `mydb.carrinho`
-- -----------------------------------------------------
INSERT INTO `mydb`.`carrinho` (`carrinho_status`, `usuarios_id_usuarios`, `tb_jogos_id_jogos`) VALUES
('Em andamento', 1, 5),
('Em andamento', 2, 10),
('Finalizado', 3, 15),
('Em andamento', 4, 20),
('Em andamento', 5, 25),
('Finalizado', 6, 30),
('Em andamento', 7, 35),
('Em andamento', 8, 40),
('Finalizado', 9, 45),
('Em andamento', 10, 50),
('Em andamento', 11, 55),
('Finalizado', 12, 60),
('Em andamento', 13, 65),
('Em andamento', 14, 70),
('Finalizado', 15, 75),
('Em andamento', 16, 80),
('Em andamento', 17, 85),
('Finalizado', 18, 90),
('Em andamento', 19, 95),
('Finalizado', 20, 100);

-- -----------------------------------------------------
-- Inserts para a tabela `mydb.pagamento`
-- -----------------------------------------------------
INSERT INTO `mydb`.`pagamento` (`forma_pagamento`, `data_pagamento`, `usuarios_id_usuarios`) VALUES
('Cartão de Crédito', '2025-01-01', 1),
('Boleto Bancário', '2025-01-02', 2),
('PayPal', '2025-01-03', 3),
('Cartão de Crédito', '2025-01-04', 4),
('Boleto Bancário', '2025-01-05', 5),
('PayPal', '2025-01-06', 6),
('Cartão de Crédito', '2025-01-07', 7),
('Boleto Bancário', '2025-01-08', 8),
('PayPal', '2025-01-09', 9),
('Cartão de Crédito', '2025-01-10', 10),
('Boleto Bancário', '2025-01-11', 11),
('PayPal', '2025-01-12', 12),
('Cartão de Crédito', '2025-01-13', 13),
('Boleto Bancário', '2025-01-14', 14),
('PayPal', '2025-01-15', 15),
('Cartão de Crédito', '2025-01-16', 16),
('Boleto Bancário', '2025-01-17', 17),
('PayPal', '2025-01-18', 18),
('Cartão de Crédito', '2025-01-19', 19),
('Boleto Bancário', '2025-01-20', 20);

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
