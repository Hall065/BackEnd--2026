### Passo 1: Criar os Models e as Migrations (Banco de Dados)

Abra o seu terminal e rode estes dois comandos, um de cada vez:

Bash

`php artisan make:model Insumo -m`

Bash

`php artisan make:model Produto -m`

### Passo 2: Preparar as colunas do Banco

Vá na pasta **`database/migrations/`**. Você vai ver dois arquivos novos lá no final da lista.

**1. Abra o arquivo que termina com `_create_insumos_table.php`** e deixe a função `up()` assim:

```php
public function up(): void
{
    Schema::create('insumos', function (Blueprint $table) {
        $table->id();
        $table->string('nome'); // Ex: Linha de Algodão Branca
        $table->string('unidade_medida'); // Ex: Metros, Kg, Unidade, Cone
        $table->decimal('preco_custo', 10, 2)->nullable(); // Ex: 15.50
        $table->decimal('estoque', 10, 2)->default(0); // Quantidade atual
        $table->timestamps();
    });
}
```

**2. Abra o arquivo que termina com `_create_produtos_table.php`** e deixe a função `up()` assim:

```php
public function up(): void
{
    Schema::create('produtos', function (Blueprint $table) {
        $table->id();
        $table->string('nome'); // Ex: Camiseta Básica Preta
        $table->string('referencia')->nullable(); // Ex: CAM-PRE-001
        $table->decimal('preco_venda', 10, 2)->nullable(); // Ex: 89.90
        $table->integer('estoque')->default(0); // Quantidade atual
        $table->timestamps();
    });
}
```

### Passo 3: Liberar o salvamento nos Models

Vá na pasta **`app/Models/`**:

1. Abra o **`Insumo.php`** e coloque: `protected $guarded = [];` dentro da classe. Salve.
2. Abra o **`Produto.php`** e coloque: `protected $guarded = [];` dentro da classe. Salve.

### Passo 4: Subir para o Banco

No terminal, rode o comando para criar essas tabelas de verdade:

Bash

`php artisan migrate`

### Passo 5: Criar as Telas no Filament

No terminal, peça para o Filament gerar a interface visual para nós:

Bash

`php artisan make:filament-resource Insumo`

Bash

`php artisan make:filament-resource Produto`

### Passo 6: Arrumar os formulários

Vá na pasta **`app/Filament/Resources/`**:

**1. Abra o `InsumoResource.php`** e substitua o `$form` e o `$table` por isso (lembre de importar os componentes se seu editor não fizer sozinho):

`use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;`

No Form

```php
 return InsumoForm::configure($schema);
        return $schema
            ->schema([
                TextInput::make('nome')->required(),
                TextInput::make('unidade_medida')->required()->label('Unidade (Kg, Metros, Un...)'),
                TextInput::make('preco_custo')->numeric()->prefix('R$')->label('Preço de Custo'),
                TextInput::make('estoque')->numeric()->default(0),
            ]);
```

No table

```php
 return InsumosTable::configure($table);
        return $table
            ->columns([
                TextColumn::make('nome')->searchable(),
                TextColumn::make('unidade_medida'),
                TextColumn::make('preco_custo')->money('BRL'),
                TextColumn::make('estoque'),
            ]);
```

**2. Abra o `ProdutoResource.php`** e faça a mesma coisa:

PHP

`use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;`

Form Produto

```php
   return ProdutoForm::configure($schema);
        return $schema
            ->schema([
                TextInput::make('nome')->required()->label('Nome do Produto'),
                TextInput::make('referencia')->label('Código/Referência'),
                TextInput::make('preco_venda')->numeric()->prefix('R$')->label('Preço de Venda'),
                TextInput::make('estoque')->numeric()->default(0),
            ]);
```

Table

```php
      return ProdutosTable::configure($table);
        return $table
            ->columns([
                TextColumn::make('referencia')->searchable(),
                TextColumn::make('nome')->searchable(),
                TextColumn::make('preco_venda')->money('BRL'),
                TextColumn::make('estoque'),
            ]);
```

# Pedido e Item Pedido

### Passo 1: Criar os Models e as Migrations

No seu terminal, rode estes dois comandos:

Bash

`php artisan make:model Pedido -m`

Bash

`php artisan make:model ItemPedido -m`

