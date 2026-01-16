# Toshiro Shibakita - Projeto Microsserviços

Este projeto demonstra uma arquitetura básica de microsserviços utilizando PHP, MySQL e Nginx como balanceador de carga, todos orquestrados via Docker.

## Arquitetura

O projeto é composto por três componentes principais:

1. **Nginx (Load Balancer)**: Escuta na porta `4500` e distribui as requisições para as instâncias da aplicação.
2. **App (PHP/Apache)**: Servidor web PHP que processa a lógica de negócio e interage com o banco de dados.
3. **DB (MySQL 5.7)**: Banco de dados relacional para armazenamento dos dados.

## Melhorias Realizadas

- **Segurança**: Implementação de variáveis de ambiente para credenciais de banco de dados.
- **Modernização**: Transição para `PDO` com *Prepared Statements* (evita SQL Injection).
- **Infraestrutura**: Orquestração completa via `docker-compose.yml`.
- **Resiliência**: Uso de nomes de serviço Docker em vez de IPs estáticos no Nginx.
- **Codificação**: Padronização para UTF-8.

## Como Executar

### Pré-requisitos

- Docker
- Docker Compose

### Passo a Passo

1. Clone o repositório.
2. Na raiz do projeto, execute:

    ```bash
    docker-compose up -d --build
    ```

3. Acesse a aplicação em: `http://localhost:4500`
4. Para escalar a aplicação (ex: 3 instâncias):

    ```bash
    docker-compose up -d --scale app=3
    ```

## Estrutura de Pastas

```text
├── app/          # Código fonte PHP e seu Dockerfile
├── db/           # Scripts SQL de inicialização
├── nginx/        # Configuração do Load Balancer
└── docker-compose.yml
```
