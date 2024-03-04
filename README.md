# Как запустить проект?
- Скопировать .env.example в .env и заполнить нужными данными
  - Если почта mail.ru, то зайди туда и настроить smtp
  - Вставить ключи от pusher
  - Так же не забудьте поменять в файлах почту на свою
- Поднять контейнеры командой `docker-compose up -d --build`
- Подключиться к контейнеру с бэкендом и собрать зависимости: 
  - подключение к контейнеру:`docker-compose exec -it php bash`
  - `composer install -o`
  - `npm install && npm run dev`
  - `php artisan key:generate`
  - `php artisan migrate`
  - `php artisan config:cache`
- Если нужно запустить крон и воркеры, то (запускать в новых окнах терминала, т.е заново подключаться к контейнеру по команде выше):
  - Воркер: `php artisan queue:work`
  - Крон: `php artisan schedule:work`
## Остановить контейнеры по команде `docker-compose down`
## Снова запустить контейнеры `docker-compose up -d`
