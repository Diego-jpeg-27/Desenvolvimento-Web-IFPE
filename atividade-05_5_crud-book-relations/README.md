# Atividade 05.5 – Controller, Rotas e Views para a Entidade Book

**Desenvolvimento Web 2 – IFPE Campus Igarassu (2025)**

Esta atividade teve como objetivo construir toda a estrutura de operações da entidade **Book**, implementando **Controllers**, **Views**, rotas específicas e rotas RESTful, além de duas abordagens diferentes para a operação de criação: uma baseada em **entrada manual de IDs** e outra utilizando **campos select**, tornando a interação mais intuitiva para o usuário.

---

## Descrição

Nesta etapa, desenvolvi todas as funcionalidades necessárias para gerenciar livros dentro do sistema, considerando que a entidade Book possui relacionamentos diretos com **Author**, **Publisher** e **Category**.

Foram criadas duas versões distintas para a funcionalidade de cadastro:

- Uma versão em que o usuário informa manualmente os IDs das entidades relacionadas.  
- Uma segunda versão que utiliza listas dropdown para selecionar autor, editora e categoria, carregadas dinamicamente no formulário.

Além disso, implementei as operações de **editar**, **atualizar**, **listar**, **visualizar** e **deletar**, garantindo que os dados relacionados fossem carregados corretamente e exibidos com clareza no frontend.

---

## Objetivos da Atividade

As ações realizadas nesta atividade foram:

- Criar rotas exclusivas para as duas versões de criação da entidade Book.  
- Implementar métodos específicos no controller para cada abordagem de criação.  
- Desenvolver formulários completos com validação, usando Bootstrap como base visual.  
- Criar as páginas de:
  - criação com input de ID  
  - criação com selects  
  - edição  
  - visualização dos detalhes  
  - listagem  
- Carregar dinamicamente autores, editoras e categorias nos formulários de select.  
- Exibir na listagem o autor relacionado ao livro, com paginação.  
- Organizar o fluxo RESTful para index, show, edit, update e delete.  
- Exibir mensagens de sucesso após cada operação.  
- Garantir que todos os relacionamentos fossem carregados corretamente ao exibir detalhes.  
- Integrar paginação utilizando o template do Bootstrap.

---

### Aprendi a:

Durante esta atividade, aprimorei habilidades importantes, como:

Construção de múltiplas abordagens para a mesma ação (Create)  
Uso de relacionamentos 1:N em interfaces reais  
Aplicação de validação robusta antes de salvar dados  
Criação de formulários dinâmicos usando selects populados pelo controller  
Organização de rotas específicas coexistindo com rotas RESTful  
Exibição de dados relacionados (autor, editora e categoria) de forma clara  
Aplicação de paginação estilizada com Bootstrap  
Uso de eager loading para otimizar consultas ao banco  

---

### Requisitos

- Autenticação configurada previamente  
- Projeto Laravel funcional e totalmente configurado  
- PHP e Composer instalados  
- Node.js e NPM instalados (para compilação de assets)  
- Banco de dados MySQL configurado com as tabelas Author, Publisher, Category e Book  
- Laravel UI instalado  
- Ambiente pronto para rodar `php artisan serve` e `npm run dev`  