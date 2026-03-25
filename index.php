<?php
session_start();

// --- Zarzadzanie kluczem API Pollinations w sesji ---
if (!empty($_POST['klucz_api'])) {
    $_SESSION['pollinations_klucz'] = trim($_POST['klucz_api']);
}
if (isset($_POST['wyczysc_klucz'])) {
    unset($_SESSION['pollinations_klucz']);
}
$aktywny_klucz_api = $_SESSION['pollinations_klucz'] ?? '';

// --- Konfiguracja jezykow ---
$jezyki = [
    'pl' => [
        'tytul'               => 'Kwalifikacja do Planu Seed',
        'etykieta_uzytkownik' => 'Nazwa użytkownika GitHub:',
        'przycisk'            => 'Sprawdź',
        'aktualny_poziom'     => 'Twój aktualny poziom',
        'do_kolejnego'        => 'Do następnego poziomu',
        'do_kwalifikacji'     => 'Do kwalifikacji brakuje',
        'zakwalifikowany'     => '🎉 Gratulacje! Jesteś zakwalifikowany!',
        'porada_ai'           => '🤖 Twój przewodnik AI',
        'blad'                => 'Nie znaleziono użytkownika lub błąd API.',
        'blad_ai'             => 'Nie udało się pobrać porady AI. Spróbuj odświeżyć.',
        'wyniki_dla'          => 'Analiza dla',
        'postep'              => 'Postęp do kwalifikacji',
        'pkt'                 => 'pkt',
        'ladowanie_ai'        => 'Generowanie porady AI… (może potrwać ~20 sek.)',
        'odswierz_ai'         => '🔄 Odśwież poradę',
        'kategorie'           => 'Twoje kategorie punktów',
        'kat_wiek'            => 'Wiek konta',
        'kat_commity'         => 'Commity',
        'kat_repo'            => 'Repozytoria',
        'kat_gwiazdki'        => 'Gwiazdki',
        'etykieta_klucz_api'  => 'Klucz API Pollinations:',
        'klucz_placeholder'   => 'Wklej klucz API…',
        'klucz_zapisany'      => '✓ Klucz zapisany w sesji',
        'klucz_brak'          => '⚠ Brak klucza — AI może nie działać',
        'wyczysc_klucz'       => 'Wyczyść',
        'aktywnosc_ok'        => '✓ Publiczna aktywność w ostatnich 90 dniach: OK',
        'aktywnosc_brak'      => '⚠ Brak publicznej aktywności w ostatnich 90 dniach — Pollinations może nie uznać kwalifikacji',
        'wskazowki'           => 'Jak zdobyć więcej punktów',
        'wskazowka_wiek'      => 'Konto musi mieć ≥12 miesięcy dla pełnych 6 pkt (0.5 pkt/miesiąc)',
        'wskazowka_gwiazdki'  => 'Publikuj i promuj projekty — każda gwiazdka = 0.1 pkt (maks. 5 pkt)',
        'wskazowka_commity'   => 'Commituj regularnie — każde 10 commitów = 1 pkt (maks. 3 pkt)',
        'wskazowka_repo'      => 'Miej ≥2 publiczne repozytoria dla maks. 1 pkt',
        'poziomy'             => [
            1 => 'Początkujący',
            2 => 'Amator',
            3 => 'Średniozaawansowany',
            4 => 'Zaawansowany',
            5 => 'Zakwalifikowany',
        ],
    ],
    'en' => [
        'tytul'               => 'Seed Plan Qualification',
        'etykieta_uzytkownik' => 'GitHub Username:',
        'przycisk'            => 'Check',
        'aktualny_poziom'     => 'Your current level',
        'do_kolejnego'        => 'To next level',
        'do_kwalifikacji'     => 'To qualify you need',
        'zakwalifikowany'     => '🎉 Congratulations! You are qualified!',
        'porada_ai'           => '🤖 Your AI Guide',
        'blad'                => 'User not found or API error.',
        'blad_ai'             => 'Could not fetch AI advice. Try refreshing.',
        'wyniki_dla'          => 'Analysis for',
        'postep'              => 'Progress to qualification',
        'pkt'                 => 'pts',
        'ladowanie_ai'        => 'Generating AI advice… (may take ~20 sec.)',
        'odswierz_ai'         => '🔄 Refresh advice',
        'kategorie'           => 'Your score categories',
        'kat_wiek'            => 'Account age',
        'kat_commity'         => 'Commits',
        'kat_repo'            => 'Repositories',
        'kat_gwiazdki'        => 'Stars',
        'etykieta_klucz_api'  => 'Pollinations API Key:',
        'klucz_placeholder'   => 'Paste your API key…',
        'klucz_zapisany'      => '✓ Key saved in session',
        'klucz_brak'          => '⚠ No key — AI may not work',
        'wyczysc_klucz'       => 'Clear',
        'aktywnosc_ok'        => '✓ Public activity in last 90 days: OK',
        'aktywnosc_brak'      => '⚠ No public activity in the last 90 days — Pollinations may not count your qualification',
        'wskazowki'           => 'How to earn more points',
        'wskazowka_wiek'      => 'Account must be ≥12 months old for full 6 pts (0.5 pts/month)',
        'wskazowka_gwiazdki'  => 'Publish & share projects — each star = 0.1 pts (max 5 pts)',
        'wskazowka_commity'   => 'Commit regularly — every 10 commits = 1 pt (max 3 pts)',
        'wskazowka_repo'      => 'Have ≥2 public repositories for max 1 pt',
        'poziomy'             => [
            1 => 'Beginner',
            2 => 'Amateur',
            3 => 'Intermediate',
            4 => 'Advanced',
            5 => 'Qualified',
        ],
    ],
    'de' => [
        'tytul'               => 'Seed-Plan Qualifikation',
        'etykieta_uzytkownik' => 'GitHub-Benutzername:',
        'przycisk'            => 'Prüfen',
        'aktualny_poziom'     => 'Dein aktuelles Level',
        'do_kolejnego'        => 'Zum nächsten Level fehlen',
        'do_kwalifikacji'     => 'Zur Qualifikation fehlen',
        'zakwalifikowany'     => '🎉 Glückwunsch! Du bist qualifiziert!',
        'porada_ai'           => '🤖 Dein KI-Ratgeber',
        'blad'                => 'Benutzer nicht gefunden oder API-Fehler.',
        'blad_ai'             => 'KI-Ratschlag nicht verfügbar. Bitte aktualisieren.',
        'wyniki_dla'          => 'Analyse für',
        'postep'              => 'Fortschritt zur Qualifikation',
        'pkt'                 => 'Pkt.',
        'ladowanie_ai'        => 'KI-Ratschlag wird generiert… (~20 Sek.)',
        'odswierz_ai'         => '🔄 Ratschlag aktualisieren',
        'kategorie'           => 'Deine Punktekategorien',
        'kat_wiek'            => 'Kontoalter',
        'kat_commity'         => 'Commits',
        'kat_repo'            => 'Repositories',
        'kat_gwiazdki'        => 'Sterne',
        'etykieta_klucz_api'  => 'Pollinations API-Schlüssel:',
        'klucz_placeholder'   => 'API-Schlüssel einfügen…',
        'klucz_zapisany'      => '✓ Schlüssel in Session gespeichert',
        'klucz_brak'          => '⚠ Kein Schlüssel — KI funktioniert möglicherweise nicht',
        'wyczysc_klucz'       => 'Löschen',
        'do_kolejnego'        => 'Zum nächsten Level',
        'aktywnosc_ok'        => '✓ Öffentliche Aktivität in den letzten 90 Tagen: OK',
        'aktywnosc_brak'      => '⚠ Keine öffentliche Aktivität in den letzten 90 Tagen — Pollinations erkennt deine Qualifikation möglicherweise nicht',
        'wskazowki'           => 'So sammelst du mehr Punkte',
        'wskazowka_wiek'      => 'Konto muss ≥12 Monate alt sein für volle 6 Pkt (0,5 Pkt/Monat)',
        'wskazowka_gwiazdki'  => 'Projekte veröffentlichen & teilen — jeder Stern = 0,1 Pkt (max. 5 Pkt)',
        'wskazowka_commity'   => 'Regelmäßig committen — je 10 Commits = 1 Pkt (max. 3 Pkt)',
        'wskazowka_repo'      => 'Mindestens 2 öffentliche Repos für max. 1 Pkt',
        'poziomy'             => [
            1 => 'Anfänger',
            2 => 'Amateur',
            3 => 'Fortgeschrittener',
            4 => 'Experte',
            5 => 'Qualifiziert',
        ],
    ],
];

