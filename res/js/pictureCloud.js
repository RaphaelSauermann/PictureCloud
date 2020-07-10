var lmap;

function createMap() {
  lmap = L.map('mapid').setView([48.210033, 16.363449], 13);
  setTimeout(function() {
    lmap.invalidateSize()
  }, 400);
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
  }).addTo(lmap);

}

function addMarker(lat, long, text) {
  L.marker([lat, long]).addTo(lmap)
    .bindPopup(text)
    .openPopup();
  setTimeout(function() {
    lmap.invalidateSize()
  }, 400);
}