### Passo 2: Preparar as Colunas e as Conexões (Foreign Keys)

Vá na pasta **`database/migrations/`**.

**1. Abra o arquivo `_create_pedidos_table.php`** e deixe a função `up()` assim:

```php
public function up(): void
{
    Schema::create('pedidos', function (Blueprint $table) {
        $table->id();
        // conectando com a tabela de clientes!
        $table->foreignId('cliente_id')->constrained('clientes')->cascadeOnDelete();
        $table->string('status')->default('Pendente'); // Pendente, Em Produção, Finalizado
        $table->decimal('valor_total', 10, 2)->nullable();
        $table->timestamps();
    });
}
```

**2. Abra o arquivo `_create_item_pedidos_table.php`** e deixe assim:

```php
  public function up(): void
{
    Schema::create('item_pedidos', function (Blueprint $table) {
        $table->id();
        // Conecta o item ao pedido e ao produto
        $table->foreignId('pedido_id')->constrained('pedidos')->cascadeOnDelete();
        $table->foreignId('produto_id')->constrained('produtos')->cascadeOnDelete();
        $table->integer('quantidade');
        $table->decimal('preco_unitario', 10, 2);
        $table->timestamps();
    });
}
```

### Passo 3: Ensinar os Models a conversarem

Vá na pasta **`app/Models/`**. Aqui nós vamos avisar o Laravel quem é "pai" e quem é "filho".

**1. No `Pedido.php`:**

```php
class Pedido extends Model
{
    protected $guarded = [];

    // Um pedido PERTENCE a um Cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    // Um pedido TEM MUITOS Itens
    public function itens()
    {
        return $this->hasMany(ItemPedido::class);
    }
}
```

**2. No `ItemPedido.php`:**

```php
class ItemPedido extends Model
{
    protected $guarded = [];

    // Um item PERTENCE a um Produto
    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }
}
```

### Passo 4: Subir para o Banco

No terminal, rode a migração:

Bash

`php artisan migrate`

### Passo 5: Criar a Tela do Pedido (O Filament)

Rode o comando para criar a interface:

Bash

`php artisan make:filament-resource Pedido`

### Passo 6: Configurar o Formulário Super Poderoso

Abra o arquivo **`app/Filament/Resources/PedidoResource.php`**.
Lá no topo, adicione estas linhas para importarmos os novos blocos do Filament:

```php
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TextColumn;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
```

Agora, desça até a função `form` e coloque isso. Veja que incrível é o componente `Repeater`:

```
public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Select::make('cliente_id')
                    ->relationship('cliente', 'nome')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->label('Selecione o Cliente'),

                Select::make('status')
                    ->options([
                        'Pendente' => 'Pendente',
                        'Em Produção' => 'Em Produção',
                        'Finalizado' => 'Finalizado',
                    ])
                    ->default('Pendente')
                    ->required(),

                TextInput::make('valor_total')
                    ->numeric()
                    ->prefix('R$'),

                Repeater::make('itens')
                    ->relationship('itens') // garantir a relação do banco
                    ->schema([
                        Select::make('produto_id')
                            ->relationship('produto', 'nome')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->label('Produto')
                            ->columnSpan(2),

                        TextInput::make('quantidade')
                            ->numeric()
                            ->default(1)
                            ->required()
                            ->columnSpan(1),

                        TextInput::make('preco_unitario')
                            ->numeric()
                            ->prefix('R$')
                            ->required()
                            ->columnSpan(1),
                    ])
                    ->columns(4)
                    ->columnSpanFull()
                    ->label('Produtos do Pedido'),
            ]);
    }
```

no table

```php
return $table
            ->columns([
                TextColumn::make('cliente.nome')
                    ->label('Cliente')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('status')
                    ->badge() 
                    ->color(fn (string $state): string => match ($state) {
                        'Pendente' => 'warning',
                        'Em Produção' => 'info',
                        'Finalizado' => 'success',
                        default => 'gray',
                    }),

                TextColumn::make('valor_total')
                    ->label('Valor Total')
                    ->money('BRL') 
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Data do Pedido')
                    ->dateTime('d/m/Y H:i') 
                    ->sortable(),
            ])
            ->filters([
                //
            ]); 
```

