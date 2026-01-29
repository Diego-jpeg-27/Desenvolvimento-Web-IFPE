# Atividade 11 – Implementação de Sistema de Multas por Atraso

**Desenvolvimento Web 2 – IFPE Campus Igarassu (2026)**

Esta atividade teve como objetivo integrar ao sistema de biblioteca regras financeiras para o controle de multas por atraso na devolução de livros. A implementação abrange desde o cálculo automático de débitos baseado em datas até o bloqueio preventivo de novos empréstimos para usuários inadimplentes, garantindo a integridade das regras de negócio do sistema.

---

## Descrição

Essa atividade introduz o conceito de gestão de débitos ao fluxo de empréstimos, adicionando uma camada de inteligência financeira ao relacionamento entre a entidade User e Borrowing.

Foram definidos os seguintes comportamentos:

+ Prazo e Carência: Os livros devem ser devolvidos em até 15 dias após a data de empréstimo.
+ Cálculo Automático: Em caso de atraso, o sistema calcula uma multa de R$ 0,50 por dia excedente no momento da devolução.
+ Gestão de Débitos: O valor calculado é somado ao campo debit do usuário, permitindo o acúmulo de multas de diferentes empréstimos.
+ Trava de Segurança: Usuários com qualquer valor de débito pendente são impedidos pelo sistema de realizar novos empréstimos.
+ Quitação Manual: O pagamento é realizado diretamente ao bibliotecário, que possui uma interface exclusiva para zerar o débito no sistema.
+ O desenvolvimento utilizou a biblioteca Carbon para manipulação precisa de datas e o sistema de Migrations do Laravel para evolução do banco de dados.

---

## Objetivos da Atividade

As ações realizadas nesta atividade foram:

+ Adicionar a coluna debit (tipo decimal) à tabela users via migration.
+ Configurar o fuso horário da aplicação para America/Sao_Paulo para garantir precisão nos registros de data e hora.
+ Implementar lógica no BorrowingController para calcular a diferença de dias entre o empréstimo e a devolução.
+ Utilizar intval() para tratar e sanitizar os dados de dias de atraso provenientes do Carbon.
+ Criar validação no fluxo de store de empréstimos para verificar a existência de débitos ativos.
+ Desenvolver interface na listagem de usuários para exibição clara de valores monetários formatados.
+ Implementar rota e método settleDebit para permitir a limpeza do débito pelo administrador/bibliotecário.
+ Validar todo o motor de cálculo e bloqueio utilizando o Laravel Tinker com simulações retroativas.

---

## Aprendi a:
+ Implementar Lógica de Negócios Complexa: Desenvolvimento de regras para cálculos automáticos de multas e carência.
+ Manipular Datas com Carbon: Gestão de períodos de tempo e ajuste de fusos horários (Timezone) para garantir a precisão dos registros.
+ Criar Travas de Segurança (ACL): Implementação de "pedágios" lógicos para bloquear operações de usuários inadimplentes.
+ Tratar Dados Numéricos: Uso de funções de conversão (intval) e formatação monetária (number_format) para o padrão brasileiro.
+ Gerenciar Rotas de Atualização: Criação de fluxos de quitação financeira utilizando o método PATCH e ações de atualização direta no banco de dados.
+ Utilizar o Laravel Tinker: Simulação de cenários críticos e depuração avançada de dados via linha de comando.