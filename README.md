# apiescola-alf
### Escola- Alf API RESTFULL Construido em Php com microframework Lumen

*Alterne de branch MAIN para MASTER*

- Características:
  - De forma simples podemos cadastrar alunos, provas e gabaritos de alunos, corrigir provas retornando notas e média final.

**Antes de iniciar precisamos seguir alguns passos rápidos.** 

1. Download do Php: [PHP](https://windows.php.net/download#php-7.4) -> Opção zip na versão 7.. Thread Safe
   - Extrair arquivo em uma pasta desejada.
   - copiar o arquivo "php.ini-development" e colar na mesma pasta, renomando com o nome "php.ini".
   - abrir arquivo php.ini com editor de texto, buscar por nomes (Ctrl + f): "extension=pdo_sqlite"(*proximo linha 935*  e "extension_dir"(*proximo linha 761*), apagar o ";" do início.

- Após Instalar Php, precisamos adicionar o Php nas variaveis de ambiente.
  - Menu Iniciar -> "adicionar as variaveis de ambiente do sistema" -> Variaveis de Ambiente -> Editar variavel Path -> Novo -> Colar o caminho da pasta onde o php foi extraido. 

2. Subindo Api via localhost:
   - Menu iniciar cmd, navegar até a pasta do projeto, exemplo: cd/desktop/escola-alf
   - Após acessar a pasta digitar : php -S localhost:8000 -t public

-------------------------------------------------------------------------------------

3. Como usar?
>Todos os dados serão repassados em formato JSON

- cadastrar Aluno
```
{
  "nome": "Joao da Silva"
}
```

- cadastrar Prova, limitando a somatória dos pesos das alternativas em 10
```
{
    "gabarito": {
   
        "1":{
            "alternativa": "a",
            "peso": 1
        },

        "2":{
            "alternativa": "b",
            "peso": 1
        },

        "3":{
            "alternativa": "c",
            "peso": 1
        },

        "4":{
            "alternativa": "c",
            "peso": 1
        },

        "5":{
            "alternativa": "c",
            "peso": 1
        },

        "6":{
            "alternativa": "c",
            "peso": 1
        },

        "7":{
            "alternativa": "c",
            "peso": 1
        },

        "8":{
            "alternativa": "c",
            "peso": 1
        },

        "9":{
            "alternativa": "c",
            "peso": 1
        },

        "10":{
            "alternativa": "c",
            "peso": 1
        }
    }
}
```

- Cadastrar Gabarito do ALuno
```
{
    "aluno_id": 1,
    "prova_id": 1,
    "gabarito_aluno": {    
        "1":  "b",    
        "2":  "d",
        "3":  "c",
        "4":  "e",
        "5":  "c",
        "6":  "e",
        "7":  "b",
        "8":  "c",  
        "9":  "d",
        "10": "a"
    }
}
```
4. Rotas da aplicação
```
GET  'api/alunos'  Listar alunos
POST 'api/alunos'  Salvar Aluno
POST 'api/alunos/{id}' Listar aluno
PUT  'api/alunos/{id}',  Atualizar Aluno
GET  'api/alunos/{id}/notas' Lista notas do Aluno
GET  'api/alunos/aprovados', 

GET  'api/provas' Listar provas
POST 'api/provas' Salvar prova
GET  'api/provas/{id}' Listar prova

GET  'api/notas', Listar gabaritos com notas
POST 'api/notas', Cadastra Gabarito do Aluno
GET  'api/notas/{id}' 
```

5. Infraestrutura
- Para facilitar utilizamos sqlite para evitar download de aplicativos terceiros

6. Se Localizando no projeto
 - Controllers : app -> http -> controllers
 - Model : app -> models -> model
 - Rotas : routes
 
> Se você chegou até este ponto pode rodar os testes, utilizei POSTMAN , muito obrigado!




