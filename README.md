# Gerenciador de contatos

Sistema de getão de contatos de pessoas

O sitema possui três interfaces de comunicação. 
Uma pela linha de comando, através dos arquivos .php, localizados na pasta `src/Cli/`.

Para executá-los você pode utilizar a própria interface do `Docker`, como no exemplo a seguir: 
`sudo docker-compose exec app php src/Cli/nome-do-arquivo.php <parametros>`.

A outra forma é utilizar a documentação do `swagguer`, que gera uma iterface, bastante, amígável para execução em ambiente web. 
A mesma pode ser acessada pela seguinte url: 
`http://localhost:8001`.

E por último, a interface web que pode ser acessada, também, pelo navegador, através da url `http://localhost:8000/`.


## Importante

- Com Exceção do `Doctrine` e do `Composer` todos os demais códigos foram desenvolvidos exclusivamente por mim, incluido toda a parte de roteamento, abstração de controladores, traits, services e etc.

- A rquitetura utilizada visa separar as camadas de domínio, serviço, infraestrutura e demais detalhes, isolando assim as regras de negócio, e o fato de não ser necessário alterar nada nos modelos nem na camada de serviço para a utilização em cli ou api, confirma essa afirmação.

- O projeto foi desenvolvido todo do zero em apenas dois dias, mas esse tempo poderia ter sido reduzido a poucas horas se utilizando algum framework de mercado que fornecesse algumas abstrações e ferramentas. 

- E para finalizar, eu quero dizer que mesmo passando o fim de semana por conta do projeto, foi algo muito prazeroso de se fazer. Sou apaixonado por tecnologia em geral, especialmente por PHP, que pra mim é uma das melhores linguagens da atualidade, principalmente, por aliar uma excelete ergonomia ao programador e também ser muito eficiente no que se propões a entregar.

### Observações

- Foram adicionados os HTTP codes corretos nos cabeçálhos de resposta das requisições
- Foi adicionada a validação de CPF
- Foi adicionada a inteface web ( toda desenvolvida em Vanilla Javascript )
- Foram adicionados comentários nas classes e métodos ( embora muitos autores desencoragem essa prática, motivo da não adição em primeiro momento )
- Foi realizada a cobertura de testes de unidade sobre as principais classes de domínio do negócio, incluindo as pastas, Model, Service e Validation. Com isso a aplicação no geral possui atualmente 17.11% de cobertura incluido cli, api e web, contudo, a camada de domínio encontra-se com 70.33% de cobertura sendo que o que falta fica por conta dos repositórios que funcionam como adaptadores para cominicação com o Doctrine, ou seja, baixo risco de erros. 



## Dependências

É necessário ter previamente instalado em sua máquina os seguintes softwares:

- [git](https://git-scm.com/downloads)
- [Docker](https://docs.docker.com/engine/install/)
- [docker-compose](https://docs.docker.com/compose/install/)

Clique nos links acima para acessar a página de instalação de cada um.



## Instalação

- Clone o projeto
```bash
git clone https://github.com/Weydans/gerenciador-de-contatos.git
```

- Acesse a pasta do projeto
```bash
cd gerenciador-de-contatos
```

- Rode o comando de instalação dos containers
```bash
sudo make install
```


## Execução



- Insira no arquivo `.env` as credenciais do seu banco de dados se estiver em embiente de produção ou mantenha como está para ambiente de desenvolvimento

- Suba a plicação com o comando abaixo
```bash
sudo make
```



## Acesso

O acesso pose ser realizado via documentação do Swagger que roda na url `http://localhost:8081/`, para acessar clique [aqui](http://localhost:8001/) ou pela url da aplicação web [aqui](http://localhost:8000/) nesse link.

    
## Execução dos testes

Executa os teste de unidade 
```bash
sudo make test
```

__Para acessar os dados de cobertura de testes abra o arquivo `coverage/index.html` no seu navegador__



## Parar Execução

Interrompe a execução dos containers
```bash
sudo make down
```



## Desinstalação

Remove a pasta com todos os arquivos do projeto
```bash
sudo make uninstall
```
