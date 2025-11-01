# Atividade 05.1 – Autenticação com Laravel UI e Bootstrap

**Desenvolvimento Web 2 – IFPE Campus Igarassu (2025)**

Esta atividade foca na implementação da estrutura de **autenticação de usuários**, utilizando o pacote **Laravel UI** integrado com o framework CSS **Bootstrap**. O objetivo foi preparar a aplicação para proteger áreas administrativas, permitindo acesso somente a usuários autenticados.

---

## Descrição

Nesta atividade, configurei a autenticação no sistema de gerenciamento de biblioteca com o **Laravel UI**, que facilita a criação das views de login, registro e redefinição de senha, além de integrar automaticamente o **Bootstrap** ao frontend da aplicação.

O sistema agora conta com **rotas seguras de autenticação**, **controle de sessão de usuários** e **layouts estilizados com Bootstrap**, permitindo posteriormente que apenas usuários autenticados possam acessar funcionalidades administrativas.

---

## Objetivos da Atividade

O objetivo foi expandir o sistema Laravel existente, adicionando uma camada de segurança com autenticação de usuários e interface visual pronta para uso.

As ações realizadas foram:

- Instalar o pacote `laravel/ui` via Composer e configurar o Bootstrap como framework de frontend.
- Gerar o scaffolding completo de autenticação (login, registro, reset de senha) com o comando `php artisan ui bootstrap --auth`.
- Instalar e compilar os assets frontend com `npm install` e `npm run build`, utilizando o Vite para processamento dos arquivos `SCSS` e `JS`.
- Verificar a criação automática de views de autenticação em `resources/views/auth` e layouts em `resources/views/layouts`.
- Confirmar a geração dos controladores de autenticação em `App\Http\Controllers\Auth`.
- Validar que as rotas de autenticação foram corretamente adicionadas com `Auth::routes()` no arquivo `routes/web.php`.
- Acessar no navegador as rotas `/login`, `/register` e `/password/reset`, e confirmar a aplicação do Bootstrap nas páginas.
- Testar o fluxo de login e logout, incluindo persistência de sessão e registro do usuário no banco de dados.
- Verificar a geração dos arquivos compilados em `public/build/assets` para uso no frontend.

---

### Aprendi a:

- Integrar autenticação completa com **Laravel UI** e **Bootstrap** sem usar Livewire ou Inertia.
- Compilar arquivos frontend com **Vite**, entendendo o fluxo moderno de assets no Laravel.
- Validar a existência e estrutura correta das **views**, **rotas** e **controladores** de autenticação.
- Aplicar conceitos de **controle de sessão** com Laravel Auth.
- Usar `@guest` e `@auth` nas views para exibir ou ocultar links de navegação com base no status do usuário.
- Gerenciar o processo de **login, logout e registro** com segurança utilizando CSRF e `POST`.

---

## Pré-requisitos e Preparação do Ambiente

Antes de iniciar esta atividade, foi necessário garantir que todas as etapas anteriores do sistema estavam concluídas, incluindo a estrutura de dados com as tabelas `users`, `books`, `authors`, `categories`, `publishers` e `borrowings`.

### Requisitos

- Projeto Laravel funcional e configurado
- PHP e Composer instalados
- Node.js e NPM instalados (para uso do Vite)
- Banco de dados MySQL configurado
- Laravel UI instalado via Composer
- Ambiente pronto para rodar `php artisan serve` e `npm run dev`