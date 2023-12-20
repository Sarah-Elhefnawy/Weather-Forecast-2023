
const searchInput = document.querySelector("#searchinput");
const searchButton = document.querySelector("#searchbutton");
const clearButton = document.querySelector("#clearButton");
const weatherTemperature = document.querySelector(".temprature");
const weatherDescription = document.querySelector(".description");
const weatherHumidity = document.querySelector(".numb-H");
const weatherWindSpeed = document.querySelector(".numb-W");

const getWeatherDetails = (cityName) => {
  fetch(`index.php?cityInput=${cityName}`)
    .then(response => response.json())
    (data => {
      if (data) {
        weatherTemperature.textContent = `${data.temperature}C`;
        weatherDescription.textContent = data.description;
        weatherHumidity.textContent = `${data.humidity}%`;
        weatherWindSpeed.textContent = `${data.windSpeed}m/s`;
      } else {
        weatherTemperature.textContent = "N/A";
        weatherDescription.textContent = "No data available";
        weatherHumidity.textContent = "N/A";
        weatherWindSpeed.textContent = "N/A";
      }
    })
    .catch(error => {
      console.log(error);
    });
};
searchButton.onclick = function () {
  const city = searchInput.value.trim();
  if (city) {
    getWeatherDetails(city);
  }
};

clearButton.onclick = function () {
  searchInput.value = "";
};



