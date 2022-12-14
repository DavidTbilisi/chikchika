

### Installation

_Below is an example of how you can install an application._

1. Clone the repo
   ```sh
   git clone https://github.com/DavidTbilisi/chikchika.git
   ```
2. Install laravel packages
    ```sh
    composer install
    ```
3. Generate key and set .env (database, mail)
    ```sh
    php artisan key:generate
    ```
3. Run migrations
    ```sh
    php artisan migrate:fresh --seed
    ```
5. Install NPM packages and build app
   ```sh
   npm install && npm run build
   ```


6. Get any user from database
7. password for every user is `password`


