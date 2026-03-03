<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pollinations Seed: Calculator</title>
    <style>
        body { font-family: sans-serif; background-color: #f4f4f9; padding: 20px; color: #333; }
        #kontener-glowny { max-width: 600px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h1 { font-size: 24px; text-align: center; color: #2c3e50; }
        .wybor-jezyka { text-align: right; margin-bottom: 20px; }
        .wybor-jezyka select { padding: 5px; border-radius: 4px; border: 1px solid #ddd; }
        .pole-input { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"] { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; padding: 12px; background-color: #2ecc71; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; font-weight: bold; }
        button:hover { background-color: #27ae60; }
        #wyniki { margin-top: 30px; border-top: 2px solid #eee; padding-top: 20px; }
        .wiersz-statystyk { display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #fafafa; }
        .podsumowanie { font-weight: bold; font-size: 1.1em; margin-top: 15px; text-align: center; border: 1px solid #eee; padding: 10px; border-radius: 5px; }
        .sukces { background-color: #eafaf1; color: #27ae60; border-color: #2ecc71; }
        .brak-kwalifikacji { background-color: #fef5f5; color: #e74c3c; border-color: #e74c3c; }
        .blad { background: #fdf0f0; color: #c0392b; padding: 10px; border-radius: 4px; margin-top: 10px; text-align: center; }
    </style>
</head>
<body>

<?php
$jezyki = [
    'pl' => [
        'tytul' => 'Kwalifikacja do Planu Seed',
        'etykieta_uzytkownik' => 'Nazwa użytkownika GitHub:',
        'przycisk' => 'Sprawdź punkty',
        'wiek' => 'Wiek konta',
        'miesiace' => 'mies.',
        'commity' => 'Commity',
        'repo' => 'Publiczne repozytoria',
        'gwiazdki' => 'Gwiazdki GitHub',
        'suma' => 'Suma punktów',
        'status_ok' => 'Status: KWALIFIKUJE SIĘ',
        'status_brak' => 'Status: BRAK KWALIFIKACJI',
        'brakuje' => 'Brakuje',
        'blad' => 'Nie znaleziono użytkownika lub błąd API.',
        'wyniki_dla' => 'Wyniki dla'
    ],
    'en' => [
        'tytul' => 'Seed Plan Qualification',
        'etykieta_uzytkownik' => 'GitHub Username:',
        'przycisk' => 'Check Points',
        'wiek' => 'Account Age',
        'miesiace' => 'mo.',
        'commity' => 'Commits',
        'repo' => 'Public Repos',
        'gwiazdki' => 'GitHub Stars',
        'suma' => 'Total Score',
        'status_ok' => 'Status: ELIGIBLE',
        'status_brak' => 'Status: INELIGIBLE',
        'brakuje' => 'Needs',
        'blad' => 'User not found or API error.',
        'wyniki_dla' => 'Results for'
    ],
    'de' => [
        'tytul' => 'Seed-Plan Qualifikation',
        'etykieta_uzytkownik' => 'GitHub-Benutzername:',
        'przycisk' => 'Punkte prüfen',
        'wiek' => 'Kontotalter',
        'miesiace' => 'Mon.',
        'commity' => 'Commits',
        'repo' => 'Öffentliche Repos',
        'gwiazdki' => 'GitHub-Sterne',
        'suma' => 'Gesamtpunktzahl',
        'status_ok' => 'Status: QUALIFIZIERT',
        'status_brak' => 'Status: NICHT QUALIFIZIERT',
        'brakuje' => 'Fehlen noch',
        'blad' => 'Benutzer nicht gefunden oder API-Fehler.',
        'wyniki_dla' => 'Ergebnisse für'
    ]
];

$wybrany_jezyk = isset($_POST['jezyk']) && isset($jezyki[$_POST['jezyk']]) ? $_POST['jezyk'] : 'pl';
$t = $jezyki[$wybrany_jezyk];
?>

<div id="kontener-glowny">
    <div class="wybor-jezyka">
        <form id="formularz-jezyka" method="POST">
            <select name="jezyk" onchange="this.form.submit()">
                <option value="pl" <?php echo $wybrany_jezyk == 'pl' ? 'selected' : ''; ?>>🇵🇱 Polski</option>
                <option value="en" <?php echo $wybrany_jezyk == 'en' ? 'selected' : ''; ?>>🇬🇧 English</option>
                <option value="de" <?php echo $wybrany_jezyk == 'de' ? 'selected' : ''; ?>>🇩🇪 Deutsch</option>
            </select>
            <input type="hidden" name="uzytkownik_github" value="<?php echo isset($_POST['uzytkownik_github']) ? htmlspecialchars($_POST['uzytkownik_github']) : ''; ?>">
        </form>
    </div>

    <h1><?php echo $t['tytul']; ?></h1>
    
    <form method="POST">
        <input type="hidden" name="jezyk" value="<?php echo $wybrany_jezyk; ?>">
        <div class="pole-input">
            <label for="uzytkownik_github"><?php echo $t['etykieta_uzytkownik']; ?></label>
            <input type="text" id="uzytkownik_github" name="uzytkownik_github" required value="<?php echo isset($_POST['uzytkownik_github']) ? htmlspecialchars($_POST['uzytkownik_github']) : ''; ?>">
        </div>
        <button type="submit"><?php echo $t['przycisk']; ?></button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['uzytkownik_github']) && !isset($_POST['onchange'])) {
        $uzytkownik = urlencode($_POST['uzytkownik_github']);
        $naglowki = ['User-Agent: PHP-Seed-Checker', 'Accept: application/vnd.github.v3+json'];

        function pobierz_dane($url, $naglowki) {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $naglowki);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            $odpowiedz = curl_exec($ch);
            $kod_http = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            return ($kod_http === 200) ? json_decode($odpowiedz, true) : null;
        }

        $dane_uzytkownika = pobierz_dane("https://api.github.com/users/$uzytkownik", $naglowki);

        if ($dane_uzytkownika) {
            // Obliczenia (identyczne jak w skrypcie Python)
            $data_stworzenia = new DateTime($dane_uzytkownika['created_at']);
            $roznica = (new DateTime())->diff($data_stworzenia);
            $miesiace = ($roznica->y * 12) + $roznica->m;
            $punkty_wiek = min($miesiace * 0.5, 6.0);

            $liczba_repo = $dane_uzytkownika['public_repos'];
            $punkty_repo = min($liczba_repo * 0.5, 1.0);

            $dane_repo = pobierz_dane("https://api.github.com/users/$uzytkownik/repos?per_page=100", $naglowki);
            $suma_gwiazdek = 0;
            if ($dane_repo) foreach ($dane_repo as $r) $suma_gwiazdek += $r['stargazers_count'];
            $punkty_gwiazdki = min($suma_gwiazdek * 0.1, 5.0);

            $naglowki_c = array_merge($naglowki, ['Accept: application/vnd.github.cloak-preview+json']);
            $dane_c = pobierz_dane("https://api.github.com/search/commits?q=author:$uzytkownik", $naglowki_c);
            $liczba_c = $dane_c ? $dane_c['total_count'] : 0;
            $punkty_c = min($liczba_c * 0.1, 2.0);

            $suma = $punkty_wiek + $punkty_repo + $punkty_gwiazdki + $punkty_c;
            $status_klasa = ($suma >= 8.0) ? 'sukces' : 'brak-kwalifikacji';

            echo '<div id="wyniki">';
            echo '<h3>' . $t['wyniki_dla'] . ': ' . htmlspecialchars($dane_uzytkownika['login']) . '</h3>';
            echo '<div class="wiersz-statystyk"><span>' . $t['wiek'] . ':</span> <span>' . $miesiace . ' ' . $t['miesiace'] . ' -> ' . number_format($punkty_wiek, 1) . ' pkt</span></div>';
            echo '<div class="wiersz-statystyk"><span>' . $t['commity'] . ':</span> <span>' . $liczba_c . ' -> ' . number_format($punkty_c, 1) . ' pkt</span></div>';
            echo '<div class="wiersz-statystyk"><span>' . $t['repo'] . ':</span> <span>' . $liczba_repo . ' -> ' . number_format($punkty_repo, 1) . ' pkt</span></div>';
            echo '<div class="wiersz-statystyk"><span>' . $t['gwiazdki'] . ':</span> <span>' . $suma_gwiazdek . ' -> ' . number_format($punkty_gwiazdki, 1) . ' pkt</span></div>';
            echo '<div class="podsumowanie ' . $status_klasa . '">';
            echo $t['suma'] . ': ' . number_format($suma, 1) . ' / 14.0<br>';
            if ($suma >= 8.0) {
                echo $t['status_ok'];
            } else {
                echo $t['status_brak'] . ' (' . $t['brakuje'] . ' ' . number_format(8.0 - $suma, 1) . ' pkt)';
            }
            echo '</div></div>';
        } else {
            echo '<div class="blad">' . $t['blad'] . '</div>';
        }
    }
    ?>
</div>
</body>
</html>
