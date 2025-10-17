# Atividade 04 – Relacionamento N:N e Eloquent ORM no Laravel

**Desenvolvimento Web 2 – IFPE Campus Igarassu (2025)**

Esta atividade é composta por duas partes integradas:

- **Atividade 04.1 – Inclusão de Relacionamento N:N Empréstimo**
- **Atividade 04.2 – Uso do Eloquent para Criação e Manipulação de Relacionamentos no Sistema de Biblioteca**

---

## Descrição

Nesta atividade eu apliquei os conceitos de **relacionamento N:N** utilizando o **Eloquent ORM** do Laravel, criando uma estrutura funcional de empréstimos de livros em um sistema de biblioteca.  

Implementei uma tabela intermediária (`borrowings`) para gerenciar os registros de quais livros foram emprestados por quais usuários, com as respectivas datas de empréstimo e devolução.  

Também utilizei **factories**, **seeders** e os métodos nativos do Eloquent para gerenciar e consultar esses relacionamentos de forma prática e eficiente.

---
## Objetivos da Atividade

O objetivo foi construir um novo projeto Laravel, configurá-lo corretamente e implementar a funcionalidade de **empréstimos de livros**, usando relacionamentos N:N com o Eloquent ORM e testes com **Tinker**.

As ações realizadas foram:

- Criar um novo projeto Laravel e realizar toda a configuração inicial do ambiente, incluindo o arquivo `.env`, conexão com o banco de dados e instalação das dependências.
- Criar e aplicar as **migrations** para estruturar o banco de dados com as tabelas `books`, `authors`, `categories`, `publishers` 
- Criar uma nova tabela intermediária chamada `borrowings` para registrar os empréstimos entre usuários e livros.
- Definir corretamente os relacionamentos entre as entidades usando os recursos nativos do Laravel (Eloquent ORM).
- Criar um modelo específico (`Borrowing`) para representar os empréstimos no sistema.
- Atualizar os modelos existentes (`User` e `Book`) para refletir a nova estrutura de relacionamento.
- Criar uma factory exclusiva para geração automática de dados fake de empréstimos.
- Criar um seeder responsável por popular o banco de dados com registros variados de empréstimos.
- Executar os comandos do Laravel Artisan para aplicar as migrations, rodar os seeders e garantir que o sistema funcione corretamente.
- Consolidar o funcionamento geral do sistema de biblioteca, agora com a capacidade de registrar, consultar e testar empréstimos entre usuários e livros.

### Aprendi a Trabalhar com o **Tinker** para testar comandos, fazer consultas e validar dados.  
- Aplicar conceitos de **Lazy Loading** e **Eager Loading**.  
- Analisar e comparar desempenho de consultas com e sem otimizações.  
- Utilizar funções agregadas (`avg`, `sum`, `min`, `max`) para análises estatísticas.  
- Criar novos registros diretamente no Tinker com relacionamentos completos.

---

## Pré-requisitos e Preparação do Ambiente

Antes de iniciar a atividade, foi necessário garantir o ambiente de desenvolvimento corretamente configurado para evitar falhas durante a criação das tabelas, relacionamentos e povoamento do banco.

### Requisitos

- PHP instalado  
- Composer configurado (gerenciador de dependências do PHP)  
- MySQL  
- Laravel instalado corretamente no projeto  
- Git configurado para versionamento