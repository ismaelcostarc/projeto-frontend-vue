# projeto-frontend-vue

# Projeto Laravel + Vue

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
        -   id int not null PK
        -   cpf int not null
        -   name string not null
        -   password string not null

    - Customers
        -   id int not null PK
        -   cpf string not null
        -   attendent_id FK
        -   email string not null
        -   name string not null
        -   phone string not null
        -   zipcode string
        -   state string
        -   city string
        -   birth string
        -   password string not null

    - Schedulings
        -   id int not null PK
        -   customer_it not null FK
        -   date date not null
        -   hour int not null
        -   health_insurance string not null
        -   place string not null

### Endpoints

| Verbo HTTP | Endpoint | Ação | Formato do corpo da requisição JSON | Necessita estar logado? | Perfil |
| --- | --- | --- | --- | --- | --- |
| GET | api?cpf={cpf} | Checa se o CPF passado na Query String já está registrado | { } | Não | Público |
| GET | api/customers | Retorna um json com a primeira página com 15 clientes e informações sobre as páginas, ou caso seja cliente retorna as informações do cliente logado | { } | Sim | Atendente |
| GET | api/customers?pageSize={pageSize} | Retorna um json com a primeira página com a quantidade informada de clientes e informações sobre as páginas | { } | Sim | Atendente |
| GET | api/customers?pageSize={pageSize}&page={pageNumber} | Retorna um json com a página e a quantidade de clientes informados e informações sobre as páginas | { } | Sim | Atendente |
| GET | api/customers/{id} | Retorna o cliente informado | { } | Sim | Atendente/Cliente |
| POST | api/customers | Insere um novo cliente | {<br>&emsp;cpf: "cpf",<br>&emsp;password: "senha",<br>&emsp;name: "nome",<br>&emsp;email: "email",<br>&emsp;phone: "telefone",<br>&emsp;birthday: "data de nascimento" //Opcional<br>} | Não | Público/Atendente |
| DELETE | api/customers/{id} | Apaga um cliente | | Sim | Atendente |
| PATCH | api/customers/{id} | Atualiza um cliente | | Sim | Atendente |
| POST | api/login | Realiza o login | | Não | Público |
| GET | api/logout | Realiza o logout | | Sim | Atendente\Cliente |

### Consumindo a API

Para evitar problemas, ao enviar requisições utilizar o header "Accept: application/json". Após logar utilizar o token retornado no Header das novas requisições para ser autenticado. Ex: "Authorization: Bearer {token}".
