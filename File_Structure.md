# Project File Structure

## 📂 Core Pages (Frontend)
These are the main pages the user interacts with.
- **`hp.php`** - Home Page (Landing page, Hero section, Mapbox preview).
- **`d.php`** - Destinations Page (Hotel listings, Sorting, Booking modal triggers).
- **`mb.php`** - My Bookings Page (User's booked itineraries, Weather, QR Code).
- **`a.php`** - About Us Page (Company info, Contact details, YouTube video).

## 🧩 Components (Includes)
Reusable code blocks included in other pages.
- **`navbar.php`** - Navigation Bar (Logo, Links, Modals, Session checks).
- **`f.php`** - Footer (Contact info, Copyright, Social links).
- **`db.php`** - Database Connection (MSSQL `sqlsrv` setup).
- **`arrayimage.php`** - Hotel Data Array (Hardcoded hotel details: Price, Images, Location).
- **`verify.php`** - verification page for the qr code.

## ⚙️ Logic & Action Scripts (Backend)
Scripts that process forms and handle database operations.
- **`l.a.php`** - Login Action (Validates credentials, starts session).
- **`r.a.php`** - Register Action (Creates new user account).
- **`b.i.php`** - Booking Inquiry (Processes booking form data before payment).
- **`logout.php`** - Logout Action (Destroys session, redirects to home).

## 💳 Payment Integration (PayMongo)
Handling third-party payment flow.
- **`p.php`** - Payment Setup (Creates PayMongo Intent, Redirects to Checkout).
- **`p.s.php`** - Payment Success (Verifies payment, Inserts booking into DB).
- **`p.c.php`** - Payment Cancel (Handles cancelled transactions).

## 📄 Documentation & Guides
Project artifacts for headers and presentation.
- **`Project_Documentation.md`** - Full technical documentation.
- **`Presentation_Guide.txt`** - Cheat sheet for the live demo.
- **`Presentation_Script.md`** - Spoken script for the defense.
- **`README.md`** - Basic repo info.
- **`File_Structure.md`** - (This file) Map of the project.

## 📦 Legacy / Fallback Pages
Kept for redirects and backward compatibility.
- **`l.php`** - Legacy Login Page (Standalone).
- **`r.php`** - Legacy Register Page (Standalone).
- **`l_backup.php`** - Backup of original Login.
- **`r_backup.php`** - Backup of original Register.

## 📁 Directories
- **`images/`** - Contains hotel images, logos, and city folders (e.g., `elnido/`).
- **`.git/`** - Git repository data.
