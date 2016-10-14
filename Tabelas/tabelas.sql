CREATE TABLE Aluno (
 id integer NOT NULL,
 cpf character varying(11) NOT NULL,
 rg integer NOT NULL,
 data_nascimento date NOT NULL,
 nome character varying(40) NOT NULL,
 telefone character varying(15) NOT NULL,	
 CONSTRAINT Aluno_pkey PRIMARY KEY (id)
);

CREATE TABLE Periodo (
 id integer NOT NULL, 
 descricao character varying(10) NOT NULL, 
 CONSTRAINT Periodo_pkey PRIMARY KEY (id)
);
INSERT INTO Periodo (id, descricao) VALUES (1,'Matutino');
INSERT INTO Periodo (id, descricao) VALUES (2,'Vespertino');
INSERT INTO Periodo (id, descricao) VALUES (3,'Integral');

CREATE TABLE Curso (
 id integer NOT NULL, 
 nome character varying(40) NOT NULL,
 valor_inscricao numeric(19,2) NOT NULL,
 periodo integer NOT NULL references Periodo(id),
 CONSTRAINT Curso_pkey PRIMARY KEY (id)
);

CREATE TABLE Matricula (
 id integer NOT NULL,
 aluno_id integer NOT NULL references Aluno(id),
 curso_id integer NOT NULL references Curso(id),		 
 data_matricula date NOT NULL,
 ano integer NOT NULL,
 ativo integer NOT NULL,
 pago integer NOT NULL,
 CONSTRAINT Matricula_pkey PRIMARY KEY (id)
)