CREATE DATABASE outback_palmas
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE outback_palmas;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(120) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    telefone VARCHAR(20),
    senha VARCHAR(255) NOT NULL,
    tipo ENUM('cliente', 'admin') DEFAULT 'cliente',
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );

    INSERT INTO usuarios
(nome, email, telefone, senha, tipo)
VALUES
(
    'Administrador',
    'admin@outbackpalmas.local',
    '63999999999',
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2uheWG/igi.',
    'admin'
);

CREATE TABLE reservas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    data_reserva DATE NOT NULL,
    horario TIME NOT NULL,
    quantidade_pessoas INT NOT NULL,
    observacoes TEXT,
    status ENUM(
        'pendente',
        'confirmada',
        'cancelada',
        'finalizada'
    ) DEFAULT 'pendente',

    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_reserva_usuario
        FOREIGN KEY (usuario_id)
        REFERENCES usuarios(id)
        ON DELETE CASCADE
);