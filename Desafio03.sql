CREATE TABLE if NOT EXISTS Pessoas (  
ID   INT PRIMARY KEY,
NOME VARCHAR (40),
CPF  VARCHAR (14),
Data_de_Nascimento DATE, 
Endereco VARCHAR (100)
);

CREATE TABLE if NOT EXISTS Documentos (
ID INT PRIMARY KEY, 
ID_Pessoa INT,  
Comprovante_residência VARCHAR (100),
Currículo VARCHAR (100),
Certidão_nascimento VARCHAR (100), 
FOREIGN KEY (ID_Pessoa) REFERENCES pessoas(id)
); 

INSERT INTO pessoas VALUES 
(1, 'Bruno Costa', '111.111.111-11', '1985-07-12', 'Rua A, 100'),
(2, 'Alice Amorim', '222.222.222-22', '1990-04-07', 'Rua B, 200'),
(3, 'Pedro Souza', '333.333.333-33', '2000-01-05', 'Rua C, 300');

INSERT INTO documentos VALUES 
(1, 1, 'comp_bruno.pdf', 'curriculo_bruno.pdf', 'certidao_bruno.pdf'),
(2, 2, 'comp_alice.pdf', 'curriculo_alice.pdf', 'certidao_alice.pdf'),
(3, 3, 'comp_pedro.pdf', 'curriculo_pedro.pdf', 'certidao_pedro.pdf');

SELECT 
pessoas.NOME,
pessoas.CPF,
pessoas.Data_De_Nascimento,
pessoas.Endereco,
documentos.Comprovante_residência,
documentos.Currículo,
documentos.Certidão_Nascimento
FROM pessoas 
INNER JOIN documentos 
ON pessoas.id = documentos.ID_Pessoa;