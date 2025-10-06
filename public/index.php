<!doctype html>
<html ⚡ lang="hu">
<head>
  <meta charset="utf-8">
  <title>Szövegelemzés – elemez-core</title>
  <link rel="canonical" href="./index.php">
  <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">

  <!-- AMP alapok -->
  <script async src="https://cdn.ampproject.org/v0.js"></script>
  <script async custom-element="amp-list" src="https://cdn.ampproject.org/v0/amp-list-0.1.js"></script>
  <script async custom-template="amp-mustache" src="https://cdn.ampproject.org/v0/amp-mustache-0.2.js"></script>

  <style amp-custom>
    body { font-family: sans-serif; padding: 1rem; background: #fff; color: #222; line-height: 1.6; }
    h1 { font-size: 1.4rem; margin-bottom: 1rem; }
    .highlight { background: #ffeb3b; }
    .meta { margin-bottom: 1rem; padding: 0.5rem; background: #f5f5f5; border-left: 4px solid #ccc; }
    .content { white-space: pre-wrap; }
    .empty { color: #888; font-style: italic; }
  </style>
</head>
<body>

  <h1>Szövegelemzés – elemez-core</h1>

  <!-- Fontos: a src útvonal a public mappában levő JSON-ra mutasson -->
  <amp-list width="auto" height="600" layout="fixed-height"
            src="amp-szoveg.json">
    <template type="amp-mustache">
      {{#items}}
        {{#cim}}
          <div class="meta">
            <strong>{{cim}}</strong><br>
            {{#datum}}<em>{{datum}}</em><br>{{/datum}}
            {{#szerzo}}<span>{{szerzo}}</span>{{/szerzo}}
          </div>
        {{/cim}}

        {{#szoveg}}
          <div class="content">
            {{{szoveg}}}
          </div>
        {{/szoveg}}
      {{/items}}

      {{^items}}
        <div class="empty">Nincs megjeleníthető tartalom.</div>
      {{/items}}
    </template>
  </amp-list>

</body>
</html>
