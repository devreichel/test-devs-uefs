# Projeto Laravel com Filament, Sanctum, Sail, Redis e MySQL

Este projeto é uma aplicação Laravel configurada para usar o Laravel Sail como ambiente de desenvolvimento. A aplicação utiliza MySQL e Redis, com autenticação via Laravel Sanctum e painel administrativo com Filament.

## Pré-requisitos

- Docker e Docker Compose
- PHP 8+
- Composer

## Instalação

Siga os passos abaixo para configurar e executar o projeto:

### Passo 2: Instale as dependências do Composer

Execute o comando para instalar as dependências do Laravel:

```bash
composer instal
```

## Passo 3: Configure o Laravel Sail

### Instale o Sail e configure o ambiente para usar MySQL e Redis:

```bash
php artisan sail:install
```

#### Escolha MySQL e Redis quando solicitado

## Passo 4: Inicie o ambiente Docker com Sail
### Inicie o ambiente Docker no modo em segundo plano:

```bash
./vendor/bin/sail up -d
```

## Passo 5: Execute as migrações

### Execute as migrações para criar as tabelas no banco de dados:

```bash
./vendor/bin/sail artisan migrate
```

## Passo 6: Instale a API

### Execute o comando abaixo para instalar a API. Se solicitado para rodar as migrações, selecione "não":

```bash
php artisan install:api
```

## Passo 7: Configure o Laravel Sanctum

### Publique os arquivos de configuração do Laravel Sanctum:

```bash
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
```

## Passo 8: Instale o Filament

### Instale o Filament, incluindo os painéis de administração:

```bash
php artisan filament:install
php artisan filament:install --panels
```

## Passo 9: Crie um usuário administrador do Filament

### Execute o comando para criar um usuário Filament:

```bash
./vendor/bin/sail php artisan make:filament-user
```

E para acessar o painel é http://localhost/admin

### Passo 10: Permissão para a pasta storage
Entre no shell como root e ajuste as permissões da pasta storage:

```bash
./vendor/bin/sail root-shell
chmod -R 775 storage
exit
```


### Modo Claro
Para utilizar o Filament no modo claro, acesse as configurações do painel Filament e configure o tema.

### Comandos Úteis
Para acessar o shell do Docker:

```bash
./vendor/bin/sail shell
./vendor/bin/sail down
```


### Rodar os testes

```bash
./vendor/bin/sail artisan test
```