# teste-frontend-vue

# CRUD Laravel + Vue

API em Laravel 8, com dois serviços front-end em Vue.js.
1º Serviço: Possui login, cadastro de cliente e um CRUD para o agendamento dos seus exames.
2º Serviço: Possui login, um CRUD para os clientes e um CRUD para o agendamento dos seus exames. 

## Instalação API

Para instalar as dependências dentro da pasta Backend:
```
composer install
``` 

Antes de criar as tabelas modifique o arquivo .env com as configurações do seu Banco de Dados.
Ex:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravelapi
DB_USERNAME=root
DB_PASSWORD=root
```

Para instalar as migrations para o Banco de Dados:
```
php artisan migrate
```

Para preencher o banco de dados com dados aleatórios de teste:
```
php artisan db:seed
```

Para rodar o servidor embutido do PHP:
```
php artisan serve
```

## Instalação Frontend

## Funcionamento da API

Existem três tipos de recursos, Attendents, Customers e Schedulings. Attendents não podem ser criados, apenas modificados em alguns campos. Customers podem ser criados por Attendents ou pelo site (campo id_creator igual a NULL).  Os endpoints retornam os dados em json. Para inserir dados por meio da API, os campos devem estar no body da requisição HTTP.

### Requisitos
    - Attendents
        -   cpf string not null PK
        -   name string not null
        -   password string not null

    - Customers
        -   cpf string not null PK
        -   cpf_attendent FK
        -   email string not null
        -   name string not null
        -   phone string not null
        -   zipcode string
        -   state string
        -   city string
        -   birth string
        -   password string not null

    - Schedulings
        - id int not null PK
        - customer_cpf not null
        - date date not null
        - hour int not null
        - health_insurence string not null
        - place string not null

### Endpoints

| Verbo HTTP | Endpoint           | Ação                                |
|------------|--------------------|-------------------------------------|
| GET        | api                | Raiz                                |
| GET        | api/customers      | Retorna todos os clientes           |
| GET        | api/customers/{id} | Retorna o cliente informado         |
| POST       | api/customers      | Insere um novo cliente              |
| DELETE     | api/customers/{id} | Apaga um cliente                    |
| PATCH      | api/customers/{id} | Atualiza um cliente                 |
| POST       | api/login          | Realiza o login                     |
| GET        | api/logout         | Realiza o logout                    |
| POST       | api/users/register | Registra um novo usuário            |
| GET        | api/users          | Retorna os dados do usuário logado  |
| DELETE     | api/users          | Apaga o usuário logado              |
| PATCH      | api/users          | Atualiza os dados do usuário logado |


### Consumindo a API

Para evitar problemas, ao enviar requisições utilizar o header "Accept: application/json". Após logar utilizar o token retornado no Header das novas requisições para ser autenticado. Ex: "Authorization: Bearer {token}".
