# Atividade 05.2 – CRUD para Category, Author e Publisher com Laravel

**Desenvolvimento Web 2 – IFPE Campus Igarassu (2025)**

Esta atividade teve como objetivo a construção completa das funcionalidades **CRUD (Create, Read, Update, Delete)** para as entidades **Category**, **Author** e **Publisher**, utilizando **Controllers**, **Views com Bootstrap**, e **rotas resource** no Laravel.

---

## Descrição

Nesta etapa do projeto, implementei a lógica de CRUD para as entidades mencionadas acima, com base no padrão Resource Controller do Laravel. O `CategoryController` foi desenvolvido como referência e, a partir dele, foram replicadas as implementações para `AuthorController` e `PublisherController`.

Foram criadas interfaces visuais completas com **Bootstrap 5** e **Bootstrap Icons**, incluindo tabelas, formulários e botões padronizados, permitindo operações intuitivas no sistema.

---

## Objetivos da Atividade

As ações realizadas nesta atividade foram:

- Criar controllers com CRUD:
  - `CategoryController`
  - `AuthorController`
  - `PublisherController`
- Implementar todos os métodos resource:
  `index`, `create`, `store`, `show`, `edit`, `update`, `destroy`
- Registrar rotas RESTful com `Route::resource()`
- Criar views Blade:
  - `index.blade.php`, `create.blade.php`, `edit.blade.php`, `show.blade.php`
- Validar entradas nos formulários e exibir feedback com mensagens flash
- Testar CRUD completo no navegador
- Integrar **Bootstrap Icons** para botões
- Garantir persistência de dados no MySQL

---

### Aprendi a:

Durante esta atividade, desenvolvi competências essenciais, como:

Estruturação completa de CRUD no Laravel  
Uso correto de validação de dados no controller  
Navegação de rotas RESTful com Laravel Resource  
Componentização e reaproveitamento de layouts com Blade  
Integração de bibliotecas visuais (Bootstrap + Icons)  
Melhores práticas de UX com feedback ao usuário  

---

### Requisitos

- Autenticação configurada
- Projeto Laravel funcional e configurado
- PHP e Composer instalados
- Node.js e NPM instalados (para uso do Vite)
- Banco de dados MySQL configurado
- Laravel UI instalado via Composer
- Ambiente pronto para rodar `php artisan serve` e `npm run dev`