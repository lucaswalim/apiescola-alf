# apiescola-alf
### Escola- Alf API RESTFULL Construido em Php com microframework Lumen

- Características:
  - De forma simples podemos cadastrar alunos, provas e gabaritos de alunos, corrigir provas retornando notas e média final.

**Antes de iniciar precisamos seguir alguns passos rápidos.** 

1. Download do Php: [PHP](https://windows.php.net/download#php-7.3) -> Opção zip
   - Extrair arquivo em uma pasta desejada.
   - copiar o arquivo "php.ini-development" e colar na mesma pasta com nome "php.ini".
   - abrir arquivo php.ini com editor de texto, buscar por nomes (Ctrl + f): "extension=pdo_sqlite" e "extension_dir", apagar o ";" do início.

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

4. Localizar no projeto
 - Controllers : app -> http -> controllers
 - Model : app -> models -> model





