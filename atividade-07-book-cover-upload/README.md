# Atividade 07.0 – Upload de Imagem para Capa do Livro

**Desenvolvimento Web 2 – IFPE Campus Igarassu (2025)**

Esta atividade teve como objetivo integrar ao sistema de biblioteca a funcionalidade de **upload de imagem para capa dos livros**, permitindo adicionar, atualizar e remover imagens associadas a cada registro. A implementação envolve manipulação de arquivos utilizando o sistema de armazenamento do Laravel, garantindo que cada livro possa possuir uma capa personalizada.

---

## Descrição

A atividade expande o CRUD da entidade **Book** desenvolvido nas etapas anteriores, adicionando suporte ao envio opcional de uma imagem de capa durante o cadastro e edição de livros.

Foram definidos os seguintes comportamentos:

- O usuário pode fazer upload de uma imagem ao criar um livro.  
- Caso nenhuma imagem seja enviada, o sistema deve exibir uma **capa padrão** ou deixar a área em branco.  
- Na edição do livro, o usuário pode **substituir a imagem existente**, e a imagem anterior deve ser removida do storage.  
- Ao deletar um livro, sua imagem também deve ser removida automaticamente do sistema de arquivos.  
- As seeds do projeto podem precisar ser atualizadas para preencher o campo da imagem quando necessário.

O desenvolvimento utiliza os recursos do Laravel Filesystem, conforme documentação oficial.

---

## Objetivos da Atividade

As ações realizadas nesta atividade foram:

- Adicionar campo de upload de imagem nas views de criação e edição de livros.  
- Validar arquivos de imagem seguindo regras apropriadas (tipo, tamanho, extensão).  
- Armazenar a imagem no diretório `storage/app/public/books`.  
- Salvar no banco apenas o caminho da imagem.  
- Exibir a capa do livro nas páginas de listagem, visualização e edição.  
- Remover a imagem antiga ao atualizar a capa.  
- Implementar a exclusão da imagem quando o livro é deletado.  
- Ajustar seeds para considerar livros sem capa ou com capa padrão.  

---

### Aprendi a:

Durante esta atividade, desenvolvi habilidades relevantes, como:

Manipular uploads de arquivos com o **Filesystem do Laravel**  
Gerenciar imagens dentro do diretório `storage` e publicar arquivos com `storage:link`  
Criar campos opcionais e tratar a ausência de imagem com fallback visual  
Implementar lógica para remoção automática de arquivos  
Atualizar registros de forma segura mantendo consistência entre banco e storage  
Aplicar boas práticas no fluxo de edição envolvendo substituição de arquivos  
Melhorar a experiência do usuário exibindo capas nos detalhes e listagens  

---

### Requisitos

- Projeto Laravel funcional e configurado  
- CRUD completo da entidade Book finalizado  
- Diretório `storage` vinculado ao `public` via `php artisan storage:link`  
- Bootstrap instalado para estilização  
- Biblioteca GD ou ImageMagick instalada no servidor (dependendo da manipulação da imagem)  
- Permissões adequadas para escrita no diretório de storage  

---