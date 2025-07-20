# 🎓 Child CRM App — Laravel Backend

**Child CRM App** — bu maktab, bog‘cha yoki o‘quv markazlarida bolalar va xodimlarni boshqarish uchun mo‘ljallangan Laravel asosidagi backend tizimi. Ushbu tizim orqali foydalanuvchilarni ro'yxatdan o'tkazish, tashrifni boshqarish, moliyaviy hisob-kitoblarni yuritish, statistikalarni ko‘rish va boshqa ko‘plab imkoniyatlar yaratilgan.

---

## 🚀 Boshlanish

### Talablar
- PHP 8.2 yoki undan yuqori
- Composer
- MySQL yoki SQLite
- Node.js va NPM (Vite uchun)

### O‘rnatish

```bash
git clone https://github.com/elshodatc111/child_crm_app.git
cd child_crm_app
cp .env.example .env
composer install
php artisan key:generate
php artisan migrate --seed
npm install && npm run dev
php artisan serve
```

---

## 📦 Texnologiyalar

| Texnologiya         | Tavsif                                      |
|---------------------|----------------------------------------------|
| Laravel 12          | PHP backend freymvorki                       |
| Sanctum             | API token autentifikatsiyasi                 |
| Vite + Tailwind CSS | Frontendni real vaqtli ishlatish uchun      |
| MySQL/SQLite        | Ma’lumotlar bazasi                          |
| PHPUnit             | Backend testlash                             |

---

## 📁 Loyiha Tuzilishi (Backend)

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── api/             # API controllerlari
│   │   ├── auth/            # Login / logout
│   │   ├── chart/           # Statistikalar
│   │   ├── dashboard/       # Dashboard
│   │   ├── child/           # Bolalar bilan ishlash
├── Models/                 # Eloquent modellari
routes/
├── api.php                # API yo‘llari
├── web.php                # Web interfeys yo‘llari
database/
├── migrations/            # Jadval yaratuvchi fayllar
├── seeders/               # Demo ma’lumotlar
tests/                     # Unit va feature testlar
.env.example               # Muhit sozlamalari
```

---

## 🔒 Autentifikatsiya

API uchun `Laravel Sanctum` orqali token asosida autentifikatsiya ishlatiladi. Har bir foydalanuvchi login orqali token oladi va shu orqali tizimga murojaat qiladi.

---

## ✅ Rejalashtirilgan Imkoniyatlar

- 📤 Push xabarnomalar (notification)
- 📊 Barcha grafiklar uchun ChartJS
- 📅 Calendar integratsiyasi (dars jadvali, tashriflar)
- 🌐 Swagger API hujjatlari

---

## 👤 Muallif

**Elshod ATC**  
Telegram: [@elshodatc111](https://t.me/elshodatc111)  
GitHub: [elshodatc111](https://github.com/elshodatc111)

---

## 📄 Litsenziya

Ushbu loyiha MIT litsenziyasi asosida ochiq manbali holda tarqatiladi.
