elemez-core/
│
├── public/              # Megjelenítés: AMP HTML, CSS, JS
│   └── index.php
│
├── process/             # Feldolgozás: szókivonat, elemzés, fordítás
│   ├── preprocess.php
│   └── functions.php
│
├── api/                 # Adatkiadás és mentés
│   ├── szoveg.php
│   └── kiemeles.php
│
├── data/                # Tárolt fájlok
│   ├── elemzes.txt
│   ├── szokivonat.json
│   ├── analyze.json
│   ├── translate.json
│   └── kiemeltek.json
│
├── README.md            # Projektleírás
└── .gitignore           # Verziótisztítás

# elemez-core

Moduláris szövegelemző rendszer AMP-kompatibilis megjelenítéssel.  
A projekt célja, hogy egy adott szövegből automatikusan kivonja az egyedi szavakat, elemzi őket, fordítást társít hozzájuk, és kiemelhetővé teszi őket a frontend felületen.

---

## 📁 Mappa-struktúra


---

## ⚙️ Használat

1. **Szöveg betöltése**: `data/elemzes.txt`
2. **Feldolgozás futtatása**: `process/preprocess.php`
   - Generálja: `szokivonat.json`, `analyze.json`, `translate.json`
3. **Megjelenítés**: `public/index.php` AMP sablonon keresztül
4. **Kiemelés mentése**: `api/kiemeles.php` JSON-be

---

## 🔧 Bővítési lehetőségek

- Morfológiai elemzés (`process/analyze/morph.php`)
- Hangfájlok kezelése (`public/assets/`)
- Többnyelvű fordítási modul (`translate.json` bővítése)
- Admin felület kiemelésekhez

---

## 📜 Licenc

Ez a projekt szabadon bővíthető, tanítható és újrahasznosítható.  
Készült a workflow maximalizmus jegyében – minden lépés dokumentálható és újraépíthető.





