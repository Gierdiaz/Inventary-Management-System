
# Esquema do Banco de Dados

## Tabela dos Usuários
- **id**: SERIAL (primary key)
- **name**: VARCHAR(255) (not null)
- **email**: VARCHAR(255) (not null, unique)
- **password**: VARCHAR(255) (not null)
- **access_level**: VARCHAR(50) (not null)

## Tabela de Perfis
- **id**: SERIAL (primary key)
- **name**: VARCHAR(255) (not null)
- **description**: TEXT

## Tabela de Associação UserProfile
- **user_id**: INT (foreign key references users.id)
- **profile_id**: INT (foreign key references profiles.id)
- PRIMARY KEY (user_id, profile_id)

## Tabela das Categorias
- **id**: SERIAL (primary key)
- **name**: VARCHAR(255) (not null)

## Tabela dos Fornecedores
- **id**: SERIAL (primary key)
- **name**: VARCHAR(255) (not null)
- **contact**: VARCHAR(255)
- **phone**: VARCHAR(50)
- **email**: VARCHAR(255)
- **address**: TEXT

## Tabela dos Produtos
- **id**: SERIAL (primary key)
- **name**: VARCHAR(255) (not null)
- **description**: TEXT
- **barcode**: VARCHAR(50)
- **category_id**: INT (foreign key references categories.id)
- **cost_price**: DECIMAL(10, 2) (not null)
- **sale_price**: DECIMAL(10, 2) (not null)
- **stock_quantity**: INT (not null)
- **unit**: VARCHAR(50)
- **stock_min**: INT
- **created_at**: TIMESTAMP (default: `CURRENT_TIMESTAMP`)
- **supplier_id**: INT (foreign key references suppliers.id)

## Tabela dos Movimentos de Estoque
- **id**: SERIAL (primary key)
- **product_id**: INT (foreign key references products.id)
- **quantity**: INT (not null)
- **movement_type**: VARCHAR(50) (not null) // 'entrada' ou 'saída'
- **movement_date**: TIMESTAMP (default: `CURRENT_TIMESTAMP`)
- **notes**: TEXT

## Tabela de Compras
- **id**: SERIAL (primary key)
- **supplier_id**: INT (foreign key references suppliers.id)
- **purchase_date**: TIMESTAMP (default: `CURRENT_TIMESTAMP`)
- **total_amount**: DECIMAL(10, 2) (not null)

## Tabela de Itens de Compra
- **id**: SERIAL (primary key)
- **purchase_id**: INT (foreign key references purchases.id)
- **product_id**: INT (foreign key references products.id)
- **quantity**: INT (not null)
- **unit_price**: DECIMAL(10, 2) (not null)

## Tabela de Vendas
- **id**: SERIAL (primary key)
- **customer_name**: VARCHAR(255) (not null)
- **sale_date**: TIMESTAMP (default: `CURRENT_TIMESTAMP`)
- **total_amount**: DECIMAL(10, 2) (not null)

## Tabela de Itens de Venda
- **id**: SERIAL (primary key)
- **sale_id**: INT (foreign key references sales.id)
- **product_id**: INT (foreign key references products.id)
- **quantity**: INT (not null)
- **unit_price**: DECIMAL(10, 2) (not null)
