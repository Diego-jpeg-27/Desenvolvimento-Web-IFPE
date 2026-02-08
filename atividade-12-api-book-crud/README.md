# Atividade 12 – Implementação de API REST para Recurso de Livros

**Desenvolvimento Web 2 – IFPE Campus Igarassu (2026)**

Esta atividade teve como objetivo a implementação de uma interface de programação (API) RESTful para o recurso de livros do sistema de biblioteca. A implementação seguiu os padrões da arquitetura REST, permitindo que as operações de criação, leitura, atualização e exclusão (CRUD) sejam realizadas através de requisições HTTP e respostas padronizadas no formato JSON.

---

## Descrição

Essa atividade introduz o conceito de desacoplamento entre frontend e backend, transformando o sistema de biblioteca em um provedor de dados (*Data Provider*) capaz de se integrar com aplicações externas, dispositivos móveis ou sistemas legados.

Foram definidos os seguintes comportamentos:

+ **Padronização REST:** Utilização dos métodos HTTP corretos (GET, POST, PUT, PATCH e DELETE) para cada operação do recurso.
+ **Separação de Lógica:** Criação de controladores especializados para API, garantindo que as respostas sejam exclusivamente em JSON, independentes das Views Blade.
+ **Eager Loading:** Otimização das respostas da API para incluir automaticamente dados de autores, categorias e editoras em uma única consulta.
+ **Gestão de Mídia:** Suporte ao envio e substituição de imagens de capa de livros via endpoints de API, mantendo a integridade do armazenamento físico (Storage).
+ **Respostas Estruturadas:** Implementação de cabeçalhos HTTP e mensagens de sucesso/erro padronizadas para facilitar o consumo por desenvolvedores.
+ **Ambiente de Desenvolvimento:** Configuração do ecossistema Node.js/Vite para garantir a integridade do Kernel do Laravel durante o processamento de requisições externas.

---

## Objetivos da Atividade

As ações realizadas nesta atividade foram:

+ Instalar e configurar o suporte a rotas de API no Laravel 11 utilizando o comando `php artisan install:api`.
+ Desenvolver o `BookControllerApi` para gerenciar todas as ações do recurso `book` de forma programática.
+ Registrar as rotas de API no arquivo `routes/api.php` utilizando o recurso `apiResource`.
+ Implementar lógica de busca com tratamento de exceção `404 Not Found` para garantir a robustez da API.
+ Configurar validação de dados via API, garantindo que os erros de preenchimento sejam retornados em formato JSON (Status 422).
+ Resolver conflitos de manifesto do Vite executando `npm install` e `npm run build` para estabilizar o ambiente local.
+ Testar e validar todos os endpoints utilizando o **Postman**, enviando dados via `x-www-form-urlencoded` e `form-data`.
+ Garantir a remoção física de arquivos de imagem do servidor ao excluir um registro através da API.

---

## Aprendi a:

+ **Implementar Arquitetura RESTful:** Criação de endpoints padronizados para gerenciamento de recursos via HTTP.
+ **Configurar Rotas de API:** Instalação de middlewares de API e gerenciamento de prefixos e permissões no arquivo `api.php`.
+ **Manipular Respostas JSON:** Retorno de dados estruturados e códigos de status HTTP apropriados para cada cenário.
+ **Integrar Uploads via API:** Gerenciar o recebimento e armazenamento de arquivos binários através de ferramentas como o Postman.
+ **Otimizar Performance (N+1):** Uso do método `with()` no Eloquent para aninhamento eficiente de relacionamentos em respostas de API.
+ **Utilizar Ferramentas de Teste:** Configuração de Headers (`Accept: application/json`) e análise de payloads em ferramentas de depuração de API.
+ **Resolver Dependências de Frontend:** Diagnosticar e corrigir erros de servidor relacionados ao manifesto de compilação de assets (Vite).

---