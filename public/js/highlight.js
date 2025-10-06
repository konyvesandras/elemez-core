import { fetchData, postData } from './api.js';

let highlights = [];

/**
 * Szavak betöltése és kirajzolása
 */
export async function loadWords() {
  const data = await fetchData('../api/szoveg.php');
  const container = document.getElementById('words');
  container.innerHTML = '';

  // induláskor a szerverről jövő kiemeléseket átvesszük
  highlights = data.kiemeltek || [];

  data.szokivonat.forEach(word => {
    const span = document.createElement('span');
    span.textContent = word;
    span.className = 'word';
    if (highlights.includes(word)) {
      span.classList.add('highlighted');
    }
    span.addEventListener('click', () => toggleHighlight(span, word));
    container.appendChild(span);
  });
}

/**
 * Kiemelés váltása + azonnali mentés
 */
function toggleHighlight(span, word) {
  if (span.classList.contains('highlighted')) {
    span.classList.remove('highlighted');
    highlights = highlights.filter(w => w !== word);
  } else {
    span.classList.add('highlighted');
    if (!highlights.includes(word)) {
      highlights.push(word);
    }
  }
  // minden kattintás után mentés
  saveHighlights();
}

/**
 * Mentés az API-ba
 */
async function saveHighlights() {
  await postData('../api/kiemeles.php', { words: highlights });
}
