# Shopping Cart — Projeto de Estudo

Este repositório contém um projeto de estudo que implementa um mini-framework e uma aplicação de carrinho de compras seguindo conceitos e práticas como:

- MVC (Model-View-Controller)
- Princípios SOLID
- Clean Code
- DDD (Domain-Driven Design) — aplicação de conceitos básicos
- TDD (Test-Driven Development) — cada parte possui testes unitários quando aplicável
- Docker / docker-compose para ambiente reproducível

O objetivo é servir como material didático para aprender e demonstrar boas práticas de arquitetura e engenharia de software em PHP.

## Visão geral

Funcionalidades implementadas (estado atual):

- Estrutura de controllers, views e models (pasta `src/app`)
- Sistema de rotas mínimo (`src/config/routes.php` / `src/core/Routes.php`)
- Views públicas em `public/` com assets (CSS/JS/Imagens)
- Dockerfile e `docker-compose.yml` para orquestração do ambiente
- Testes e configuração inicial do PHPUnit (`phpunit.xml`, `tests/`)

> Nota: esta lista reflete o estado atual do repositório no momento desta documentação. Verifique a árvore de arquivos para detalhes.

## Tecnologias e ferramentas

- PHP (versão compatível definida no Dockerfile / imagem)
- Composer (autoloader em `vendor/`)
- PHPUnit (teste unitário)
- Docker e Docker Compose (ambiente com PHP-FPM + Nginx + MySQL opcional)
- Nginx (configuração em `docker/nginx.conf`)

## Estrutura do projeto (resumo)

- `src/` — código-fonte da aplicação (controllers, views, services, helpers, models)
- `public/` — ponto de entrada público e assets estáticos
- `config/` — bootstrap e rotas
- `core/` — classes do mini-framework (Controller, Routes, Uri, View)
- `tests/` — testes unitários
- `docker/` — configuração de suporte ao container
- `vendor/` — dependências geradas pelo Composer

## Como rodar (modo rápido)

Recomenda-se usar o Docker Compose incluído para criar um ambiente idêntico ao do desenvolvimento.

1) Construa e suba os containers:

```bash
docker compose up --build -d
```

2) Acesse a aplicação no navegador (por padrão):

http://localhost

Observações:
- Se a porta estiver diferente ou outra configuração for necessária, verifique `docker-compose.yml`.
- O script `docker/init/init.sh` pode preparar permissões/volumes; revise se houver necessidade.

## Executar testes

Os testes usam PHPUnit. Para rodar dentro do container (exemplo):

```bash
docker compose exec app php vendor/bin/phpunit --colors=always
```

Ou, se preferir rodar localmente (com PHP e Composer instalados):

```bash
composer install
./vendor/bin/phpunit --colors=always
```

## Checklist de qualidade / gates

Antes de marcar o projeto como finalizado, verifique:

- Build do Docker: containers sobem sem erros (PASS/FAIL)
- Testes unitários: todos os testes passam (PASS/FAIL)
- Linter / style: código legível e com padrões consistentes (sugestão: PHP_CodeSniffer)
- Vulnerabilidades conhecidas: dependências atualizadas

## Próximos passos (priorizados)

Abaixo estão as tarefas para finalizar o projeto.

1) Integração persistente (DB) e migrations — Prioridade: Alta — Esforço: Médio
   - Implementar conexão com banco (MySQL ou SQLite) via configuração (DSN em `config/`)
   - Criar repositórios e migrations básicas para entidades: Users, Products, Orders, Cart
   - Critério de aceitação: CRUD de produto funcionando e testes de repositório com DB em memória ou sqlite.

2) Funcionalidade de carrinho (persistente por sessão/usuário) — Prioridade: Alta — Esforço: Médio
   - Implementar rota/serviço para adicionar / remover itens, atualizar quantidade e finalizar pedido
   - Criar testes unitários e testes de integração que cubram fluxo do carrinho
   - Critério de aceitação: fluxo básico de compra coberto por testes automatizados

3) Autenticação e autorização simples — Prioridade: Média — Esforço: Médio
   - Implementar login/logout, middleware para rotas que exigem autenticação
   - Critério de aceitação: usuário autenticado pode acessar rota privada; testes cobrindo middleware

4) Melhorias no mini-framework (router middleware, DI básica) — Prioridade: Média — Esforço: Médio
   - Adicionar injeção de dependência simples (service container)
   - Permitir middleware por rota e grupos de rotas
   - Critério de aceitação: ability de registrar e resolver serviços em controllers e middleware testado

5) Testes e cobertura — Prioridade: Média — Esforço: Baixo–Médio
   - Aumentar cobertura de testes (controllers, services, repositórios)
   - Integrar cobertura (php-code-coverage) e badge se for publicar repo

6) Documentação e scripts dev — Prioridade: Baixa — Esforço: Baixo
   - Atualizar README (este arquivo) com exemplos de uso, diagramas simples
   - Adicionar Makefile ou scripts no composer (ex.: composer test, composer start)

7) Deploy/CI — Prioridade: Baixa — Esforço: Médio
   - Configurar pipeline básico GitHub Actions / GitLab CI para rodar build e testes em push/PR
   - Critério de aceitação: CI executa testes e build do Docker

8) Front-end aprimorado e UX — Prioridade: Baixa — Esforço: Variável
   - Tornar páginas responsivas, formulário de checkout, validação do lado cliente

## Riscos e edge cases

- Sessões e concorrência: garantir que o carrinho não perca itens em concorrência (locks ou transações)
- Validação de entrada: todas as entradas do usuário devem ser validadas e sanitizadas
- Pagamentos/segurança: não implementar lógica de pagamento real sem usar um provedor externo e sem HTTPS

## Sugestões de pequenas melhorias imediatas (quick wins)

- Adicionar um comando no `composer.json` para rodar testes (ex.: "test": "phpunit")
- Adicionar `.env.example` com variáveis necessárias (DB_DSN, APP_ENV, APP_DEBUG)
- Adicionar scripts para build e limpeza de cache em `docker/init/` ou `Makefile`

## Como contribuir

1. Fork do repositório
2. Criar branch com feature ou bugfix
3. Escrever testes que falhem para a feature/bug
4. Implementar código até os testes passarem
5. Abrir PR com descrição clara e checklist de testes

## Contato / Créditos

Projeto pessoal de estudo — use livremente para aprendizado. Para dúvidas ou sugestões, abra uma issue.

