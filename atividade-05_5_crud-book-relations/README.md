# Atividades 06.1 e 06.2 – Gestão de Usuários e Sistema de Empréstimos

**Desenvolvimento Web 2 – IFPE Campus Igarassu (2025)**

Estas atividades tiveram como objetivo ampliar o sistema de biblioteca com duas funcionalidades essenciais:  
1. **Gerenciamento de usuários através de Controller e Views dedicadas**.  
2. **Implementação completa de um sistema de empréstimos**, conectando livros e usuários de forma dinâmica, incluindo histórico, devoluções e rotas específicas.

---

## Descrição

Na Atividade **6.1**, foi estruturado o **UserController** responsável por listar, exibir e editar usuários já cadastrados no sistema. A criação e exclusão foram omitidas, pois o registro de usuários ocorre via autenticação padrão do Laravel.

Foram criadas as views de listagem, visualização e edição, todas integradas com Bootstrap e paginação nativa.

Na Atividade **6.2**, foi desenvolvido o **sistema de empréstimos** da biblioteca. A implementação incluiu:

- Criação do BorrowingController  
- Configuração de rotas específicas para registrar empréstimos e devoluções  
- Atualização das views de Books e Users para exibir histórico de empréstimos  
- Ajustes nos models para suporte adequado aos relacionamentos via tabela pivot  

O sistema agora permite registrar empréstimos, registrar devoluções, visualizar os livros emprestados por um usuário e o histórico de empréstimos de cada livro.

---

## Objetivos da Atividade

As ações realizadas foram:

### **Atividade 6.1 – Controller e Views de User**
- Criar o `UserController` como resource controller.  
- Implementar as operações:
  - Listar usuários (index)  
  - Visualizar um usuário (show)  
  - Editar usuário (edit e update)  
- Aplicar paginação e exibir dados em tabelas com Bootstrap.  
- Criar as views:
  - `index.blade.php`  
  - `show.blade.php`  
  - `edit.blade.php`  
- Integrar botões de navegação e feedback visual de edição.

---

### **Atividade 6.2 – Sistema de Empréstimos**
- Criar rotas específicas para:
  - Registrar empréstimos  
  - Registrar devoluções  
  - Exibir empréstimos de um usuário  
- Implementar o `BorrowingController` com:
  - Registro de empréstimos  
  - Registro de devoluções  
  - Histórico de empréstimos por usuário  
- Atualizar o método `show` do BookController para carregar lista de usuários.  
- Ajustar os models Book e User para suportar o relacionamento com pivot.  
- Atualizar as views `books.show` e `users.show` para:
  - Exibir histórico de empréstimos  
  - Mostrar status (em aberto ou devolvido)  
  - Exibir botões de ação para devolução  
- Validar dados antes de registrar um empréstimo.  
- Exibir mensagens de sucesso após as operações.  

---

### Aprendi a:

Gerenciar usuários através de controllers dedicados  
Aplicar paginação e exibição de dados com Bootstrap  
Criar relacionamentos muitos-para-muitos com tabela pivot  
Registrar e controlar empréstimos com datas de retirada e devolução  
Integrar formulários e ações personalizadas dentro de views existentes  
Exibir históricos em diferentes perspectivas (por livro e por usuário)  
Atualizar models para funcionamento correto de eager loading  
Manter padronização RESTful junto a rotas específicas de ação  

---

### Requisitos

- Autenticação configurada previamente  
- Projeto Laravel funcional e configurado  
- Models User, Book e Borrowing criados  
- PHP e Composer instalados  
- Node.js e NPM instalados  
- Banco MySQL configurado  
- Ambiente pronto para rodar `php artisan serve` e `npm run dev`  

---