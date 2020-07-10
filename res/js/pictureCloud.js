var map;
function createMap() {
   map = L.map('mapid').setView([48.210033, 16.363449], 13);

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
  }).addTo(map);
}

function addMarker(lat, long, text) {
  L.marker([lat, long]).addTo(map)
    .bindPopup(text)
    .openPopup();
}
