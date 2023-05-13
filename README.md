# Gerenciador de contatos

Sistema de getão de contatos de pessoas



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



## Execução

- Acesse a pasta do projeto
```bash
cd gerenciador-de-contatos
```

- Insira no arquivo `.env` as credenciais do seu banco de dados se estiver em embiente de produção ou mantenha como está para ambiente de desenvolvimento

- Suba a plicação com o comando abaixo
```bash
make
```



## Acesso

O acesso pose ser realizado via documentação do Swagger que roda na url `http://localhost:8081/`, para acessar clique [aqui](http://localhost:8081/).

    


## Testes

- Caso deseje, você pode rodar os testes automatizados e conferir a cobertura de código.

- Para executar os testes automatizados rode o comando
```bash
make test
```

- Para acessar aos dados de cobertura de código rode o comando
```bash
x-www-browser ./coverage/index.html
```

- A cobertura de código também pode ser acessada diretamente pelo navegador abrindo o arquivo `./coverage/index.html` localizado na raiz do projeto 

    


## Parar Execução

Interrompe a execução dos containers
```bash
make down
```



## Desinstalação

Remove a pasta com todos os arquivos do projeto
```bash
sudo make uninstall
```
