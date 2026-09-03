# Instruções para rodar o app

## 1. Configuração do banco de dados

Primeiro, configure o banco de dados no arquivo `.env`:
se não tiver rode esse comando para criar
```bash
copy .env.example .env
```

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

Certifique-se de que o MySQL esteja rodando e que o banco de dados esteja configurado corretamente.

## 2. Rodar as migrations

Mas antes rode
```bash
composer install
```

E depois
```bash
php artisan key:generate
```

Depois de configurar o banco de dados, execute:

```bash
php artisan migrate
```

## 3. Instalar as dependências

Certifique-se de ter o **Node.js** e o **NPM** instalados.

Para instalar as dependências do projeto, execute:

```bash
npm install
```

As principais dependências utilizadas no projeto são:

- `@fullcalendar/bootstrap5@7.0.2`
- `@tailwindcss/vite@4.3.3`
- `axios@1.20.0`
- `bootstrap-icons@1.13.1`
- `bootstrap@5.3.8`
- `concurrently@9.2.4`
- `fullcalendar@7.0.2`
- `laravel-vite-plugin@2.1.0`
- `tailwindcss@4.3.3`
- `temporal-polyfill@1.0.4`
- `vite@7.3.6`

Para verificar as dependências instaladas, utilize:

```bash
npm list
```

## 4. Rodar o app

Por fim, execute:

```bash
php artisan serve
```

Caso o projeto utilize o Vite, abra outro terminal e execute:

```bash
npm run dev
```

Depois, acesse o endereço mostrado pelo `php artisan serve`.

Pronto! O app estará rodando. 🚀
