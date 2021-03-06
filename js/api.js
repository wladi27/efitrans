
function initGoogleAPI() {
  const $containerPrice = $('#container-price');

  let inputStart = document.getElementById('start');
  let inputEnd = document.getElementById('end');

  let autocomplete = new google.maps.places.SearchBox(inputStart);
  let autocomplete2 = new google.maps.places.SearchBox(inputEnd);

  document.getElementById('search').addEventListener('click', function() {
    $containerPrice.empty();
    let startPoint = autocomplete.getPlaces()[0];
    let pointOfArrival = autocomplete2.getPlaces()[0];
    let latitudStart = startPoint.geometry.location.lat();
    let longitudStart = startPoint.geometry.location.lng();
    let latitudEnd = pointOfArrival.geometry.location.lat();
    let longitudEnd = pointOfArrival.geometry.location.lng();
    $.ajax({
      url: `https://api.uber.com/v1.2/estimates/price?start_latitude=${latitudStart}&start_longitude=${longitudStart}&end_latitude=${latitudEnd}&end_longitude=${longitudEnd}`,
      headers: {
        'Authorization': 'Token ' + 'AFoFvmU6KV2cQy42a_sw_jI_-XMirLA3DTz3wnW0',
        'Accept-Language': 'en_US',
        'Content-Type': 'application/json'
      },
      success: function(response) {
        const data = response.prices;
        $containerPrice.append(`<tr>
            <th>SERVICIO</th>
            <th>PRECIO(aprox.)</th>
            <th>Km</th>
             <th>Tiempo</th>
          </tr>`);

          for (var i = 0; i < data.length; i++) {
            let output = `
            <tr>
              <th>${data[i].display_name} </th>
              <td> S/. ${data[i].low_estimate} - ${data[i].high_estimate} </td>
              <td>${((data[i].distance)*1.609).toFixed(1)}km</td>
               <td>${(data[i].duration)/60} min.</td>
            </tr>
            `;
            $containerPrice.append(output);
        }
      }
    });
  });
}function calcDistance(start, end) {
			return(google.maps.geometry.spherical.computeDistanceBetween(start, end) / 1000).toFixed(2); //KM
		}
		function calcRoute() {
			var value_distance=document.querySelector("#value-distance");
			var value_price=document.querySelector("#value-price");
			var start = new google.maps.LatLng(locations[0].lat(), locations[0].lng());
			var end = new google.maps.LatLng(locations[1].lat(), locations[1].lng());
			var distance=calcDistance(start, end);
			value_distance.innerHTML=distance;
			value_price.innerHTML=(distance * 5) + " USD"; // We can use .toFixed()...
			var bounds = new google.maps.LatLngBounds();
			bounds.extend(start);
			bounds.extend(end);
			map.fitBounds(bounds);
			var request = {
				travelMode: google.maps.TravelMode.DRIVING,
				origin: start,
				destination: end,
			};
