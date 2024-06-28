<template>
  <div class="app-container">
    <h1 class="app-title">Uber-like App</h1>
    <input id="autocomplete" type="text" placeholder="Enter a destination" />
    <button @click="searchRoute">Buscar Viaje</button>
    <div id="map"></div>
  </div>
</template>

<script>
/* global google */
import { Loader } from "@googlemaps/js-api-loader";

export default {
  name: "MapComponent",
  data() {
    return {
      map: null,
      autocomplete: null,
      marker: null,
      directionsService: null,
      directionsRenderer: null,
    };
  },
  mounted() {
    this.initMap();
  },
  methods: {
    initMap() {
      const loader = new Loader({
        apiKey: "AIzaSyDb7qCYiFIkmotwatMiwU61Fk3LsJr3zuw",
        version: "weekly",
        libraries: ["places", "directions"]
      });

      loader.load()
        .then(() => {
          this.map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: -34.397, lng: 150.644 },
            zoom: 8,
          });

          this.directionsService = new google.maps.DirectionsService();
          this.directionsRenderer = new google.maps.DirectionsRenderer({
            map: this.map,
            suppressMarkers: true, // Suprime los marcadores de inicio y fin predeterminados
            preserveViewport: true, // Mantiene el zoom y la posición actuales del mapa
            polylineOptions: {
              strokeColor: "#1a73e8", // Color de la línea de la ruta
              strokeWeight: 6, // Grosor de la línea de la ruta
            },
          });

          if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
              (position) => {
                const pos = {
                  lat: position.coords.latitude,
                  lng: position.coords.longitude,
                };
                this.map.setCenter(pos);
                this.marker = new google.maps.Marker({
                  position: pos,
                  map: this.map,
                  title: "Your location",
                });
              },
              () => {
                console.error("Error: The Geolocation service failed.");
              }
            );
          } else {
            console.error("Error: Your browser doesn't support geolocation.");
          }

          const input = document.getElementById("autocomplete");
          this.autocomplete = new google.maps.places.Autocomplete(input);
          this.autocomplete.bindTo("bounds", this.map);
        })
        .catch(e => {
          console.error("Error loading Google Maps: ", e);
        });
    },

    searchRoute() {
      this.calculateAndDisplayRoute();
    },

    calculateAndDisplayRoute() {
      const destination = this.autocomplete.getPlace();
      if (!destination.geometry || !destination.geometry.location) {
        window.alert("No details available for input: '" + destination.name + "'");
        return;
      }

      const start = this.marker.getPosition();

      const request = {
        origin: start,
        destination: destination.geometry.location,
        travelMode: google.maps.TravelMode.DRIVING,
      };

      this.directionsService.route(request, (result, status) => {
        if (status === google.maps.DirectionsStatus.OK) {
          this.directionsRenderer.setDirections(result);

          // Ajusta el zoom y la posición del mapa para mostrar la ruta
          const bounds = new google.maps.LatLngBounds();
          result.routes[0].legs.forEach((leg) => {
            leg.steps.forEach((step) => {
              step.path.forEach((point) => {
                bounds.extend(point);
              });
            });
          });
          this.map.fitBounds(bounds);
        } else {
          window.alert("Directions request failed due to " + status);
        }
      });
    },
  },
};
</script>

<style>
.app-container {
  display: flex;
  flex-direction: column;
  align-items: center;
}

#map {
  height: 400px;
  width: 400px;
  background-color: #f0f0f0;
}

#autocomplete {
  width: 80%;
  padding: 10px;
  margin: 10px auto;
  display: block;
  background-color: #ffffff;
}

button {
  display: block;
  width: 80%;
  padding: 10px;
  margin: 10px auto;
  background-color: #4CAF50;
  color: white;
  border: none;
  border-radius: 4px;
  font-size: 16px;
  cursor: pointer;
}

button:hover {
  background-color: #45a049;
}

.app-title {
  text-align: center;
  font-size: 24px;
  margin-bottom: 20px;
  background-color: #4CAF50;
  color: white;
  padding: 10px;
}
</style>
