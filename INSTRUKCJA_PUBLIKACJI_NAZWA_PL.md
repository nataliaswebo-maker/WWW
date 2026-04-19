# Instrukcja publikacji strony: GitHub Pages + domena `gcraft.com.pl` + formularz Formspree

To jest aktualna wersja instrukcji dla wariantu bez płatnego hostingu WWW:

1. publikujesz stronę na GitHub Pages (za darmo),
2. podłączasz własną domenę `gcraft.com.pl`,
3. formularz kontaktowy wysyła wiadomości na `natalia.swebo@gmail.com` przez Formspree (bez `send.php` i bez PHP).

---

## 1) Co przygotować lokalnie

W folderze projektu zostaw:

- `index.html`
- folder `img/` ze zdjęciami

Plik `send.php` nie jest potrzebny na GitHub Pages.

---

## 2) Ustawienie formularza pod Formspree

1. Załóż konto na [https://formspree.io](https://formspree.io).
2. Utwórz nowy formularz i skopiuj endpoint, np.:
   - `https://formspree.io/f/abcdwxyz`
3. W `index.html` znajdź formularz kontaktowy i podmień:
   - `action="send.php"`
   - na:
   - `action="https://formspree.io/f/abcdwxyz"`
4. W formularzu zostaw:
   - `method="POST"`
5. Zapisz plik.

Przykład:

```html
<form action="https://formspree.io/f/abcdwxyz" method="POST" class="space-y-5">
```

---

## 3) Publikacja strony na GitHub Pages

Zakładam, że repozytorium już masz na GitHub (u Ciebie: `nataliaswebo-maker/WWW`).

1. Wejdź na repo na GitHub.
2. Kliknij `Settings`.
3. W menu po lewej kliknij `Pages`.
4. W sekcji `Build and deployment` ustaw:
   - `Source`: `Deploy from a branch`
   - `Branch`: `main`
   - Folder: `/ (root)`
5. Kliknij `Save`.

Po chwili dostaniesz adres typu:
- `https://nataliaswebo-maker.github.io/WWW/`

---

## 4) Podpięcie domeny `gcraft.com.pl` do GitHub Pages

W repo GitHub:

1. `Settings` -> `Pages`
2. W polu `Custom domain` wpisz:
   - `gcraft.com.pl`
3. Kliknij `Save`.

Następnie w panelu `nazwa.pl` ustaw DNS domeny:

- rekord `A` dla `@` na:
  - `185.199.108.153`
  - `185.199.109.153`
  - `185.199.110.153`
  - `185.199.111.153`
- rekord `CNAME` dla `www` na:
  - `nataliaswebo-maker.github.io`

Po propagacji DNS (od kilku minut do 24h) domena zacznie działać.

---

## 5) Co sprawdzić po wdrożeniu

1. Otwórz:
   - `https://gcraft.com.pl`
2. Sprawdź, czy strona się ładuje (grafiki, style, sekcje).
3. Wyślij test z formularza.
4. Sprawdź skrzynkę:
   - `natalia.swebo@gmail.com`
   - folder `Spam`
5. W panelu Formspree sprawdź, czy wiadomość została zarejestrowana.

---

## 6) Jeśli formularz nie działa

1. Sprawdź, czy `action` formularza wskazuje na poprawny endpoint Formspree.
2. Sprawdź, czy endpoint jest aktywny (w panelu Formspree).
3. Sprawdź, czy formularz zawiera pola `name`, `email`, `message`.
4. Zrób ponowny test z innego adresu e-mail.

---

## 7) Dodatkowe wskazówki

- W darmowym planie Formspree są limity miesięczne.
- Jeśli chcesz, możesz dodać reCAPTCHA (ochrona przed spamem).
- `send.php` możesz zostawić w repo jako archiwum, ale nie będzie używany na GitHub Pages.

