<!doctype html>
<html ⚡ lang="hu">
<head>
  <meta charset="utf-8">
  <title>Szövegelemzés – elemez-core</title>
  <link rel="canonical" href="./index.php">
  <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">

  <!-- AMP kötelező -->
  <script async src="https://cdn.ampproject.org/v0.js"></script>
  <script async custom-element="amp-list" src="https://cdn.ampproject.org/v0/amp-list-0.1.js"></script>
  <script async custom-template="amp-mustache" src="https://cdn.ampproject.org/v0/amp-mustache-0.2.js"></script>

  <style amp-custom>
    body {
      font-family: sans-serif;
      padding: 1rem;
      background: #fff;
      color: #222;
      line-height: 1.6;
    }
    h1 {
      font-size: 1.4rem;
      margin-bottom: 1rem;
    }
    .highlight {
      background: #ffeb3b;
    }
  </style>
</head>
<body>

  <h1>Szövegelemzés – elemez-core</h1>
<amp-list width="auto" height="400" layout="fixed-height"
          src="../api/amp-szoveg.php?__amp_source_origin=http://localhost"
          single-item>
  <template type="amp-mustache">
    {{{szoveg}}}
  </template>
</amp-list>
</body>
</html>
