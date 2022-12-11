This is laravel based admin interface via AdminLte with Employees and Positions items

How to install on Ubuntu, follow the next steps:

1) git clone https://github.com/SergM2014/abz-task.git

2) cd abz-task

3) ./vendor/bin/sail build --no-cache 

4) ./vendor/bin/sail up -d

5) ./vendor/bin/sail shell

6) composer install

7) php artisan migrate --seed

(!!! this item needs long time, in my case it took 15 mins!!!)

8) php artisan storage:link

9) npm install

10) npm run build


visit http://localhost 

make the registration on site
and test the admin part

