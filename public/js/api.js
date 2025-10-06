// public/js/api.js
export async function fetchData(url) {
  const res = await fetch(url);
  return res.json();
}

export async function postData(url, data) {
  const res = await fetch(url, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(data)
  });
  return res.json();
}
