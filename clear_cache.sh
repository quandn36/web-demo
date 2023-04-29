#/bin/sh

# composer dump-autoload && php artisan clear-compiled && php artisan route:cache  && php artisan cache:clear && php artisan view:clear 
# && php artisan optimize &&  php artisan config:cache && php artisan config:clear

composer dump-autoload && php artisan route:cache && php artisan config:cache && php artisan config:clear && php artisan cache:clear