$wybrany_jezyk = (isset($_POST['jezyk']) && isset($jezyki[$_POST['jezyk']])) ? $_POST['jezyk'] : 'pl';
$t = $jezyki[$wybrany_jezyk];

// --- Funkcje pomocnicze ---

function pobierz_dane($url, $naglowki) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $naglowki);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    $odpowiedz = curl_exec($ch);
    $kod_http  = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return ($kod_http === 200) ? json_decode($odpowiedz, true) : null;
}

function oblicz_poziom($suma) {
    if ($suma >= 7.0) return 5;
    if ($suma >= 6.0) return 4;
    if ($suma >= 4.0) return 3;
    if ($suma >= 2.0) return 2;
    return 1;
}

// Ile punktow brakuje do kolejnego progu poziomu
function oblicz_brakuje_do_kolejnego($suma, $poziom) {
    $progi = [1 => 2.0, 2 => 4.0, 3 => 6.0, 4 => 7.0];
    if ($poziom >= 5 || !isset($progi[$poziom])) return 0.0;
    return max(0.0, $progi[$poziom] - $suma);
}

// Kolory odpowiadajace danemu poziomowi (ciemny, jasny)
function kolor_poziomu($poziom) {
    $mapa = [
        1 => ['#7f8c8d', '#95a5a6'],
        2 => ['#2471a3', '#3498db'],
        3 => ['#d68910', '#f39c12'],
        4 => ['#7d3c98', '#9b59b6'],
        5 => ['#1e8449', '#27ae60'],
    ];
    return $mapa[$poziom] ?? $mapa[1];
}

// Kolor paska miniwykresu na podstawie procentu wypelnienia
function kolor_paska_kategorii($procent) {
    if ($procent >= 85) return '#27ae60';
    if ($procent >= 50) return '#3498db';
    if ($procent >= 25) return '#f39c12';
    return '#e74c3c';
}

