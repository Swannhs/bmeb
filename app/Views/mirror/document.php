<?= $document['doctype'] . PHP_EOL ?>
<html<?= $document['htmlAttributes'] !== '' ? ' ' . $document['htmlAttributes'] : '' ?>>
<head>
<?= $document['headContent'] . PHP_EOL ?>
</head>
<body<?= $document['bodyAttributes'] !== '' ? ' ' . $document['bodyAttributes'] : '' ?>>
<?= $document['bodyContent'] . PHP_EOL ?>
</body>
</html>
