if(document.querySelector('#mapa')){
    var map = L.map('mapa', { center: [31.741249688994845, -106.452393760853], scrollWheelZoom: false}).setView([31.741249688994845, -106.452393760853], 16);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    L.marker([31.741249688994845, -106.452393760853]).addTo(map)
        .bindPopup(
            `
            <h2 class="mapa__heading">&#60;DevWebCamp /> </h2>
            <p class="mapa__descripcion">Teatro del INBA</p>
            `
        )
        .openPopup();
}