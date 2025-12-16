# Project File Structure

## 📂 Root Pages (Frontend)
These are the main pages the user interacts with.
- **`hp.php`** - Home Page (Landing page, Hero section, Mapbox preview).
- **`d.php`** - Destinations Page (Hotel listings, Sorting, Booking modal triggers).
- **`mb.php`** - My Bookings Page (User's booked itineraries, Weather, QR Code).
- **`a.php`** - About Us Page (Company info, Contact details, YouTube video).
- **`verify.php`** - Verification page for the QR code.

## 🧩 Includes (`includes/`)
Reusable code blocks included in other pages.
- **`navbar.php`** - Navigation Bar (Logo, Links, Modals, Session checks).
- **`f.php`** - Footer (Contact info, Copyright, Social links).
- **`db.php`** - Database Connection (MSSQL `sqlsrv` setup).
- **`arrayimage.php`** - Hotel Data Array (Hardcoded hotel details).

## ⚙️ Logic & Actions (`actions/`)
Scripts that process forms, handle database operations, and payments.
- **`l.a.php`** - Login Action.
- **`r.a.php`** - Register Action.
- **`b.i.php`** - Booking Inquiry.
- **`logout.php`** - Logout Action.
- **`p.php`** - Payment Setup (PayMongo).
- **`p.s.php`** - Payment Success.
- **`p.c.php`** - Payment Cancel.

## 📦 Miscellaneous (`miscellaneous/`)
Legacy and backup files.
- **`l.php`** - Legacy Login Page.
- **`r.php`** - Legacy Register Page.
- **`l_backup.php`** - Login Backup.
- **`r_backup.php`** - Register Backup.

## 📄 Documentation (`docs/`)
Project documentation and guides.
- **`Project_Documentation.md`** - Full technical documentation.
- **`Presentation_Guide.txt`** - Cheat sheet.
- **`Presentation_Script.md`** - Spoken script.
- **`File_Structure.md`** - (This file).
