## Start project for dev
```
docker-compose up -d
docker-compose exec php bash (Nếu lỗi ở windows có thể phải thêm winpty vào đầu)

cp .env.example .env
composer install
php artisan key:generate
php artisan migrate
php artisan db:seed --class=RoleSeeder
php artisan db:seed --class=UserSeeder
composer dump-autoload
npm install
npm run dev

Mỗi người khi colone về thì tự tạo nhánh mới của mình trên git. VD: git branch -b duongnvph33352
Và mỗi người chỉ được quyền đẩy code lên nhánh của mình..

Hãy cùng nhau xây dựng dự án tuyệt vời nhé! Thanks mọi người.
```
