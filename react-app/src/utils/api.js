import axios from "axios"

const API_URL = 'http://weather.local/api';

const Api = {
  prepareResult: (apiData) => {
    let result = {
      message: null,
      data: null
    };

    if (apiData.success) {
      result.message = {
        ok: true,
        text: apiData.message,
        errors: null
      };
      result.data = apiData.data;
      return result;
    }

    console.log(apiData);

    result.message = {
      ok: false,
      text: apiData.message,
      errors: []
    }

    if (apiData.data) {
        for (let key in apiData.data) {
          result.message.errors.push({
            attr: key,
            msg: apiData.data[key][0]
          });
        };
    }

    return result;
  },

  getFromApi: async (cityName, setMessage, setData) => {
     try {
        const response = await axios.get(API_URL + '/search-api', {
          params: {
            city_name: cityName
          }
        });
        const result = Api.prepareResult(response.data);
        console.log('Api: ', result);
        setMessage(result.message);
        setData(result.data);
      } catch (err) {
        console.log(err);
      }
  },

  getFromDb: async (cityName, setMessage, setData) => {
     try {
        const response = await axios.get(API_URL + '/search-db', {
          params: {
            city_name: cityName
          }
        });
        const result = Api.prepareResult(response.data);
        console.log('DB: ', result);
        setMessage(result.message);
        setData(result.data);
      } catch (err) {
        console.log(err);
      }
  },

  saveForecast: async (cityName, forecast, setMessage) => {
     try {
        const response = await axios.post(API_URL + '/search-db', {
          city_name: cityName,
          ...forecast  
        });
        const result = Api.prepareResult(response.data);
        console.log('Save to DB: ', result);
        setMessage(result.message);
      } catch (err) {
        console.log(err);
      }
  },
}

export default Api;