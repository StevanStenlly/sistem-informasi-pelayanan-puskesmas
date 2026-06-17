<?php
$filter = $_GET['filterLaporan'] ?? 'semua';
$from = $_GET['from_date'] ?? '';
$to = $_GET['to_date'] ?? '';
$pdfUrl = "cetak-laporan.php?filterLaporan=$filter&from_date=$from&to_date=$to";
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Pratinjau & Cetak Laporan</title>
    <style>
        html,
        body {
            margin: 0;
            height: 100%;
        }

        iframe {
            width: 100%;
            height: 100%;
            border: none;
        }
    </style>
</head>

<body>
    <iframe id="pdfFrame" src="<?= $pdfUrl ?>"></iframe>
    <script>
        window.onload = function() {
            const iframe = document.getElementById('pdfFrame');
            iframe.onload = function() {
                iframe.contentWindow.focus();
                iframe.contentWindow.print();
            };
        };
    </script>
</body>

</html>