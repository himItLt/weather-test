import React, { useState, useEffect } from 'react';
import Api from './utils/api';
import Message from './components/Message';
import Loader from './components/Loader';
import SearchForm from './components/SearchForm';

function App() {
  const [apiData, setApiData] = useState(null);
  const [dbData, setDbData] = useState(null);
  const [loading, setLoading] = useState(null);
  const [message, setMessage] = useState(null);

  const searchApi = () => {
    setLoading('Searching...');
    setMessage(null);
    setApiData(null);
    Api.getFromApi('', setMessage, setApiData);
    setLoading(null);

    console.log('API data:', apiData);
  }

  const searchDb = () => {
    setLoading('Searching...');
    Api.getFromDb('', setMessage, setDbData);
    setLoading(null);
  }

  const saveForecast = () => {
    if (!apiData) {
      return;
    }
    setLoading('Saving...');
    Api.saveForecast(apiData.city_name, apiData.forecasts[0], setMessage);
    setLoading(null);
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
        {}
      </main>
    </div>
  )
}

export default App;
