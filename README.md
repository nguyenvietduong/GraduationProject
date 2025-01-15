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
php artisan db:seed --class=TableSeeder
php artisan db:seed --class=CategorySeeder
php artisan db:seed --class=PermissionSeeder
php artisan db:seed --class=ReservationSeeder


function doGet(request) {
  var parameters = 5;
  var sheet = SpreadsheetApp.openById("Sheet_ID").getSheetByName("sheet1");
  // Lấy tên các cột
  var headnames = sheet.getRange(1, 1, 1, parameters).getValues()[0];

  // Lấy tất cả dữ liệu từ bảng tính
  var lastRow = sheet.getLastRow();
  var range = sheet.getRange(lastRow - 1, 1, 2, parameters);
  // Lấy 2 giao dịch cuối cùng
  var values = range.getValues();

  var rows = [];
  values.forEach(function (row) {
    var newRow = {};
    headnames.forEach(function (item, index) {
      newRow[item] = row[index];
    });
    rows.push(newRow);
  });

  return ContentService.createTextOutput(
    JSON.stringify({ data: rows, error: false })
  ).setMimeType(ContentService.MimeType.JSON);
}



npm install
npm run dev
php artisan queue:work
php artisan schedule:work

php artisan datatables:make + Tên Bảng (Setup datatable) (Không cần tạo ngay vì sau này chia case thì mới dùng)
Tên database : graduation_project

Mỗi người khi colone về thì tự tạo nhánh mới của mình trên git. VD: git branch -b duongnvph33352
Và mỗi người chỉ được quyền đẩy code lên nhánh của mình..

*Nhớ pull code về trước khi push code mới

*Khi pull code về nhớ chạy composer-update => Luôn luôn nhớ

Câu lệnh json-server --watch db.json

Lúc đặt bàn thì xin số điện thoại để còn xác nhận

Hãy cùng nhau xây dựng dự án tuyệt vời nhé! Thanks mọi người.
```
