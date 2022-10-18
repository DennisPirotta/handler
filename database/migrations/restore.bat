php artisan db:wipe
php artisan migrate
php artisan migrate --path=database/migrations/after/2022_09_19_101639_create_transactions_table.php
php artisan db:seed