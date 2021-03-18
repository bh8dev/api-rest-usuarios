# API REST em PHP 7.4.15

Utilização de conceitos como Repository, Service, Validator e Util.

## Utilização

Alterar o arquivo bootstrap.php na pasta raiz, para configuração dos dados do ambiente.
Criar o banco api-rest e importar o script do banco de dados.

## Características e tecnologias

- PHP 7.4.15
- Modelo REST
- Orientação à Objetos(POO)
- Clean Code
- JSON
- Autoload
- Namespaces
- PDO
- MySql
- Authentication via Bearer Token
- Métodos GET, PUT, POST e DELETE

### Rotas

- **GET**
- /usuarios/listar
- /usuarios/listar/{id}

- **DELETE**
- /usuarios/deletar/{id}

- **POST**
- /usuarios/cadastrar

- **PUT**
- /usuarios/atualizar/{id}
