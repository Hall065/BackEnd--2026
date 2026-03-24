# 📄 PRD.md — Sistema de Gestão para Confecção (Completo e Escalável)

---

# 🧠 VISÃO GERAL

Este projeto é um sistema web administrativo completo para gestão de uma confecção.

⚠️ IMPORTANTE:
O projeto **já existe parcialmente** e possui estrutura inicial.
O objetivo NÃO é recriar do zero, mas sim:

* Analisar o sistema atual
* Corrigir inconsistências
* Padronizar arquitetura e UI
* Expandir funcionalidades
* Tornar o sistema completo, escalável e pronto para uso real

---

# 🎯 OBJETIVO

Criar um sistema moderno, robusto e completo que permita:

* Gestão total da operação da confecção
* Controle de usuários e permissões
* Visualização clara de dados
* Escalabilidade para novas funcionalidades

---

# 🚨 REGRA CRÍTICA (OBRIGATÓRIO)

Antes de qualquer implementação:

1. Analisar TODO o projeto existente
2. Mapear:

   * Estrutura de pastas
   * Telas já criadas
   * Componentes
   * Rotas
   * APIs
3. NÃO ignorar código existente
4. NÃO recriar o que já existe
5. Evoluir em cima do que já foi feito

---

# 👥 TIPOS DE USUÁRIO

## 🔐 Admin

Tem controle TOTAL do sistema:

* Gerenciar usuários
* Criar, editar e remover dados
* Controlar o que aparece para usuários
* Editar conteúdo da landing page
* Gerenciar permissões
* Acessar todos os módulos

---

## 👤 User

Acesso limitado:

* Visualiza apenas seus dados
* Acompanha pedidos
* Consulta produtos
* Não pode alterar dados críticos

---

# 🌐 LANDING PAGE

## Objetivo:

Vender a empresa e apresentar o sistema

## Deve conter:

* Hero section chamativa
* Apresentação da confecção
* Produtos em destaque
* CTA (Login / Cadastro)
* Layout moderno e minimalista

## Admin pode:

* Editar textos
* Alterar imagens
* Controlar seções exibidas

---

# 🔑 AUTENTICAÇÃO

* Login
* Cadastro (opcional controlado pelo admin)
* Recuperação de senha
* Controle de sessão

---

# 🧩 MÓDULOS DO SISTEMA

O sistema deve conter os seguintes módulos completos:

---

## 👥 Clientes

* Cadastro completo
* Listagem
* Edição
* Exclusão
* Histórico de pedidos

Campos:

* Nome
* CPF/CNPJ
* Contato
* Endereço

---

## 🏭 Fornecedores

* Cadastro completo
* Controle de insumos fornecidos

---

## 📦 Produtos

* Cadastro de produtos
* Controle de estoque
* Categorias
* Variações (tamanho, cor)

Campos:

* Nome
* Código
* Preço
* Estoque
* Categoria

---

## 🧵 Insumos (Matéria-prima)

* Tecidos
* Linhas
* Aviamentos

Controle:

* Quantidade
* Fornecedor
* Custo

---

## 📑 Pedidos

* Criação de pedidos
* Associação com cliente
* Itens do pedido
* Status (em produção, pronto, entregue)

---

## 💰 Financeiro (IMPORTANTE)

* Entradas
* Saídas
* Relatórios
* Lucro

---

## 📊 Dashboard

* KPIs:

  * Vendas
  * Produção
  * Estoque
* Gráficos
* Atividades recentes

---

# 🧱 ARQUITETURA

Organizar o projeto em módulos:

/modules
/clientes
/fornecedores
/produtos
/insumos
/pedidos
/financeiro

/componentes reutilizáveis
/services
/hooks
/utils
/types

---

# 🎨 DESIGN SYSTEM

## Estilo

* Minimalista
* Moderno
* Limpo
* Profissional

## Tema

* Light mode
* Dark mode
* System mode

## Tecnologias

* Tailwind CSS (obrigatório)

---

## Componentes obrigatórios

* Button
* Input
* Select
* Modal
* Table (reutilizável)
* Card
* Sidebar
* Navbar
* Toast

---

## Regras

* NÃO usar estilos inline
* NÃO criar componentes duplicados
* Tudo deve ser reutilizável

---

# ✨ EXPERIÊNCIA DO USUÁRIO

* Animações suaves (hover, transições)
* Feedback visual:

  * Loading
  * Sucesso
  * Erro
* Interface fluida

---

# 📊 TABELAS (PADRÃO GLOBAL)

Todas devem ter:

* Paginação
* Busca
* Filtros
* Ordenação
* Ações (editar/excluir)
* Reutilização total

---

# 🔐 PERMISSÕES

* Controle por tipo de usuário
* Rotas protegidas
* Conteúdo dinâmico baseado no usuário

---

# 🔌 API / SERVIÇOS

Separar:

* Frontend
* Lógica
* API

Criar services como:

* clientesService
* produtosService
* pedidosService

---

# 📱 RESPONSIVIDADE

* Desktop (prioridade)
* Tablet
* Mobile (adaptável)

---

# 🧪 QUALIDADE

* Código limpo
* Sem duplicação
* Componentização forte
* Fácil manutenção

---

# 🚀 ESCALABILIDADE

O sistema deve estar preparado para:

* Novos módulos
* Novas telas
* Integrações externas
* Crescimento do banco de dados

---

# 📌 RESULTADO ESPERADO

Ao final:

* Sistema completo de gestão de confecção
* Visual moderno e consistente
* Estrutura escalável
* Código organizado
* Fácil evolução futura

---

# ⚠️ DIRETRIZES FINAIS PARA O AGENTE

* Sempre analisar antes de alterar
* Explicar decisões técnicas
* Evitar retrabalho
* Reutilizar o máximo possível
* Pensar como produto real, não como protótipo

---
