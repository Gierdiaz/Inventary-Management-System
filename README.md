# ERP de Gerenciamento de Inventário

## Este é um projeto de Sistema de Gerenciamento de Inventário para aprimorar o meu conhecimento no desenvolvimento de APIs com Laravel.

Este projeto é um ERP (Enterprise Resource Planning) desenvolvido com Laravel, focado na gestão eficiente de estoques. A aplicação é implementada como uma API RESTful, abrangendo funcionalidades essenciais para o gerenciamento de produtos, fornecedores, compras, vendas e relatórios de estoque.

### Módulos Incluídos

- **Usuários:** Gerenciamento de usuários com diferentes níveis de acesso.
- **Perfis:** Cadastro de perfis de usuário com descrição.
- **Categorias:** Gerenciamento de categorias para organização de produtos.
- **Fornecedores:** Cadastro e controle de fornecedores com informações de contato.
- **Produtos:** Detalhamento e controle de itens em estoque, incluindo preço de custo, preço de venda, quantidade em estoque e fornecedor associado.
- **Movimentos de Estoque:** Registro de entradas e saídas de produtos no estoque.
- **Compras:** Registro e acompanhamento de compras feitas de fornecedores, com detalhes de itens comprados e valor total.
- **Vendas:** Gerenciamento de transações de vendas, incluindo informações do cliente, itens vendidos e valor total.
- **Relatórios de Estoque:** Geração de relatórios abrangentes para monitoramento e análise de estoque.


### Características
Com uma complexidade bem equilibrada, este ERP oferece uma solução robusta e escalável para empresas que buscam otimizar a gestão de seus estoques utilizando as melhores práticas de desenvolvimento com Laravel.

## Instalação

1. Clone este repositório:
    ```bash
    git clone https://github.com/seu-usuario/erp-gestao-estoque.git
    ```

2. Navegue até o diretório do projeto:
    ```bash
    cd erp-gestao-estoque
    ```

3. Instale as dependências do Composer:
    ```bash
    composer install
    ```

4. Copie o arquivo de exemplo `.env` e configure seu ambiente:
    ```bash
    cp .env.example .env
    ```
    Edite o arquivo `.env` com suas configurações de banco de dados e outras configurações necessárias.

5. Gere a chave da aplicação:
    ```bash
    php artisan key:generate
    ```

6. Execute as migrações para criar as tabelas no banco de dados:
    ```bash
    php artisan migrate
    ```

7. Opcionalmente, você pode popular o banco de dados com dados de exemplo:
    ```bash
    php artisan db:seed
    ```

8. Inicie o servidor de desenvolvimento:
    ```bash
    php artisan serve
    ```

A aplicação estará disponível em `http://localhost:8000`.

## Uso da API

A API fornece endpoints para gerenciar produtos, fornecedores, compras, vendas e gerar relatórios de estoque. A documentação completa dos endpoints pode ser encontrada [aqui](link-para-documentacao).

### Exemplo de Requisição

Para listar todos os produtos:

GET /api/produtos

POST /api/produtos

Content-Type: application/json


```bash
{
    "nome": "Nome do Produto",
    "descricao": "Descrição do Produto",
    "preco": 100.00,
    "quantidade": 10
}
````

A aplicação estará disponível em `http://localhost:8000`.

## Contribuição

Contribuições são bem-vindas! Sinta-se à vontade para abrir issues ou enviar pull requests.

## Licença

Este projeto está licenciado sob a [MIT License](LICENSE).