// Budowanie promptu dla AI w wybranym jezyku
function buduj_prompt_ai($jezyk, $login, $miesiace, $pw, $liczba_c, $pc, $liczba_repo, $pr, $suma_gwiazdek, $pg, $suma, $poziom_nr, $nazwa_poziomu, $brakuje_kwal) {
    $s    = number_format($suma, 1);
    $b    = number_format($brakuje_kwal, 1);
    $fpw  = number_format($pw, 1);
    $fpc  = number_format($pc, 1);
    $fpr  = number_format($pr, 1);
    $fpg  = number_format($pg, 1);

    $prompty = [
        'pl' => "Jestem uzytkownikiem GitHub '{$login}'. W kwalifikacji Pollinations Seed Plan mam {$s} punktow na 15 mozliwych (prog kwalifikacji: 7 pkt). Moj poziom: {$poziom_nr} ({$nazwa_poziomu}). Brakuje mi {$b} pkt.

Moje wyniki w poszczegolnych kategoriach:
- Wiek konta: {$miesiace} miesiecy → {$fpw} pkt (maks. 6 pkt, stawka: 0.5 pkt za kazdy miesiac)
- Commity: {$liczba_c} commitow → {$fpc} pkt (maks. 3 pkt, stawka: 0.1 pkt za kazdy commit)
- Repozytoria: {$liczba_repo} publicznych repo → {$fpr} pkt (maks. 1 pkt, stawka: 0.5 pkt za kazde repo)
- Gwiazdki: {$suma_gwiazdek} gwiazdek → {$fpg} pkt (maks. 5 pkt, stawka: 0.1 pkt za kazda gwiazdke)

Napisz po polsku:
1. Krotkie, motywujace zdanie otwierajace.
2. Konkretny plan krok po kroku — dla kazdej kategorii gdzie nie osiagam maksimum napisz DOKLADNIE co mam zrobic (np. ile commitow jeszcze zrobic, ile gwiazdek zdobyc, jak to osiagnac). Zacznij od kategorii z najwiekszym potencjalem zysku.
3. Jedno zdanie zamykajace zachecajace do dzialania.
Pisz bezposrednio do mnie, bez owijania w bawelne.",

        'en' => "I am GitHub user '{$login}'. In the Pollinations Seed Plan qualification I have {$s} out of 15 possible points (qualification threshold: 7 pts). My level: {$poziom_nr} ({$nazwa_poziomu}). I need {$b} more points.

My current scores per category:
- Account age: {$miesiace} months → {$fpw} pts (max 6 pts, rate: 0.5 pts per month)
- Commits: {$liczba_c} commits → {$fpc} pts (max 3 pts, rate: 0.1 pts per commit)
- Repositories: {$liczba_repo} public repos → {$fpr} pts (max 1 pt, rate: 0.5 pts per repo)
- Stars: {$suma_gwiazdek} stars → {$fpg} pts (max 5 pts, rate: 0.1 pts per star)

Write in English:
1. A short motivating opening sentence.
2. A concrete step-by-step plan — for each category where I haven't reached the maximum, write EXACTLY what I need to do (e.g. how many more commits, how many more stars, and how to achieve that). Start with the category with the highest gain potential.
3. One closing sentence encouraging action.
Address me directly, no fluff.",

        'de' => "Ich bin GitHub-Nutzer '{$login}'. Bei der Pollinations Seed Plan Qualifikation habe ich {$s} von 15 möglichen Punkten (Qualifikationsschwelle: 7 Pkt). Mein Level: {$poziom_nr} ({$nazwa_poziomu}). Mir fehlen {$b} Punkte.

Meine aktuellen Ergebnisse je Kategorie:
- Kontoalter: {$miesiace} Monate → {$fpw} Pkt (max. 6 Pkt, Rate: 0,5 Pkt pro Monat)
- Commits: {$liczba_c} Commits → {$fpc} Pkt (max. 3 Pkt, Rate: 0,1 Pkt pro Commit)
- Repositories: {$liczba_repo} öffentliche Repos → {$fpr} Pkt (max. 1 Pkt, Rate: 0,5 Pkt pro Repo)
- Sterne: {$suma_gwiazdek} Sterne → {$fpg} Pkt (max. 5 Pkt, Rate: 0,1 Pkt pro Stern)

Schreibe auf Deutsch:
1. Einen kurzen, motivierenden Eröffnungssatz.
2. Einen konkreten Schritt-für-Schritt-Plan — für jede Kategorie, in der ich das Maximum noch nicht erreicht habe, schreibe GENAU, was ich tun soll (z. B. wie viele Commits noch fehlen, wie viele Sterne ich brauche und wie ich das erreichen kann). Beginne mit der Kategorie mit dem größten Gewinnpotenzial.
3. Einen abschließenden Satz, der zur Tat auffordert.
Sprich mich direkt an, ohne Umschweife.",
    ];
    return $prompty[$jezyk] ?? $prompty['en'];
}

// Wywolanie Pollinations API z modelem perplexity-reasoning
function pobierz_porade_ai($prompt, $klucz_api) {
    $payload = json_encode([
        'model'      => 'deepseek',
        'messages'   => [
            [
                'role'    => 'system',
                'content' => 'You are a concise, motivating coach for GitHub developers. Give practical, specific, actionable advice. Keep your response under 350 words. Use short paragraphs. No bullet lists longer than 5 items.',
            ],
            [
                'role'    => 'user',
                'content' => $prompt,
            ],
        ],
        'max_tokens' => 2000,
    ]);

    $ch = curl_init('https://gen.pollinations.ai/v1/chat/completions');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    $naglowki_curl = ['Content-Type: application/json', 'User-Agent: PHP-Seed-Checker'];
    if ($klucz_api) {
        $naglowki_curl[] = 'Authorization: Bearer ' . $klucz_api;
    }
    curl_setopt($ch, CURLOPT_HTTPHEADER, $naglowki_curl);
    curl_setopt($ch, CURLOPT_TIMEOUT, 55);
    $odpowiedz = curl_exec($ch);
    curl_close($ch);

    if (!$odpowiedz) return null;

    $json  = json_decode($odpowiedz, true);
    $tekst = $json['choices'][0]['message']['content'] ?? null;

    if ($tekst) {
        // Usun tagi myslenia modelu reasoning
        $tekst = preg_replace('/<think>[\s\S]*?<\/think>/i', '', $tekst);
        // Usun odniesienia do zrodel np. [1], [2][3], [^1]
        $tekst = preg_replace('/\[\^?\d+\]/', '', $tekst);
        $tekst = trim($tekst);
    }

    return $tekst ?: null;
}

