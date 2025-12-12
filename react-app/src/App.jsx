import React, { useState, useEffect } from 'react';
import Api from './utils/api';
import Message from './components/Message';
import Loader from './components/Loader';
import SearchForm from './components/SearchForm';
import ApiDetails from './components/ApiDetails';
import DbDetails from './components/DbDetails';

function App() {
  const [apiData, setApiData] = useState(null);
  const [dbData, setDbData] = useState(null);
  const [loading, setLoading] = useState(null);
  const [message, setMessage] = useState(null);

  const reset = () => {
    setMessage(null);
    setDbData(null);
    setApiData(null);
  }
  const updateApiStatus = (apiMessage) => {
    setLoading(null);
    setMessage(apiMessage);
  }

  const searchApi = (cityName) => {
    setLoading('Searching...');
    reset();
    Api.getFromApi(cityName, updateApiStatus, setApiData);
  }

  const searchDb = (cityName) => {
    setLoading('Searching...');
    reset();
    Api.getFromDb(cityName, updateApiStatus, setDbData);
  }

  const saveForecast = () => {
    if (!apiData) {
      return;
    }
    setLoading('Saving...');
    setMessage(null);
    Api.saveForecast(apiData.city_name, apiData.forecasts[0], updateApiStatus);
  }

  useEffect(() => {
  }, []); 

  return (
    <div className='page'>
      <header>
        <h1>Wearther Forecast</h1>
      </header>
      <main>
        <SearchForm onSearchApi={searchApi} onSearchDb={searchDb}/>
        {loading && <Loader message={loading}/>}
        {message && <Message message={message}/>}
        {apiData && <ApiDetails 
          cityName={apiData.city_name}
          start={apiData.period_start}
          end={apiData.period_end}
          onForecastSave={saveForecast}
          forecasts={apiData.forecasts}
        />}
        {dbData && <DbDetails 
          cityName={dbData.city_name}
          updatedAt={dbData.updated_at}
          forecasts={[dbData]}
        />}
      </main>
    </div>
  )
}

export default App;
