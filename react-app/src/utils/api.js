import axios from "axios"

const API_URL = 'http://weather.local/api';

const Api = {
  getFromApi: async (cityName) => {
     try {
        const response = await axios.get(API_URL + '/search-api', {
          params: {
            city_name: cityName
          }
        });
        console.log(response.data);
      } catch (err) {
        console.log(err);
      }
  } 
}

export default Api;