// --- Obsluga zadania AJAX dla AI (wczesne wyjscie) ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['ajax_ai'])) {
    header('Content-Type: application/json; charset=utf-8');
    $klucz_sesji = $_POST['klucz_sesji'] ?? '';
    $wymuszone   = !empty($_POST['wymuszone']);

    if (!$klucz_sesji || !isset($_SESSION[$klucz_sesji])) {
        die(json_encode(['tekst' => null]));
    }

    $d           = $_SESSION[$klucz_sesji];

    // Zakwalifikowany nie potrzebuje porady
    if (isset($d['poziom']) && $d['poziom'] >= 5) {
        die(json_encode(['tekst' => null]));
    }

    $klucz_cache = 'ai_' . md5($d['login'] . $d['jezyk'] . round($d['suma'], 1));

    // Wymuzone odswiezenie kasuje cache
    if ($wymuszone) {
        unset($_SESSION[$klucz_cache]);
    }

    if (!isset($_SESSION[$klucz_cache])) {
        $prompt = buduj_prompt_ai(
            $d['jezyk'], $d['login'],
            $d['miesiace'], $d['punkty_wiek'],
            $d['liczba_c'], $d['punkty_c'],
            $d['liczba_repo'], $d['punkty_repo'],
            $d['suma_gwiazdek'], $d['punkty_gwiazdki'],
            $d['suma'], $d['poziom'], $d['nazwa_poziomu'], $d['brakuje_do_kwal']
        );
        $_SESSION[$klucz_cache] = pobierz_porade_ai($prompt, $aktywny_klucz_api);
    }

    die(json_encode(['tekst' => $_SESSION[$klucz_cache]]));
}

