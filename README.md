## Start project for dev
```
Nếu Ai dùng Docker thì hãng dùng 2 dòng dưới này nha
docker-compose up -d
docker-compose exec php bash (Nếu lỗi ở windows có thể phải thêm winpty vào đầu)

cp .env.example .env
composer install
php artisan key:generate
php artisan migrate
php artisan db:seed --class=RoleSeeder
php artisan db:seed --class=UserSeeder
php artisan db:seed --class=RestaurantSeeder
php artisan db:seed --class=CategorySeeder
composer dump-autoload
npm install
npm run dev
php artisan queue:work

php artisan datatables:make + Tên Bảng (Setup datatable) (Không cần tạo ngay vì sau này chia case thì mới dùng)
Tên database : graduation_project

Mỗi người khi colone về thì tự tạo nhánh mới của mình trên git. VD: git branch -b duongnvph33352
Và mỗi người chỉ được quyền đẩy code lên nhánh của mình..

Lúc đặt bàn thì xin số điện thoại để còn xác nhận

Hãy cùng nhau xây dựng dự án tuyệt vời nhé! Thanks mọi người.
```