**1. Calculando ao CRIAR um pedido**
Abra o arquivo **`app/Filament/Resources/PedidoResource/Pages/CreatePedido.php`**.
Deixe ele assim:

```php
<?php

namespace App\Filament\Resources\PedidoResource\Pages;

use App\Filament\Resources\PedidoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePedido extends CreateRecord
{
    protected static string $resource = PedidoResource::class;

    // Esta função roda assim que o pedido é salvo no banco
    protected function afterCreate(): void
    {
        $pedido = $this->record;
        
        // Pega todos os itens desse pedido, multiplica quantidade x preço e soma tudo
        $total = $pedido->itens->sum(function ($item) {
            return $item->quantidade * $item->preco_unitario;
        });

        // Atualiza o valor total do pedido e salva
        $pedido->update(['valor_total' => $total]);
    }
}
```

**2. Calculando ao EDITAR um pedido**
Abra o arquivo **`app/Filament/Resources/PedidoResource/Pages/EditPedido.php`**.
Adicione a função `afterSave` nele:

```php
<?php

namespace App\Filament\Resources\PedidoResource\Pages;

use App\Filament\Resources\PedidoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPedido extends EditRecord
{
    protected static string $resource = PedidoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    // Esta função roda toda vez que você edita e salva o pedido
    protected function afterSave(): void
    {
        $pedido = $this->record;
        
        $total = $pedido->itens->sum(function ($item) {
            return $item->quantidade * $item->preco_unitario;
        });

        $pedido->update(['valor_total' => $total]);
    }
}
```

Se precisar liberar e limpar memória do sistema

```php
php artisan optimize:clear
```

Como o seu sistema acusou que não estava achando arquivos do Filament antes, é muito bom darmos um "choque" no mapeamento de pastas dele.

```php
composer dump-autoload
```

### Passo 1: Adicione os novos imports no topo

Lá em cima, no seu `PedidoResource.php`, junto dos outros `use`, adicione estes dois carinhas que servem para pegar (`Get`) e definir (`Set`) valores no formulário:

PHP

```php
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
```

### Passo 2: Atualize o seu método `form`

Substitua o seu campo `valor_total` e o seu `Repeater` por este código abaixo. Note que eu adicionei o `->live()` e o `->afterStateUpdated()` neles, e deixei o `valor_total` como `readOnly()` para ninguém digitar o valor errado manualmente:

```php
TextInput::make('valor_total')
                    ->numeric()
                    ->prefix('R$')
                    ->readOnly() 
                    ->label('Valor Total'),

                Repeater::make('itens')
                    ->relationship('itens') 
                    ->schema([
                        Select::make('produto_id')
                            ->relationship('produto', 'nome')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->label('Produto')
                            ->columnSpan(2),

                        TextInput::make('quantidade')
                            ->numeric()
                            ->default(1)
                            ->required()
                            ->live(onBlur: true) 

                            ->afterStateUpdated(fn (Get $get, Set $set) => self::calcularTotal($get, $set))
                            ->columnSpan(1),

                        TextInput::make('preco_unitario')
                            ->numeric()
                            ->prefix('R$')
                            ->required()
                            ->live(onBlur: true)

                            ->afterStateUpdated(fn (Get $get, Set $set) => self::calcularTotal($get, $set))
                            ->columnSpan(1),
                    ])
                    ->columns(4)
                    ->columnSpanFull()
                    ->label('Produtos do Pedido')
                    ->live() 

                    ->afterStateUpdated(fn (Get $get, Set $set) => self::calcularTotal($get, $set)),
            ]);
```

Role o arquivo do `PedidoResource.php` até o final. Logo antes da **última chave `}`** que fecha o arquivo todo (depois do método `getPages`), cole esta função:

```php
public static function calcularTotal(Get $get, Set $set): void
    {
        // Pega todos os itens que estão no Repeater naquele momento
        $itens = $get('itens') ?? [];
        $total = 0;

        // Passa por cada linha somando (quantidade * preco)
        foreach ($itens as $item) {
            $quantidade = (float) ($item['quantidade'] ?? 0);
            $preco = (float) ($item['preco_unitario'] ?? 0);
            
            $total += $quantidade * $preco;
        }

        // Joga o resultado de volta lá no campo 'valor_total'
        $set('valor_total', number_format($total, 2, '.', ''));
    }
```