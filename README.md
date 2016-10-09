# API Catho

### Instalação
Esse projeto utiliza [PHPUnit], com isso é necessário a utilização do [composer], [veja aqui como instalar o composer](https://getcomposer.org/download/)
```bash
$ composer install
```

### Tecnologias Utilizadas
PHP >= 5.5

### Processo decisório
Caso tenha interesse em saber como e porque fiz a API dessa forma, por favor, acesse o [arquivo DECISION.md](DECISION.md).

---

## Consumo da API
### Utilização
As requisições podem ser feitas para o arquivo index.php utilizando o método GET para passar os parametros *(Lembrando que nenhum parametro é obrigatório, e pode ser utilizado mais de um parametro por requisição)*:

* **term** - Irá pesquisar determinado termo nos campos de título e descrição, com combinação parcial de string e **SEM CASE SENSITIVE**.
* **city** - Pesquisará no campo cidade, com combinação parcial de string e **SEM CASE SENSITIVE**.
* **wage_min** - Define o valor mínimo do salário na pesquisa.
* **wage_max** - Define o valor máximo de salário na pesquisa, para esse é necessário ter wage_min.
* **order** - Atribui ordenação ascendente (ASC) ou decrescente (DSC) no campo de salário. 

### Resultado
O resultado será exibido no formato JSON, contendo as seguintes informações:

* **status** - Um aviso de sucesso ou falha, para facilitar o tratamento por quem consome a API.
* **exceptionType** - Em casos de erro, será enviado também o atributo exceptionType, dizendo qual foi o tipo do erro encontrado,
* **message** - Em casos de erro, será enviado um atributo de mensagem, para avisar ao consumidor da API qual foi o erro encontrado durante a requisição.
* **count** - Em casos de sucesso, será enviado a quantidade de resultados encontrados, assim facilitando a paginação e controle por conta do consumidor da API.
* **code** - Retorna o código HTTP do status da requisição, em casos de sucesso 200, em casos de erro, o HTTP será referente ao tipo do erro encontrado.
* **result** - Atributo com a lista de resultados encontrados na pesquisa.

### Exemplos

1) Requisição para saber todos os empregos em Porto Alegre, com salário acima de R$ 7.000
> /index.php?city=Porto&wage_min=7000
```
{"status":"success","code":200,"count":1,"result":[{"id":673,"title":"Coordenador\/Gerente de Tecnologia da Informa\u00e7\u00e3o","description":"<li> Garantir o cumprimento e procedimentos dos processos de TI. Definir,otimizar e manter atualizada as rotinas, politicas, procedimentos e documenta\u00e7\u00e3o t\u00e9cnica da \u00e1rea. Acompanhar os processos dos servi\u00e7os terceirizados, planos de conting\u00eancia e desempenho da \u00e1rea.<\/li><li> Experi\u00eancia com Infraestrutura, Telecom e Sistemas (ERP). <\/li>","wage":7000,"cities":["Porto Alegre"]}]}
```

2) Todas as vagas de Coordenador em Itajaí com salários acima de R$ 5.500, com erro de digitação no nome da cidade *(pesquisando por "tajai")*.
> /index.php?city=tajai&wage_min=5500&term=Coordenador
```
{"status":"success","code":200,"count":2,"result":[{"id":316,"title":"Coordenador de Desenvolvimento e Treinamentos","description":"<li> Desenvolvimento e aplica\u00e7\u00e3o de Avalia\u00e7\u00e3o desempenho. Atua\u00e7\u00e3o com desenvolvimento e implementa\u00e7\u00e3o da pesquisa de clima organizacional. Respons\u00e1vel pela implanta\u00e7\u00e3o da Matriz 9 box com calibragem de n\u00edveis. Desenvolvimento plano de sucess\u00e3o. Desenvolvimento a\u00e7\u00f5es para n\u00edveis alta dire\u00e7\u00e3o. Gest\u00e3o do planejamento estrat\u00e9gico de DHO. Monitoramento de indicadores e coordena\u00e7\u00e3o de equipe.<\/li><li> Forma\u00e7\u00e3o Superior em Administra\u00e7\u00e3o, Psicologia ou afins. Preferencialmente com experi\u00eancia em ind\u00fastria. Ter atuado com treinamento e desenvolvimento. Conhecimentos em matriz 9 box com calibragem de n\u00edveis e planos de sucess\u00e3o.<\/li>","wage":11000,"cities":["Itajai"]},{"id":470,"title":"Coordenador Administrativo \/ Operacional","description":"<li> Coordenar rotinas administrativas, assegurando o cumprimento das normas e procedimentos estabelecidos, realizar o controle e compra de suprimentos e servi\u00e7os (contratos de fornecedores). Acompanhar o RH (admiss\u00f5es e rescis\u00f5es), elaborar relat\u00f3rios diversos de acompanhamento financeiro, coordenar \u00e1rea de manuten\u00e7\u00f5es e suprimentos, coordenar rotinas de RH (controle de frequ\u00eancia, hor\u00e1rios e atividades dos colaboradores).<\/li><li> Experi\u00eancia com supervis\u00e3o de equipe administrativa e operacional.<\/li><li> Ensino Superior completo em Administra\u00e7\u00e3o de empresas ou Administra\u00e7\u00e3o P\u00fablica.<\/li>","wage":5500,"cities":["Itajai"]}]}
```

