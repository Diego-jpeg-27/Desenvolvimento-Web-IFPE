# Atividade 01 – Migrations com Laravel  

**Desenvolvimento Web 2** 

---

## Descrição  

Nesta atividade explorei o conceito de **Migrations no Laravel**, que são classes responsáveis por gerenciar a estrutura do banco de dados de forma programática e versionada.  
Foi uma experiência muito interessante, pois consegui entender como criar, modificar e reverter tabelas e colunas usando os comandos do **Laravel Artisan**, e percebi claramente a diferença em relação ao uso tradicional de arquivos SQL.  

---

## Objetivos da Atividade  

- Compreender o funcionamento das **Migrations** no Laravel como ferramenta de versionamento e gerenciamento de banco de dados.  
- Desenvolver um **sistema básico de biblioteca**, criando tabelas para **autores**, **categorias**, **editoras** e **livros**.  
- Definir **constraints** (chave primária, unique, nullable) e implementar **relacionamentos** entre as tabelas utilizando chaves estrangeiras com deleção em cascata.  
- Praticar o uso dos métodos **up** (aplicar alterações) e **down** (reverter alterações).  
- Utilizar comandos do **Laravel Artisan** para criar, rodar, reverter e refazer migrations.  
- Reconhecer as vantagens das migrations em comparação ao uso de scripts SQL manuais:  
  - Controle de versão do banco de dados.  
  - Automação e padronização de alterações.  
  - Facilidade de rollback e manutenção.  
  - Melhor organização e consistência no projeto.  

---

## Pré-requisitos e Preparação do Ambiente  

Antes de executar as migrations, foi necessário preparar o ambiente de desenvolvimento.  
Esse processo foi essencial para que tudo funcionasse corretamente e me ajudou a reforçar a importância de uma boa configuração inicial.  

### Requisitos  

- **PHP** instalado.  
- **Composer** configurado (gerenciador de dependências do PHP).  
- **MySQL** em execução.  
- **Laravel** instalado no projeto.  
- **Git** configurado para versionamento.  