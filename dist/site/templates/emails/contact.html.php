<p>Es gibt eine neue Nachricht von <strong><?= $sender['name'] ?></strong>:</p>

<p><?= $text ?></p>


-------------

<p><strong>Eintrag:</strong> <?= $entryUri ?></p>
<p><strong>Name:</strong> <?= $sender['name'] ?></p>
<p><strong>E-Mail:</strong> <?= $sender['mail'] ?? '–' ?></p>
<p><strong>Telefon:</strong> <?= $sender['phone'] ?? '–' ?></p>
