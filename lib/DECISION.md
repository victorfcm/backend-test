# Processo Decisório
Esse arquivo é um FAQ com pequenas explicações de porque decidi fazer o projeto dessa forma. Eu utilizo esse documento geralmente como pontapé inicial de qualquer projeto, e escrevo-o antes de começar a codificar. Após a programação e documentação estar concluída eu volto nele e altero o que for necessário.

## Perguntas
1. Por que não utilizar nenhum framework?
    * Na documentação do desafio, estava que um dos pontos de verificação seria a manutenabilidade, e a utilização de um framework que não seja o padrão da empresa ou que os programadores não estejam acostumados, pode aumentar e muito a curva de aprendizado.
    * Outro ponto de menor relevância, é que eu acredito que o tamanho do projeto é relativamente proporcional ao tamanho do framework a ser utilizado, não é interessante utilizar um monstro como o Symfony2 para construir uma bicicleta, assim como não se dá para usar um framework menor como o CodeIgniter ou o Yii para um projeto gigantesco. Cada projeto tem sua peculiaridade, e esse era tão pequeno que sem framework eu julguei que seria melhor.
    
2. Os comentários do código estão em ingles, porém, a documentação em Português, porquê?
    * Eu geralmente escrevo tudo em ingles, tanto comentário quanto documentação, nesse caso em específico abri uma exceção.
    
3. Pensou em adicionar alguma feature que deixou de fora?
    * Eu queria adicioar uma requisição em duas etapas, utilizando o OAuth2. Pensei nisso por essa ser supostamente uma API Pública, e é necessário alguma camada de "proteção" do servidor principal, porém não houve tempo hábil pra isso.
    * Queria também adicionar uma ferramenta de cache, para que as requisições fossem armazenadas em uma pasta /cache/, e quando requisitadas novamente apenas pegasse direto de lá, sem repetir todo o processo. Assim economizando tempo de resposta e processamento no servidor.
    * A utilização de um logger, como o [Klogger](https://github.com/katzgrau/KLogger), também seria muito interessante.
    
4. Como você gerenciou o seu tempo?
    * Junto com a criação deste arquivo, criei também um [board no Trello, que pode ser acessado publicamente](https://trello.com/b/igBqFg0Y), caso vocês estejam interessados em ver minha organização pessoal.

5. Teve alguma dúvida com o desafio?
    * Sim! Não ficou muito claro se o output era para ser em JSON ou em alguma saída HTML tratada. Decidi fazer por JSON pois é uma API.
    
6. Encontrou alguma dificuldade no desenvolvimento?
    * Sim, a parte de ordenação por salários me deu um pequeno trabalho de pesquisa e solução, mas nada grave.
    
7. Quanto tempo você levou para fazer tudo?
    * Comecei a fazer tudo no Sábado (09/10/2016) Meu primeiro commit foi as 11 AM, porém só comecei a trabalhar mesmo as 17 horas, concluí o ultimo commit por volta das 01:30 AM.
     
8. Aprendeu algo novo?
    * Nada própriamente novo, mas depois de quase 1 ano vendo o mesmo código na empresa que trabalho, foi bom voltar a fazer algum código diferente, principalmente, foi bom voltar a usar o PHPUnit, eu estava a alguns anos sem usar.

