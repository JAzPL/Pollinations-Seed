# Pollinations Seed Plan — Kwalifikator GitHub
# DEMO: https://app-j.pl/Pollinations/

![Built with Pollinations](https://img.shields.io/badge/Built%20with-Pollinations-8a2be2?style=for-the-badge&logoColor=white&labelColor=6a0dad)

> Skrypt sprawdza, czy profil GitHub spełnia kryteria kwalifikacji do programu **Pollinations Seed Plan**, wyświetla aktualny poziom użytkownika oraz generuje spersonalizowaną poradę AI z planem działania krok po kroku.

---

## 🇵🇱 Polski

### Opis

Narzędzie analizuje publiczny profil GitHub podanego użytkownika, przelicza punkty według systemu oceny Pollinations Seed Plan i pokazuje:

- aktualny **poziom** (1–5) z kolorowym oznaczeniem,
- **miniwykres słupkowy** czterech kategorii punktowych,
- **pasek postępu** w kierunku kwalifikacji (próg: 7 pkt),
- ile punktów brakuje **do kwalifikacji** i opcjonalnie **do następnego poziomu**,
- **poradę AI** z konkretnym planem krok po kroku — posortowaną od kategorii z największym potencjałem zysku,
- **wskazówki** jak zdobywać punkty w każdej kategorii.

### System punktacji

| Kategoria         | Przelicznik              | Maks. punktów |
|-------------------|--------------------------|---------------|
| Wiek konta        | miesiące × 0,5           | 6,0           |
| Gwiazdki GitHub   | gwiazdki × 0,1           | 5,0           |
| Commity           | commity × 0,1            | 3,0           |
| Publiczne repo    | repo × 0,5               | 1,0           |
| **Łącznie**       |                          | **15,0**      |
| **Próg kwalifikacji** |                      | **7,0**       |

### Poziomy

| Poziom | Nazwa                | Próg punktów |
|--------|----------------------|--------------|
| 1      | Początkujący         | 0–2          |
| 2      | Amator               | 2–4          |
| 3      | Średniozaawansowany  | 4–6          |
| 4      | Zaawansowany         | 6–7          |
| 5      | Zakwalifikowany 🎉   | 7+           |

### Integracja AI

- Model: **`deepseek`** (DeepSeek V3.2) przez [Pollinations API](https://gen.pollinations.ai) (darmowy, z reasoning)
- Endpoint: `POST https://gen.pollinations.ai/v1/chat/completions`
- Prompt przekazuje dokładne dane liczbowe użytkownika — AI oblicza ile konkretnie commitów, gwiazdek i repo jeszcze brakuje
- Porada ładuje się **asynchronicznie (AJAX)** — strona jest widoczna od razu, tekst AI pojawia się po ~15–30 sek.
- Wynik jest **cache'owany w sesji** (ten sam użytkownik + język = brak ponownego wywołania API)
- Przycisk **🔄 Odśwież poradę** czyści cache i generuje nową odpowiedź

### Dodatkowe funkcje

- 🌐 Obsługa języków: Polski, English, Deutsch
- 🖼️ Avatar GitHub użytkownika
- 🎉 Animacja confetti przy kwalifikacji (poziom 5)
- 📊 Miniwykres słupkowy kategorii z kolorami zależnymi od wypełnienia
- 💡 Wskazówki krok po kroku posortowane od najsłabszej kategorii
- 🔑 Klucz API Pollinations wpisywany bezpośrednio na stronie (zapisywany w sesji, maskowany, z przyciskiem podglądu i czyszczenia)
- 🏷️ Odznaka „Built with Pollinations" wyświetlana obok nazwy użytkownika w wynikach
- 🌐 Favicon logo Pollinations w karcie przeglądarki

### Wymagania

- PHP ≥ 7.4 z rozszerzeniami: `curl`, `json`, `session`
- Serwer HTTP (Apache, Nginx lub PHP built-in)
- Połączenie z internetem (GitHub API + Pollinations API)

### Instalacja i uruchomienie

```bash
# Sklonuj lub skopiuj plik index.php do katalogu serwera
# Uruchom serwer PHP (lokalnie):
php -S localhost:8080

# Otwórz w przeglądarce:
# http://localhost:8080
```

### Uwagi

- GitHub API bez tokenu pozwala na ~60 zapytań/h — przy intensywnym użytkowaniu warto dodać token w nagłówku `Authorization: Bearer TWOJ_TOKEN`.
- Model DeepSeek może odpowiadać 15–40 sekund. Spinner informuje użytkownika o oczekiwaniu.

---

## 🇬🇧 English

### Description

This tool analyzes a public GitHub user profile, calculates points according to the Pollinations Seed Plan scoring system, and displays:

- current **level** (1–5) with color-coded badge,
- **mini bar chart** of four scoring categories,
- **progress bar** toward qualification (threshold: 7 pts),
- how many points are missing **to qualify** and optionally **to the next level**,
- an **AI guide** with a concrete step-by-step action plan — sorted from the category with the highest gain potential,
- **tips** on how to earn points in each category.

### Scoring System

| Category          | Formula                  | Max points |
|-------------------|--------------------------|------------|
| Account age       | months × 0.5             | 6.0        |
| GitHub stars      | stars × 0.1              | 5.0        |
| Commits           | commits × 0.1            | 3.0        |
| Public repos      | repos × 0.5              | 1.0        |
| **Total**         |                          | **15.0**   |
| **Qualification** |                          | **7.0**    |

### Levels

| Level | Name          | Points threshold |
|-------|---------------|------------------|
| 1     | Beginner      | 0–2              |
| 2     | Amateur       | 2–4              |
| 3     | Intermediate  | 4–6              |
| 4     | Advanced      | 6–7              |
| 5     | Qualified 🎉  | 7+               |

### AI Integration

- Model: **`deepseek`** (DeepSeek V3.2) via [Pollinations API](https://gen.pollinations.ai) (free, reasoning-enabled)
- Endpoint: `POST https://gen.pollinations.ai/v1/chat/completions`
- The prompt passes the user's exact numeric data — AI calculates precisely how many more commits, stars, and repos are needed
- Advice loads **asynchronously (AJAX)** — the page renders immediately, AI text appears after ~15–30 sec.
- Results are **session-cached** (same user + language = no repeated API call)
- **🔄 Refresh advice** button clears cache and generates a new response

### Additional Features

- 🌐 Multilingual: Polish, English, German
- 🖼️ GitHub user avatar
- 🎉 Confetti animation on qualification (level 5)
- 📊 Mini bar chart per category with fill-based color coding
- 💡 Step-by-step tips sorted from the weakest category
- 🔑 Pollinations API key entered directly on the page (stored in session, masked input with show/clear button)
- 🏷️ "Built with Pollinations" badge displayed next to the username in results
- 🌐 Pollinations logo favicon in the browser tab

### Requirements

- PHP ≥ 7.4 with extensions: `curl`, `json`, `session`
- HTTP server (Apache, Nginx or PHP built-in)
- Internet access (GitHub API + Pollinations API)

### Installation & Usage

```bash
# Copy index.php to your web server directory
# Or run PHP built-in server locally:
php -S localhost:8080

# Open in browser:
# http://localhost:8080
```

### Notes

- GitHub API without a token allows ~60 requests/h. For heavy usage, add `Authorization: Bearer YOUR_TOKEN` to the request headers.
- The DeepSeek model may take 15–40 seconds to respond. A spinner keeps the user informed during this time.

---

## 🇩🇪 Deutsch

### Beschreibung

Dieses Tool analysiert ein öffentliches GitHub-Profil, berechnet Punkte nach dem Pollinations Seed Plan Bewertungssystem und zeigt:

- aktuelles **Level** (1–5) mit farbiger Badge,
- **Mini-Balkendiagramm** der vier Punktekategorien,
- **Fortschrittsbalken** zur Qualifikation (Schwelle: 7 Pkt.),
- wie viele Punkte **zur Qualifikation** und optional **zum nächsten Level** fehlen,
- einen **KI-Ratgeber** mit konkretem Schritt-für-Schritt-Plan — sortiert nach der Kategorie mit dem größten Verbesserungspotenzial,
- **Tipps** wie man in jeder Kategorie Punkte sammelt.

### Punktesystem

| Kategorie          | Formel                    | Max. Punkte |
|--------------------|---------------------------|-------------|
| Kontoalter         | Monate × 0,5              | 6,0         |
| GitHub-Sterne      | Sterne × 0,1              | 5,0         |
| Commits            | Commits × 0,1             | 3,0         |
| Öffentliche Repos  | Repos × 0,5               | 1,0         |
| **Gesamt**         |                           | **15,0**    |
| **Qualifikation**  |                           | **7,0**     |

### Level-System

| Level | Name              | Punkteschwelle |
|-------|-------------------|----------------|
| 1     | Anfänger          | 0–2            |
| 2     | Amateur           | 2–4            |
| 3     | Fortgeschrittener | 4–6            |
| 4     | Experte           | 6–7            |
| 5     | Qualifiziert 🎉   | 7+             |

### KI-Integration

- Modell: **`deepseek`** (DeepSeek V3.2) über [Pollinations API](https://gen.pollinations.ai) (kostenlos, mit Reasoning)
- Endpunkt: `POST https://gen.pollinations.ai/v1/chat/completions`
- Der Prompt übergibt die genauen Zahlenwerte des Nutzers — die KI berechnet präzise, wie viele Commits, Sterne und Repos noch fehlen
- Ratschlag wird **asynchron (AJAX)** geladen — die Seite erscheint sofort, der KI-Text nach ~15–30 Sek.
- Ergebnisse werden **in der Session gecacht** (gleicher Nutzer + Sprache = kein erneuter API-Aufruf)
- **🔄 Ratschlag aktualisieren** löscht den Cache und generiert eine neue Antwort

### Weitere Funktionen

- 🌐 Mehrsprachig: Polnisch, Englisch, Deutsch
- 🖼️ GitHub-Avatar des Nutzers
- 🎉 Konfetti-Animation bei Qualifikation (Level 5)
- 📊 Mini-Balkendiagramm pro Kategorie mit füllungsabhängiger Farbgebung
- 💡 Schritt-für-Schritt-Tipps sortiert nach der schwächsten Kategorie
- 🔑 Pollinations API-Schlüssel direkt auf der Seite eingeben (in Session gespeichert, maskiertes Eingabefeld mit Anzeige- und Löschfunktion)
- 🏷️ „Built with Pollinations"-Badge neben dem Benutzernamen in den Ergebnissen
- 🌐 Pollinations-Logo als Favicon im Browser-Tab

### Voraussetzungen

- PHP ≥ 7.4 mit Erweiterungen: `curl`, `json`, `session`
- HTTP-Server (Apache, Nginx oder PHP built-in)
- Internetzugang (GitHub API + Pollinations API)

### Installation & Verwendung

```bash
# index.php in das Webserver-Verzeichnis kopieren
# Oder PHP-eigenen Server starten:
php -S localhost:8080

# Im Browser öffnen:
# http://localhost:8080
```

### Hinweise

- Die GitHub API erlaubt ohne Token ~60 Anfragen/Std. Bei intensiver Nutzung empfiehlt sich ein Token im Header `Authorization: Bearer DEIN_TOKEN`.
- Das DeepSeek-Modell kann 15–40 Sekunden brauchen. Ein Spinner informiert den Nutzer über die Wartezeit.
