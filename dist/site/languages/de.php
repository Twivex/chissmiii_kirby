<?php

return [
    'code' => 'de',
    'default' => true,
    'direction' => 'ltr',
    'locale' => [
        'LC_ALL' => 'de_DE'
    ],
    'name' => 'Deutsch',
    'translations' => array_merge(
      json_decode(file_get_contents(option('resource_paths')['languages'] . 'de.json'), true),
      [
        'countdown-remaining' => 'noch',

        'cookie-title' => 'Wir haben Kekse!',
        'cookie-text' => 'Unsere Website verwendet Cookies und ähnliche Technologien. Mit einem Klick auf „Zustimmen“ erlaubst du uns alle Cookie-Arten zu speichern. Mit einem Klick auf „Einstellungen“ kannst du Cookies auf deine Bedürfnisse anpassen. Deine erteilte Einwilligung kannst du jederzeit ändern. Weitere Informationen dazu findest du in unserer (link: datenschutzerklarung text: Datenschutzerklärung).',
        'cookie-accept' => 'Zustimmen',
        'cookie-deny' => 'Schließen',
        'cookie-open-settings' => 'Einstellungen',
        'cookie-settings-title' => 'Cookie-Einstellungen',
        'cookie-settings-text' => 'Bitte wähle deine Cookie-Einstellungen.',
        'cookie-settings-required-title' => 'Erforderliche Cookies',
        'cookie-settings-required-text' => 'Es handelt sicht hier um funktionale Cookies, die die Nutzbarkeit der ChissMiii-Website unterstützen. Dabei werden grundlegende Funktionen der Website, wie etwa das Speichern der aktiven Session sowie der Cookie-Einstellungen, ermöglicht. Ohne diese Cookies funktioniert die Website nicht richtig. Rechtsgrundlage ist unser berechtigtes Interesse (Art. 6 Abs. 1 lit. f) DSGVO). Weitere Informationen findest du (link: datenschutzerklarung text: hier).',
        'cookie-settings-statistic-title' => 'Statistische Cookies',
        'cookie-settings-statistic-text' => 'Wir (ChissMiii) erhalten ein Verständnis davon, wie die Besucher mit unserer Website agieren (bspw. wie lange Besucher im Durchschnitt auf einer Seite bleiben, ob und wie oft sie wiederkehren). Diese Daten helfen uns dabei die Website für dich zu testen und zu verbessern. Zudem liefern uns diese Tracking-Technologien weitere Erkenntnisse der Werbeanalyse. Wir verwenden dazu die Tracking-Technologien von Google Analytics. Die durch Tracking-Technologien erzeugten Informationen können vereinzelt an Server in den USA übertragen und dort gespeichert werden. Wir verarbeiten deine Daten ausschließlich pseudonymisiert. Ein Rückschluss auf deine Person ist uns nicht möglich. Rechtsgrundlage ist deine Einwilligung (Art. 6 Abs. lit. 1 a) DSGVO). Weitere Informationen findest du (link: datenschutzerklarung text: hier).',
        'cookie-settings-application-title' => 'Anwendungsbezogene Cookies',
        'cookie-settings-application-text' => 'Um dir eine bestmögliche Nutzung unserer Website zu ermöglichen, nutzen wir (ChissMiii) auf bestimmten Seiten Dienste von Drittanbietern. Damit diese korrekt funktionieren, werden Cookies für die Anbieter YouTube und Google Maps gespeichert. Die dadurch erzeugten Informationen werden ausschließlich pseudonymisiert verarbeitet. Ein Rückschluss auf deine Person ist uns nicht möglich. Rechtsgrundlage ist deine Einwilligung (Art. 6 Abs. lit. 1 a) DSGVO). Weitere Informationen findest du (link: datenschutzerklarung text: hier).',
        'cookie-save-settings' => 'Einstellungen speichern',
        'application-cookie-required-text' => 'Dieser Inhalt benötigt anwendungsbezogene Cookies. Diese kannst du hier aktivieren.',

        'image-upload-modal-title' => 'Upload',
        'image-upload-modal-submit' => 'Upload starten',

        'password' => 'Passwort',
        'login' => 'Anmelden',
        'password-invalid-hint' => 'Das Passwort ist ungültig.',
        'required-field-desc' => '* Pflichtfeld',
      ]
    ),
    'url' => NULL
];