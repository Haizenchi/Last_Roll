-- Copie du schéma Last Roll. Import à faire uniquement si la BDD n'existe pas encore.
CREATE DATABASE IF NOT EXISTS last_roll CHARACTER SET utf8mb4;
USE last_roll;

CREATE TABLE IF NOT EXISTS `user` (
    id_user INT PRIMARY KEY AUTO_INCREMENT,
    nickname VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    role VARCHAR(20) NOT NULL DEFAULT 'joueur',

    CONSTRAINT chk_user_role
        CHECK (role IN ('joueur', 'admin'))
);

CREATE TABLE IF NOT EXISTS `game` (
    id_game INT PRIMARY KEY AUTO_INCREMENT,
    game_name VARCHAR(50) NOT NULL,
    game_start_date DATETIME NOT NULL,
    game_description TEXT NOT NULL,
    max_player INT NOT NULL,
    discord_link VARCHAR(2048) NOT NULL,
    platform_link VARCHAR(2048) NOT NULL,
    id_game_master INT NOT NULL,
    CONSTRAINT fk_game_master
        FOREIGN KEY (id_game_master)
        REFERENCES `user`(id_user)
        ON DELETE CASCADE,
    CONSTRAINT chk_max_player
        CHECK (max_player > 0)
);

CREATE TABLE IF NOT EXISTS `tag` (
    id_tag INT PRIMARY KEY AUTO_INCREMENT,
    tag_name VARCHAR(50) NOT NULL,
    tag_category VARCHAR(50) NOT NULL,
    CONSTRAINT uq_tag_name_category UNIQUE (tag_name, tag_category),
    CONSTRAINT chk_tag_category
        CHECK (tag_category IN ('Univers', 'Format', 'Difficulté'))
);

CREATE TABLE IF NOT EXISTS registration (
    id_user INT,
    id_game INT,
    PRIMARY KEY (id_user, id_game),
    CONSTRAINT fk_to_user
        FOREIGN KEY (id_user) REFERENCES `user`(id_user) ON DELETE CASCADE,
    CONSTRAINT fk_to_game
        FOREIGN KEY (id_game) REFERENCES `game`(id_game) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS game_tag (
    id_game INT,
    id_tag INT,
    PRIMARY KEY (id_game, id_tag),
    CONSTRAINT fk_to_game_game
        FOREIGN KEY (id_game) REFERENCES `game`(id_game) ON DELETE CASCADE,
    CONSTRAINT fk_to_tag_game_tag
        FOREIGN KEY (id_tag) REFERENCES tag(id_tag) ON DELETE CASCADE
);

-- Tags déjà insérés dans ta BDD : on évite les doublons si tu réexécutes ce fichier.
INSERT IGNORE INTO tag (tag_name, tag_category) VALUES
    ('One-Shot', 'Format'),
    ('Campagne', 'Format'),
    ('Débutant', 'Difficulté'),
    ('Confirmé', 'Difficulté'),
    ('Expert', 'Difficulté'),
    ('Donjon et Dragon', 'Univers'),
    ('Vampire La Mascarade', 'Univers'),
    ('Aria', 'Univers');
