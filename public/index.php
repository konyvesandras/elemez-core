<!doctype html>
<html ⚡ lang="hu">
<head>
  <meta charset="utf-8">
  <title>Szövegelemzés – elemez-core</title>
  <link rel="canonical" href="./index.php">
  <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">

  <!-- Kötelező AMP boilerplate -->
  <style amp-boilerplate>
    body {
      -webkit-animation: -amp-start 8s steps(1,end) 0s 1 normal both;
      -moz-animation: -amp-start 8s steps(1,end) 0s 1 normal both;
      -ms-animation: -amp-start 8s steps(1,end) 0s 1 normal both;
      animation: -amp-start 8s steps(1,end) 0s 1 normal both;
    }
    @-webkit-keyframes -amp-start { from { visibility: hidden } to { visibility: visible } }
    @-moz-keyframes -amp-start { from { visibility: hidden } to { visibility: visible } }
    @-ms-keyframes -amp-start { from { visibility: hidden } to { visibility: visible } }
    @-o-keyframes -amp-start { from { visibility: hidden } to { visibility: visible } }
    @keyframes -amp-start { from { visibility: hidden } to { visibility: visible } }
  </style>
  <noscript>
    <style amp-boilerplate>
      body {
        -webkit-animation: none;
        -moz-animation: none;
        -ms-animation: none;
        animation: none;
      }
    </style>
  </noscript>

  <!-- AMP alapok -->
  <script async src="https://cdn.ampproject.org/v0.js"></script>
  <script async custom-element="amp-list" src="https://cdn.ampproject.org/v0/amp-list-0.1.js"></script>
  <script async custom-template="amp-mustache" src="https://cdn.ampproject.org/v0/amp-mustache-0.2.js"></script>

  <!-- Saját stílusok -->
  <style amp-custom>
    body {
      font-family: system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
      padding: 1rem;
      background: #fff;
      color: #222;
      line-height: 1.6;
      max-width: 800px;
      margin: 0 auto;
    }
    h1 {
      font-size: 1.6rem;
      margin-bottom: 1.5rem;
      border-bottom: 2px solid #eee;
      padding-bottom: 0.5rem;
    }
    .meta {
      margin-bottom: 1.5rem;
      padding: 0.75rem;
      background: #f9f9f9;
      border-left: 4px solid #607d8b;
      font-size: 0.95rem;
      line-height: 1.4;
    }
    .meta strong {
      font-size: 1.05rem;
    }
    .content {
      white-space: pre-wrap;
      margin-bottom: 1.5rem;
      font-size: 1rem;
    }
    .footer {
      margin-top: 1.5rem;
      font-size: 0.9rem;
      color: #666;
      border-top: 1px solid #ddd;
      padding-top: 0.5rem;
    }
    .highlight {
      background: #ffeb3b;
      padding: 0 2px;
    }
    .empty {
      color: #888;
      font-style: italic;
      margin-top: 1rem;
    }
  </style>
</head>
<body>

  <h1>Szövegelemzés – elemez-core</h1>

  <amp-list width="auto" height="600" layout="fixed-height"
            src="./amp-szoveg.json">
    <template type="amp-mustache">

      {{#cim}}
        <div class="meta">
          <strong>{{cim}}</strong><br>
          {{#datum}}<em>{{datum}}</em><br>{{/datum}}
          {{#szerzo}}<span>{{szerzo}}</span><br>{{/szerzo}}
          {{#letoltes}}<a href="{{letoltes}}">Letöltés</a>{{/letoltes}}
          {{#meret}}<small> ({{meret}})</small>{{/meret}}
        </div>
      {{/cim}}

      {{#szoveg}}
        <div class="content">
          {{{szoveg}}}
        </div>
      {{/szoveg}}

      {{#zaras}}
        <div class="footer">{{zaras}}</div>
      {{/zaras}}

    </template>
  </amp-list>

  <div class="empty" hidden id="empty-state">Nincs megjeleníthető tartalom.</div>

</body>
</html>
