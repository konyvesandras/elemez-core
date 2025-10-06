<!doctype html>
<html ⚡ lang="hu">
<head>
  <meta charset="utf-8">
  <title>elemez-core</title>
  <link rel="canonical" href="./index.php">
  <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">

  <!-- AMP kötelező -->
  <script async src="https://cdn.ampproject.org/v0.js"></script>

  <!-- AMP list és bind a dinamikus adatokhoz -->
  <script async custom-element="amp-list" src="https://cdn.ampproject.org/v0/amp-list-0.1.js"></script>
  <script async custom-element="amp-bind" src="https://cdn.ampproject.org/v0/amp-bind-0.1.js"></script>

  <style amp-custom>
    body {
      font-family: sans-serif;
      padding: 1rem;
      background: #f9f9f9;
      color: #222;
    }
    h1 {
      font-size: 1.4rem;
      margin-bottom: 1rem;
    }
    .word {
      display: inline-block;
      margin: 0.2rem;
      padding: 0.3rem 0.5rem;
      border-radius: 4px;
      cursor: pointer;
      background: #eee;
      transition: background 0.2s;
    }
    .word[highlighted] {
      background: #ffeb3b;
    }
  </style>
</head>
<body>

  <h1>Szövegelemzés – elemez-core</h1>

  <!-- Szavak betöltése az API-ból -->
  <amp-list width="auto" height="100" layout="fixed-height"
            src="../api/szoveg.php"
            single-item>
    <template type="amp-mustache">
      {{#szokivonat}}
        <span class="word"
              [highlighted]="kiemeltek.indexOf('{{.}}') >= 0 ? true : null"
              on="tap:AMP.setState({kiemeltek: (kiemeltek || []).concat(['{{.}}'])})">
          {{.}}
        </span>
      {{/szokivonat}}
    </template>
  </amp-list>

  <!-- Kiemelések állapot -->
  <amp-state id="kiemeltek">
    <script type="application/json">[]</script>
  </amp-state>

</body>
</html>
