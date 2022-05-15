const weatherGraden = document.querySelector("#vangsten_toevoegen_graden");
const weatherWindsnelheid = document.querySelector(
  "#vangsten_toevoegen_windsnelheid"
);
const weatherWindrichting = document.querySelector(
  "#vangsten_toevoegen_windrichting"
);
const weatherLuchtdruk = document.querySelector(
  "#vangsten_toevoegen_luchtdruk"
);

const getLocation = () => {
  if (navigator.geolocation) {
    return navigator.geolocation.getCurrentPosition(showLocation, errorHandler);
  } else {
    return "Geolocatie kan niet worden gevonden.";
  }
};

function showLocation(position) {
  let latitude = position.coords.latitude;
  let longitude = position.coords.longitude;

  if (latitude && longitude) {
    fetch(
      `https://api.openweathermap.org/data/2.5/weather?lat=${latitude}&lon=${longitude}&appid=3525c9422bbe438466abb19fe56e2f4b`
    )
      .then((res) => {
        return res.json();
      })
      .then((weather) => {
        console.log(weather);
        weatherGraden.value = weather.main.temp - 273.15;
        weatherWindsnelheid.value = weather.wind.speed * 3.6;
        let windrichting = weather.wind.deg;

        function degToCompass(num) {
          var val = Math.floor(num / 22.5 + 0.5);
          var arr = [
            "N",
            "NNO",
            "NO",
            "ONO",
            "O",
            "OZO",
            "ZO",
            "ZZO",
            "Z",
            "ZZW",
            "ZW",
            "WZW",
            "W",
            "WNW",
            "NW",
            "NNW",
          ];
          return arr[val % 16];
        }

        weatherWindrichting.value = degToCompass(windrichting);
        weatherLuchtdruk.value = weather.main.pressure;
      });
  }
}

function errorHandler(err) {
  if (err) {
    alert("Sorry, het weerbericht werkt niet");
  }
}

getLocation();