3) Todos as vagas de Analista com salários entre R$ 5.000 e R$ 7.500 ordenados de forma decrescente
> /index.php?term=Analista&order=DSC&wage_min=5000&wage_max=7500
```
{"status":"success","code":200,"count":1,"result":[{"id":581,"title":"Analista de Tecnologia da Informa\u00e7\u00e3o","description":"<li> Planejar, or\u00e7ar, implementar e conduzir as atualiza\u00e7\u00f5es de hardware e software. Coordenar o sistema de virtualiza\u00e7\u00e3o e de conting\u00eancia. Exercer o controle de seguran\u00e7a de acessos e sistemas informatizados. Conduzir o relacionamento com os fornecedores de software e hardware. Definir, organizar e dimensionar requisitos e funcionalidades que envolvem os processos de T.I. Elaborar documenta\u00e7\u00e3o t\u00e9cnica e manter atualizados os processos de T.I. Gerenciar o cloud computer.<\/li><li> Dom\u00ednio no sistema operacional da institui\u00e7\u00e3o (ser\u00e1 fornecido treinamento), ferramentas de gerenciamento de rede, ferramenta de gerenciamento e seguran\u00e7a de TI, manuten\u00e7\u00e3o de computadores, SQL e processos de gest\u00e3o. Necess\u00e1rio excel\u00eancia em relacionamento interpessoal, organiza\u00e7\u00e3o, capacidade de comunica\u00e7\u00e3o, solu\u00e7\u00e3o de problemas, vis\u00e3o sist\u00eamica e \u00e9tica. Gradua\u00e7\u00e3o conclu\u00edda.<\/li>","wage":5600,"cities":["Porto Alegre"]}]}
```

3) Vagas no Rio de Janeiro
> /index.php?city=rio%20de%20janeiro
```
{"status":"error","exceptionType":"EmptyException","message":"No result was found","code":404}
```

---

## Código da API
### Hierarquia de arquivos:
```
|- Catho/
|---- Job.php
|---- JobCollection.php
|---- Json.php
|---- Request.php
|---- Result.php
|---- Search.php
|------ Test/
|---------- JobTest.php
|---------- JsonTest.php
|---------- RequestTest.php
|---------- SearchTest.php
|------ Exception/
|---------- EmptyException.php
|---------- RequestException.php
|---------- FileException.php
|---------- TypeException.php
```

### Testes
Esse projeto utiliza [PHPUnit] para testes, e podem ser executados da seguinte forma:
>  phpunit --debug lib/Catho/Test/RequestTest.php
```
Starting test 'Catho\Test\RequestTest::testRequestResultEmptiness'
Time: 71 ms, Memory: 5.75Mb
OK (1 test, 1 assertion)
```
>  phpunit --debug lib/Catho/Test/SearchTest.php
```
Starting test 'Catho\Test\SearchTest::testTermResults'.
Starting test 'Catho\Test\SearchTest::testTermCount'.
Starting test 'Catho\Test\SearchTest::testCityResult'.
Starting test 'Catho\Test\SearchTest::testWageResult'.
Starting test 'Catho\Test\SearchTest::testWageCount'.
Starting test 'Catho\Test\SearchTest::testMultipleSearchCount'.
Starting test 'Catho\Test\SearchTest::testMultipleSearchCountWithTerm'.
Time: 289 ms, Memory: 6.75Mb
OK (8 tests, 8 assertions)
```
>  phpunit --debug lib/Catho/Test/JsonTest.php
```
Starting test 'Catho\Test\JsonTest::testType'
Starting test 'Catho\Test\JsonTest::testCountObjects'
Time: 68 ms, Memory: 5.75Mb
OK (2 tests, 2 assertions)
```
>  phpunit --debug lib/Catho/Test/SearchTest.php
```
Starting test 'Catho\Test\JobTest::testLastId'.
Starting test 'Catho\Test\JobTest::testId'.
Starting test 'Catho\Test\JobTest::testTitle'.
Starting test 'Catho\Test\JobTest::testWage'.
Starting test 'Catho\Test\JobTest::testCities'.
Time: 172 ms, Memory: 20.50Mb
OK (6 tests, 6 assertions)
```

### Documentação
Todo o projeto está comentado sob o padrão [PHPDoc](), e a documentação que foi gerada pode ser encontrada em *(sugiro que abra pelo browser)*:
> /docs/

### Caso queira simular seu próprio request, basta seguir os passos abaixo:
```php

require 'lib/autoload.php';

use Catho\Request;

// CRIE UMA NOVA INSTANCIA DA CLASSE REQUEST, E ATRIBUA OS PARAMETROS DESEJADOS
$request = new Request(['wage_min' => 8000, 'order' => 'ASC']);

// ENTÃO EXECUTE-O
$request->process();

// CASO QUEIRA TRATAR O RESULTADO, BASTA PASSAR O PARAMETRO FALSE NA FUNÇÃO PROCESS:
// $results = $request->process(false); 

```

[PHPUnit]:https://phpunit.de/