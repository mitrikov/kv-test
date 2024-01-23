# Тестовое задание «Форма обратной связи»

## Запуск при помощи Docker

```
docker compose up -d
```

Обращения будут сохраняться в папку appeals

## Установка:

### Frontend
```
cd frontend 
npm i
```

### Backend
```
cd backend
composer install
```

## Запуск:

### Frontend
```
cd frontend 
npm run dev
```

### Backend
```
cd backend
php artisan serve
```

Перейти в браузере:

http://localhost:5173/

Основная реализация функционала находится в:

[backend/app/Repositories](./backend/app/Repositories)  
[backend/app/Models/Appeal.php](./backend/app/Models/Appeal.php)  
[backend/app/Models/AppealController.php](./backend/app/Models/AppealController.php)  
[frontend/src/components/AppealForm.vue](./frontend/src/components/AppealForm.vue)

Заявки сохраняются в:  
[backend/storage/appeals](./backend/storage/appeals) 
