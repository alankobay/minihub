# Minihub

Desafio Tray - Mini Hub

<br>

# Desenvolvimento

## Domínios
* * *

Para acessar a aplicação deve ser configurado o domínio `minihub.tray.local`.

Para acessar o phpMyAdmin deve ser configurado o domínio `db.minihub.tray.local`

Para isso, no arquivo hosts do seu sistema, e acrescente as linhas abaixo. No Linux, altere o arquivo `/etc/hosts`.

```
127.0.0.1 minihub.tray.local
127.0.0.1 db.minihub.tray.local
```
<br>

## Docker
* * *
Todo o projeto durante o desenvolvimento deve ser executado através do [Docker](https://www.docker.com/).

<br>

### Pré-requisitos
* * *

Docker version 20.*  
Docker Compose version v2.*

<br>

### Subindo a aplicação
* * *

O arquivo docker-compose e as configurações se encontram no diretório `.docker` na raiz do projeto.

Os comandos abaixo lhe ajudarão a fazer o build, rodar os containers em background, pará-los, e se necessários, acessar o container php da aplicação:

```shell
# Muda a pasta
cd .docker

# Realiza o build das imagens
docker compose --build

# Sobe os containers em background
docker compose up -d

# Para os containers do projeto em execução
docker compose down

# Acessa o container php 
docker exec -ti minihub-php bash

# Dentro do container execute os comandos
cp .env.example .env
php artisan migrate
php artisan db:seed
```

**Dica:** Caso de erro de permissão ao rodar os comandos acima, acrescente `sudo` antes do comando. Por padrão o docker só executa com usuário root.

* * *

### Filas
Por default o projeto está configurado para executar as filas como sync. Caso configure como `redis` é necessário entrar no container `minihub-php` e executar o comando `php artisan queue:work` ou executar o comando `docker exec -ti minihub-php php artisan queue:work` direto do terminal do computador.

* * *