// --- Przetwarzanie formularza glownego ---
$wyniki            = null;
$uzytkownik_github = isset($_POST['uzytkownik_github']) ? trim($_POST['uzytkownik_github']) : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $uzytkownik_github !== '' && !isset($_POST['onchange'])) {
    $uzytkownik = urlencode($uzytkownik_github);
    $naglowki   = ['User-Agent: PHP-Seed-Checker', 'Accept: application/vnd.github.v3+json'];

    $dane_uzytkownika = pobierz_dane("https://api.github.com/users/{$uzytkownik}", $naglowki);

    if ($dane_uzytkownika) {
        // Obliczenia punktow
        $data_stworzenia  = new DateTime($dane_uzytkownika['created_at']);
        $roznica          = (new DateTime())->diff($data_stworzenia);
        $miesiace         = ($roznica->y * 12) + $roznica->m;
        $punkty_wiek      = min($miesiace * 0.5, 6.0);

        $liczba_repo     = $dane_uzytkownika['public_repos'];
        $punkty_repo     = min($liczba_repo * 0.5, 1.0);

        $dane_repo       = pobierz_dane("https://api.github.com/users/{$uzytkownik}/repos?per_page=100", $naglowki);
        $suma_gwiazdek   = 0;
        if ($dane_repo) foreach ($dane_repo as $r) $suma_gwiazdek += $r['stargazers_count'];
        $punkty_gwiazdki = min($suma_gwiazdek * 0.1, 5.0);

        $naglowki_c = array_merge($naglowki, ['Accept: application/vnd.github.cloak-preview+json']);
        $dane_c     = pobierz_dane("https://api.github.com/search/commits?q=author:{$uzytkownik}", $naglowki_c);
        $liczba_c   = $dane_c ? $dane_c['total_count'] : 0;
        $punkty_c   = min($liczba_c * 0.1, 3.0);


        $suma                 = $punkty_wiek + $punkty_repo + $punkty_gwiazdki + $punkty_c;
        $poziom               = oblicz_poziom($suma);
        $brakuje_do_kwal      = max(0.0, 7.0 - $suma);
        $brakuje_do_kolejnego = oblicz_brakuje_do_kolejnego($suma, $poziom);
        $procent_postep       = min(100, (int) round(($suma / 7.0) * 100));
        list($kolor_ciemny, $kolor_jasny) = kolor_poziomu($poziom);
        $nazwa_poziomu = $t['poziomy'][$poziom];
        $login         = htmlspecialchars($dane_uzytkownika['login']);
        $avatar_url    = htmlspecialchars($dane_uzytkownika['avatar_url'] ?? '');

        // Zapisz dane w sesji dla pozniejszego zadania AJAX
        $klucz_sesji_ai            = 'stats_' . uniqid('', true);
        $_SESSION[$klucz_sesji_ai] = [
            'jezyk'           => $wybrany_jezyk,
            'login'           => $login,
            'miesiace'        => $miesiace,
            'punkty_wiek'     => $punkty_wiek,
            'liczba_c'        => $liczba_c,
            'punkty_c'        => $punkty_c,
            'liczba_repo'     => $liczba_repo,
            'punkty_repo'     => $punkty_repo,
            'suma_gwiazdek'   => $suma_gwiazdek,
            'punkty_gwiazdki' => $punkty_gwiazdki,
            'suma'            => $suma,
            'poziom'          => $poziom,
            'nazwa_poziomu'   => $nazwa_poziomu,
            'brakuje_do_kwal' => $brakuje_do_kwal,
        ];

        // Dane do miniwykresu kategorii (procent wypelnienia wzgledem maks)
        $kategorie_wykresu = [
            'wiek'     => ['wartosc' => $punkty_wiek,     'maks' => 6.0, 'procent' => min(100, ($punkty_wiek     / 6.0) * 100)],
            'gwiazdki' => ['wartosc' => $punkty_gwiazdki, 'maks' => 5.0, 'procent' => min(100, ($punkty_gwiazdki / 5.0) * 100)],
            'commity'  => ['wartosc' => $punkty_c,        'maks' => 2.0, 'procent' => min(100, ($punkty_c        / 2.0) * 100)],
            'repo'     => ['wartosc' => $punkty_repo,     'maks' => 1.0, 'procent' => min(100, ($punkty_repo     / 1.0) * 100)],
        ];

        $wyniki = [
            'login'               => $login,
            'avatar_url'          => $avatar_url,
            'suma'                => $suma,
            'poziom'              => $poziom,
            'nazwa_poziomu'       => $nazwa_poziomu,
            'brakuje_do_kwal'     => $brakuje_do_kwal,
            'brakuje_do_kolejnego'=> $brakuje_do_kolejnego,
            'procent_postep'      => $procent_postep,
            'kolor_ciemny'        => $kolor_ciemny,
            'kolor_jasny'         => $kolor_jasny,
            'klucz_sesji'         => $klucz_sesji_ai,
            'kategorie_wykresu'   => $kategorie_wykresu,
        ];
    } else {
        $wyniki = ['blad' => true];
    }
}
?>
<!DOCTYPE html>
<html lang="<?php echo $wybrany_jezyk; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($t['tytul']); ?></title>
    <link rel="icon" type="image/svg+xml" href="https://raw.githubusercontent.com/pollinations/pollinations/main/assets/logo.svg">
    <script src="https://cdn.jsdelivr.net/npm/marked@12/marked.min.js"></script>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 24px 16px;
            color: #333;
        }

        #kontener-glowny {
            max-width: 660px;
            margin: 0 auto;
            background: #fff;
            padding: 36px 32px;
            border-radius: 18px;
            box-shadow: 0 12px 48px rgba(0,0,0,0.22);
        }

        /* Wybor jezyka */
        .wybor-jezyka { text-align: right; margin-bottom: 18px; }
        .wybor-jezyka select {
            padding: 6px 12px;
            border-radius: 6px;
            border: 1px solid #ddd;
            font-size: 14px;
            cursor: pointer;
            background: #fafafa;
        }

        h1 {
            font-size: 21px;
            text-align: center;
            color: #2c3e50;
            margin-bottom: 26px;
            font-weight: 700;
        }

        /* Formularz */
        .pole-input { margin-bottom: 14px; }
        label { display: block; margin-bottom: 6px; font-weight: 600; color: #555; font-size: 14px; }
        input[type="text"] {
            width: 100%;
            padding: 12px 14px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 15px;
            transition: border-color 0.2s;
        }
        input[type="text"]:focus { outline: none; border-color: #764ba2; }

        .przycisk-sprawdz {
            width: 100%;
            padding: 13px;
            background: linear-gradient(135deg, #764ba2, #667eea);
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 700;
            letter-spacing: 0.5px;
            transition: opacity 0.2s, transform 0.1s;
        }
        .przycisk-sprawdz:hover { opacity: 0.92; transform: translateY(-1px); }
        .przycisk-sprawdz:active { transform: translateY(0); }

        /* Sekcja wynikow */
        #sekcja-wynikow { margin-top: 30px; }

        /* Avatar i naglowek uzytkownika */
        .naglowek-wynikow {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 20px;
            padding: 12px 16px;
            background: #f8f9fa;
            border-radius: 10px;
        }
        .avatar-uzytkownika {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            border: 3px solid #e0e0e0;
            flex-shrink: 0;
        }
        .info-uzytkownika small { display: block; color: #999; font-size: 12px; margin-bottom: 2px; }
        .info-uzytkownika strong { font-size: 18px; color: #2c3e50; }
        .odznaka-pollinations { margin-left: auto; flex-shrink: 0; height: 28px; }

        /* Karta poziomu */
        .karta-poziomu {
            border-radius: 14px;
            padding: 26px 20px;
            text-align: center;
            margin-bottom: 20px;
            color: #fff;
            position: relative;
            overflow: hidden;
        }
        .karta-poziomu::before {
            content: '';
            position: absolute;
            top: -30%; right: -8%;
            width: 200px; height: 200px;
            border-radius: 50%;
            background: rgba(255,255,255,0.07);
        }
        .etykieta-nad-poziomem {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 2px;
            opacity: 0.8;
            margin-bottom: 4px;
        }
        .numer-poziomu  { font-size: 62px; font-weight: 900; line-height: 1; }
        .nazwa-poziomu  { font-size: 20px; font-weight: 700; margin-top: 6px; opacity: 0.95; }

        /* Miniwykres kategorii */
        .sekcja-kategorii { margin-bottom: 20px; }
        .tytul-sekcji {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #aaa;
            margin-bottom: 10px;
            font-weight: 600;
        }
        .wiersz-kategorii {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 8px;
        }
        .etykieta-kategorii {
            width: 110px;
            font-size: 13px;
            color: #555;
            flex-shrink: 0;
            text-align: right;
        }
        .pasek-kat-tlo {
            flex: 1;
            height: 10px;
            background: #ecf0f1;
            border-radius: 5px;
            overflow: hidden;
        }
        .pasek-kat-wypelnienie {
            height: 100%;
            border-radius: 5px;
            transition: width 0.9s ease;
        }
        .wartosc-kategorii {
            width: 56px;
            font-size: 12px;
            color: #777;
            text-align: right;
            flex-shrink: 0;
        }

        /* Pasek postepu do kwalifikacji */
        .sekcja-postepu { margin-bottom: 20px; }
        .etykieta-postepu {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            color: #666;
            margin-bottom: 7px;
            font-weight: 500;
        }
        .pasek-postepu {
            height: 13px;
            background: #ecf0f1;
            border-radius: 7px;
            overflow: hidden;
        }
        .wypelnienie-paska {
            height: 100%;
            border-radius: 7px;
            transition: width 0.9s ease;
        }

        /* Ramka z brakami */
        .ramka-brakuje {
            border-radius: 10px;
            padding: 14px 18px;
            margin-bottom: 22px;
            font-size: 15px;
            line-height: 1.6;
        }
        .ramka-brakuje.zakwalifikowany {
            background: #eafaf1;
            color: #1e8449;
            font-weight: 700;
            font-size: 17px;
            text-align: center;
        }
        .ramka-brakuje.brakuje { background: #fef9e7; color: #784212; }
        .linia-brakuje {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .linia-brakuje + .linia-brakuje {
            margin-top: 6px;
            padding-top: 6px;
            border-top: 1px solid rgba(0,0,0,0.07);
        }
        .linia-brakuje strong { font-size: 16px; }

        /* Karta AI */
        .karta-ai {
            background: #f8f6fc;
            border-left: 4px solid #764ba2;
            border-radius: 0 10px 10px 0;
            padding: 20px 22px;
        }
        .naglowek-ai-wiersz {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 14px;
        }
        .naglowek-ai {
            font-size: 12px;
            font-weight: 700;
            color: #764ba2;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }
        .przycisk-odswierz {
            background: none;
            border: 1px solid #764ba2;
            color: #764ba2;
            border-radius: 6px;
            padding: 4px 10px;
            font-size: 12px;
            cursor: pointer;
            transition: background 0.2s;
        }
        .przycisk-odswierz:hover  { background: #f0e8fa; }
        .przycisk-odswierz:disabled { opacity: 0.45; cursor: default; }

        /* Spinner ladowania AI */
        .spinner-ai {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #999;
            font-size: 14px;
            padding: 8px 0;
        }
        .kolo-spinner {
            width: 20px; height: 20px;
            border: 3px solid #e0d5f5;
            border-top-color: #764ba2;
            border-radius: 50%;
            animation: obrot 0.8s linear infinite;
            flex-shrink: 0;
        }
        @keyframes obrot { to { transform: rotate(360deg); } }

        .tresc-ai {
            font-size: 15px;
            line-height: 1.75;
            color: #3a3a3a;
        }
        .tresc-ai p  { margin-bottom: 10px; }
        .tresc-ai p:last-child { margin-bottom: 0; }
        .tresc-ai strong { font-weight: 700; color: #2c3e50; }
        .tresc-ai em { font-style: italic; }
        .tresc-ai h1, .tresc-ai h2, .tresc-ai h3 {
            font-size: 15px;
            font-weight: 700;
            color: #2c3e50;
            margin: 12px 0 6px;
        }
        .tresc-ai ul, .tresc-ai ol {
            padding-left: 20px;
            margin-bottom: 10px;
        }
        .tresc-ai li { margin-bottom: 4px; }
        .tresc-ai code {
            background: #ede9f7;
            border-radius: 4px;
            padding: 1px 5px;
            font-size: 13px;
            font-family: monospace;
        }
        .blad-ai {
            color: #bbb;
            font-style: italic;
            font-size: 14px;
        }

        /* Pole klucza API */
        .sekcja-klucza {
            margin-bottom: 14px;
            padding: 14px 16px;
            background: #f8f9fa;
            border-radius: 8px;
            border: 1px solid #e8e8e8;
        }
        .wiersz-klucza {
            display: flex;
            gap: 8px;
            align-items: center;
        }
        .wiersz-klucza input[type="password"],
        .wiersz-klucza input[type="text"] {
            flex: 1;
            padding: 8px 12px;
            font-size: 13px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-family: monospace;
            letter-spacing: 0.5px;
        }
        .wiersz-klucza input:focus { outline: none; border-color: #764ba2; }
        .przycisk-pokaz-klucz {
            background: none;
            border: 1px solid #ccc;
            border-radius: 6px;
            padding: 7px 10px;
            cursor: pointer;
            font-size: 13px;
            flex-shrink: 0;
            transition: background 0.15s;
        }
        .przycisk-pokaz-klucz:hover { background: #eee; }
        .status-klucza {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 7px;
            font-size: 12px;
        }
        .status-klucza.zapisany { color: #27ae60; }
        .status-klucza.brak     { color: #e67e22; }
        .przycisk-wyczysc-klucz {
            background: none;
            border: none;
            color: #c0392b;
            font-size: 12px;
            cursor: pointer;
            padding: 0;
            text-decoration: underline;
        }
        .przycisk-wyczysc-klucz:hover { color: #922b21; }

        /* Status aktywnosci 90 dni */
        .ramka-aktywnosc {
            border-radius: 8px;
            padding: 10px 16px;
            margin-bottom: 14px;
            font-size: 13px;
            font-weight: 600;
        }
        .aktywnosc-ok   { background: #eafaf1; color: #1e8449; }
        .aktywnosc-brak { background: #fef5e7; color: #9a4a00; border: 1px solid #f0c070; }

        /* Drugorzedna linia w ramce brakuje */
        .linia-brakuje--drugorzedna {
            font-size: 13px;
            color: #999;
        }
        .linia-brakuje--drugorzedna strong { font-size: 13px; color: #999; }

        /* Wskazowki */
        .sekcja-wskazowek { margin-bottom: 20px; }
        .wiersz-wskazowki {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            font-size: 13px;
            color: #555;
            margin-bottom: 6px;
            line-height: 1.45;
        }
        .ikona-wskazowki { flex-shrink: 0; font-size: 10px; margin-top: 3px; }

        /* Blad glowny */
        .blad-glowny {
            background: #fdf0f0;
            color: #c0392b;
            padding: 14px;
            border-radius: 8px;
            text-align: center;
            margin-top: 20px;
            font-weight: 500;
        }
    </style>
</head>
<body>
<div id="kontener-glowny">

    <!-- Wybor jezyka -->
    <div class="wybor-jezyka">
        <form id="formularz-jezyka" method="POST">
            <select name="jezyk" onchange="this.form.submit()">
                <option value="pl" <?php echo $wybrany_jezyk === 'pl' ? 'selected' : ''; ?>>🇵🇱 Polski</option>
                <option value="en" <?php echo $wybrany_jezyk === 'en' ? 'selected' : ''; ?>>🇬🇧 English</option>
                <option value="de" <?php echo $wybrany_jezyk === 'de' ? 'selected' : ''; ?>>🇩🇪 Deutsch</option>
            </select>
            <input type="hidden" name="uzytkownik_github" value="<?php echo htmlspecialchars($uzytkownik_github); ?>">
        </form>
    </div>

    <h1><?php echo $t['tytul']; ?></h1>

    <!-- Formularz wyszukiwania -->
    <form method="POST">
        <input type="hidden" name="jezyk" value="<?php echo $wybrany_jezyk; ?>">

        <!-- Pole klucza API Pollinations -->
        <div class="sekcja-klucza">
            <label for="pole-klucz-api"><?php echo $t['etykieta_klucz_api']; ?></label>
            <div class="wiersz-klucza">
                <input type="password" id="pole-klucz-api" name="klucz_api"
                       placeholder="<?php echo htmlspecialchars($t['klucz_placeholder']); ?>"
                       value="">
                <button type="button" class="przycisk-pokaz-klucz" id="przycisk-pokaz-klucz"
                        onclick="przelaczWidocznosc()">👁</button>
            </div>
            <div class="status-klucza <?php echo $aktywny_klucz_api ? 'zapisany' : 'brak'; ?>">
                <span><?php echo $aktywny_klucz_api ? $t['klucz_zapisany'] : $t['klucz_brak']; ?></span>
                <?php if ($aktywny_klucz_api): ?>
                <button type="submit" name="wyczysc_klucz" value="1" class="przycisk-wyczysc-klucz">
                    <?php echo $t['wyczysc_klucz']; ?>
                </button>
                <?php endif; ?>
            </div>
        </div>

        <div class="pole-input">
            <label for="pole-uzytkownik"><?php echo $t['etykieta_uzytkownik']; ?></label>
            <input type="text" id="pole-uzytkownik" name="uzytkownik_github" required
                   value="<?php echo htmlspecialchars($uzytkownik_github); ?>">
        </div>
        <button type="submit" class="przycisk-sprawdz"><?php echo $t['przycisk']; ?></button>
    </form>

    <?php if ($wyniki): ?>
    <div id="sekcja-wynikow">

        <?php if (isset($wyniki['blad'])): ?>
            <div class="blad-glowny"><?php echo $t['blad']; ?></div>

        <?php else:
            $w      = $wyniki;
            $kc     = $w['kolor_ciemny'];
            $kj     = $w['kolor_jasny'];
            $poziom = $w['poziom'];
        ?>

            <!-- Avatar i nazwa uzytkownika -->
            <div class="naglowek-wynikow">
                <?php if ($w['avatar_url']): ?>
                    <img src="<?php echo $w['avatar_url']; ?>" alt="avatar" class="avatar-uzytkownika">
                <?php endif; ?>
                <div class="info-uzytkownika">
                    <small><?php echo $t['wyniki_dla']; ?></small>
                    <strong><?php echo $w['login']; ?></strong>
                </div>
                <img src="https://img.shields.io/badge/Built%20with-Pollinations-8a2be2?style=for-the-badge&logo=data:image/png;base64,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&logoColor=white&labelColor=6a0dad"
                     alt="Built with Pollinations"
                     class="odznaka-pollinations">
            </div>

            <!-- Karta poziomu -->
            <div class="karta-poziomu"
                 style="background: linear-gradient(135deg, <?php echo $kc; ?>, <?php echo $kj; ?>);">
                <div class="etykieta-nad-poziomem"><?php echo $t['aktualny_poziom']; ?></div>
                <div class="numer-poziomu"><?php echo $poziom; ?></div>
                <div class="nazwa-poziomu"><?php echo $w['nazwa_poziomu']; ?></div>
            </div>

            <!-- Miniwykres kategorii punktow -->
            <div class="sekcja-kategorii">
                <div class="tytul-sekcji"><?php echo $t['kategorie']; ?></div>
                <?php
                $mapowanie_kategorii = [
                    'wiek'     => 'kat_wiek',
                    'gwiazdki' => 'kat_gwiazdki',
                    'commity'  => 'kat_commity',
                    'repo'     => 'kat_repo',
                ];
                foreach ($mapowanie_kategorii as $klucz => $klucz_tlumaczenia):
                    $kat       = $w['kategorie_wykresu'][$klucz];
                    $kolor_kat = kolor_paska_kategorii($kat['procent']);
                ?>
                <div class="wiersz-kategorii">
                    <span class="etykieta-kategorii"><?php echo $t[$klucz_tlumaczenia]; ?></span>
                    <div class="pasek-kat-tlo">
                        <div class="pasek-kat-wypelnienie"
                             style="width: <?php echo round($kat['procent']); ?>%; background: <?php echo $kolor_kat; ?>;"></div>
                    </div>
                    <span class="wartosc-kategorii">
                        <?php echo number_format($kat['wartosc'], 1); ?> / <?php echo number_format($kat['maks'], 0); ?> <?php echo $t['pkt']; ?>
                    </span>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Pasek postepu do kwalifikacji -->
            <div class="sekcja-postepu">
                <div class="etykieta-postepu">
                    <span><?php echo $t['postep']; ?></span>
                    <span><?php echo number_format($w['suma'], 1); ?> / 7.0 <?php echo $t['pkt']; ?></span>
                </div>
                <div class="pasek-postepu">
                    <div class="wypelnienie-paska"
                         style="width: <?php echo $w['procent_postep']; ?>%; background: linear-gradient(90deg, <?php echo $kc; ?>, <?php echo $kj; ?>);"></div>
                </div>
            </div>

            <!-- Informacja o brakujacej punktacji -->
            <?php if ($poziom >= 5): ?>
                <div class="ramka-brakuje zakwalifikowany">
                    <?php echo $t['zakwalifikowany']; ?>
                </div>
            <?php else: ?>
                <div class="ramka-brakuje brakuje">
                    <div class="linia-brakuje">
                        <span><?php echo $t['do_kwalifikacji']; ?>:</span>
                        <strong><?php echo number_format($w['brakuje_do_kwal'], 1); ?> <?php echo $t['pkt']; ?></strong>
                    </div>
                    <?php if ($w['brakuje_do_kolejnego'] < $w['brakuje_do_kwal']): ?>
                    <div class="linia-brakuje linia-brakuje--drugorzedna">
                        <span><?php echo $t['do_kolejnego']; ?>:</span>
                        <strong><?php echo number_format($w['brakuje_do_kolejnego'], 1); ?> <?php echo $t['pkt']; ?></strong>
                    </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <!-- Wskazowki jak zdobywac punkty -->
            <?php if ($poziom < 5): ?>
            <div class="sekcja-wskazowek">
                <div class="tytul-sekcji"><?php echo $t['wskazowki']; ?></div>
                <?php
                $wskazowki_kat = [
                    'wiek'     => ['klucz' => 'wskazowka_wiek',     'procent' => $w['kategorie_wykresu']['wiek']['procent']],
                    'gwiazdki' => ['klucz' => 'wskazowka_gwiazdki', 'procent' => $w['kategorie_wykresu']['gwiazdki']['procent']],
                    'commity'  => ['klucz' => 'wskazowka_commity',  'procent' => $w['kategorie_wykresu']['commity']['procent']],
                    'repo'     => ['klucz' => 'wskazowka_repo',     'procent' => $w['kategorie_wykresu']['repo']['procent']],
                ];
                // Sortuj: najpierw kategorie z najmniejszym wypelnieniem
                uasort($wskazowki_kat, fn($a, $b) => $a['procent'] <=> $b['procent']);
                foreach ($wskazowki_kat as $wsk):
                ?>
                <div class="wiersz-wskazowki">
                    <span class="ikona-wskazowki" style="color: <?php echo kolor_paska_kategorii($wsk['procent']); ?>">●</span>
                    <span><?php echo $t[$wsk['klucz']]; ?></span>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <?php if ($poziom < 5): ?>
            <!-- Karta porady AI -->
            <div class="karta-ai">
                <div class="naglowek-ai-wiersz">
                    <div class="naglowek-ai"><?php echo $t['porada_ai']; ?></div>
                    <button class="przycisk-odswierz" id="przycisk-odswierz" disabled>
                        <?php echo $t['odswierz_ai']; ?>
                    </button>
                </div>
                <!-- Spinner widoczny podczas ladowania AI -->
                <div class="spinner-ai" id="spinner-ai">
                    <div class="kolo-spinner"></div>
                    <span><?php echo $t['ladowanie_ai']; ?></span>
                </div>
                <!-- Tresc porady - wstrzykiwana przez AJAX -->
                <div class="tresc-ai" id="tresc-ai" style="display: none;"></div>
            </div>

            <!-- Ukryte dane dla JavaScript -->
            <input type="hidden" id="klucz-sesji"   value="<?php echo htmlspecialchars($w['klucz_sesji']); ?>">
            <input type="hidden" id="jezyk-ukryty"  value="<?php echo $wybrany_jezyk; ?>">
            <input type="hidden" id="poziom-ukryty" value="<?php echo $poziom; ?>">
            <input type="hidden" id="tekst-blad-ai" value="<?php echo htmlspecialchars($t['blad_ai']); ?>">
            <?php endif; ?>

        <?php endif; ?>
    </div>
    <?php endif; ?>

</div>

<!-- Biblioteka confetti (celebracja zakwalifikowania) -->
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.3/dist/confetti.browser.min.js"></script>
<script>
// Przelacza widocznosc klucza API (gwiazdki <-> tekst)
function przelaczWidocznosc() {
    var pole = document.getElementById('pole-klucz-api');
    pole.type = (pole.type === 'password') ? 'text' : 'password';
}

document.addEventListener('DOMContentLoaded', function () {
    var kluczSesjiEl = document.getElementById('klucz-sesji');
    if (!kluczSesjiEl) return;

    var poziom = parseInt(document.getElementById('poziom-ukryty').value || '0', 10);

    // Confetti dla zakwalifikowanego uzytkownika
    if (poziom >= 5 && typeof confetti === 'function') {
        confetti({ particleCount: 180, spread: 80, origin: { y: 0.55 } });
        setTimeout(function () {
            confetti({ particleCount: 80, spread: 110, origin: { y: 0.4 } });
        }, 700);
    }

    // Automatyczne ladowanie AI po zaladowaniu strony
    ladujAI(kluczSesjiEl.value, false);

    // Przycisk recznego odswiezenia porady
    var przyciskOdswierz = document.getElementById('przycisk-odswierz');
    if (przyciskOdswierz) {
        przyciskOdswierz.addEventListener('click', function () {
            ladujAI(kluczSesjiEl.value, true);
        });
    }
});

// Funkcja pobierajaca porade AI przez AJAX
function ladujAI(klucz, wymuszone) {
    var spinnerAI        = document.getElementById('spinner-ai');
    var trescAI          = document.getElementById('tresc-ai');
    var przyciskOdswierz = document.getElementById('przycisk-odswierz');
    var tekstBladAI      = document.getElementById('tekst-blad-ai').value || '';
    var jezyk            = document.getElementById('jezyk-ukryty').value || 'pl';

    // Pokaz spinner, ukryj stara tresc
    spinnerAI.style.display = 'flex';
    trescAI.style.display   = 'none';
    if (przyciskOdswierz) przyciskOdswierz.disabled = true;

    var params = new URLSearchParams({
        ajax_ai:     '1',
        klucz_sesji: klucz,
        wymuszone:   wymuszone ? '1' : '0',
        jezyk:       jezyk
    });

    fetch(window.location.href, {
        method:  'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body:    params.toString()
    })
    .then(function (r) { return r.json(); })
    .then(function (dane) {
        spinnerAI.style.display = 'none';
        trescAI.style.display   = 'block';
        if (przyciskOdswierz) przyciskOdswierz.disabled = false;

        if (dane.tekst) {
            trescAI.innerHTML = marked.parse(dane.tekst);
        } else {
            trescAI.innerHTML = '<span class="blad-ai">' + tekstBladAI + '</span>';
        }
    })
    .catch(function () {
        spinnerAI.style.display = 'none';
        trescAI.style.display   = 'block';
        trescAI.innerHTML = '<span class="blad-ai">' + tekstBladAI + '</span>';
        if (przyciskOdswierz) przyciskOdswierz.disabled = false;
    });
}
</script>
</body>
</html>
