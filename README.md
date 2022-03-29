 <h1> Spark - MTG Deckbuilder </h1>
 
 Este projeto foi desenvolvido para auxiliar na gestão e usabilidade do projeto de extensão do IFTM - Campus Patrocínio, UniMagic. O Spark MTG utiliza a API MTG de [magicthegathering.io](http://magicthegathering.io/) para coletar dados dos cards do game Magic: The Gathering.
 
 > <h2> Funcionalidades do Spark - MTG Deckbuilder:</h2>
  * Cadastro de _cards_, _decks_ e usuários.
  * Listagem de todas as cartas do jogo MTG, assim como identificar se o UniMagic possui ou não cada carta.
  * Exportar _decks_.
  * Funções de editar, excluir e buscar os itens cadastrados.
  * Realizar empréstimos aos usuários.

> <h2> Tecnologias utilizadas:</h2>
 Nome   | Versão
--------- | ------
PHP | 8.1.2
Laravel | 9.x
Composer | 2.2.7
MySql | 8.0

> <h2> Requisitos de hardware:</h2>
Este projeto não possui nenhum requisito específico de hardware.

> <h2> Requisitos de software:</h2>
Instalar os programas nas versões utilizadas para desenvolvimento.

> <h2> Como executar o projeto:</h2>
1. Clonar o repositorio na máquina local
2. Executar no shell: composer install
3. Configure suas variáveis de banco de dados em .env
4. Acessar o local do projeto no shell
5. Executar no shell: php artisan migrate
6. Executar no shell: php artisan serve
7. Abrir o navegador e digitar o caminho local do projeto.

> <h2> Uso</h2>
 ### Cadastros:
 Todos os cadastros são feitos por um usuário com permissão de administrador. 
 * Para o cadastro de um usuário é necessário preencher os campos: **nome, e-mail, foto de perfil (caso desejar), permissão (administrador ou usuário comum) e senha**.

 ### Login:
 * O login é feito com **e-mail e senha**.

 ### Permissões:
 Existe dois níveis de permissões, usuário e administrador.
 
 * **Usuário:** Este nível disponibiliza algumas funções simples para os usuários participantes do projeto como:
     1. Cadastrar decks.
     2. Visualizar decks de outros usuários do projeto.
     3. Visualizar todos os cards adquiridos pelo projeto e se os respectivos estão disponíveis para empréstimo.
     4. Solicitar empréstimo.

* **Administrador:** Este nível disponibiliza todas as funções gerenciais do projeto:
     1. Cadastrar usuários.
     2. Cadastrar cards adquiridos.
     3. Montar decks.
     4. Visualizar todos os itens cadastrados: cards, decks e usuários.
     5. Realizar empréstimos aos participantes cadastrados.
     6. Obter um relatório dos empréstimos.

### Empréstimo:
Para realizar os empréstimos é necessário:
* Selecionar o usuário que solicitou o empréstimo.
* Selecionar o item a ser emprestado.
* Selecionar a data de empréstimo e logo após a data de devolução.
* Salvar a ação.
* Os empréstimos feitos podem ser acompanhados na página "Relatório de Empréstimos".
