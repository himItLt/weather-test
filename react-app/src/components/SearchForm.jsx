import React, { useState } from 'react';

function SearchForm({onSearchDb, onSearchApi}) {
  const [cityName, setCityName] = useState('');

  const handleCityChange = (event) => {
    setCityName(event.target.value);
  };

  const handleSearchApi = () => {
    onSearchApi(cityName);
  };

  const handleSearchDb = () => {
    onSearchDb(cityName);
  }

  return (
    <div className="search-form">
      <div className="field">
        <label>City Name</label>
        <input
          id="city_name"
          type="text"
          value={cityName}
          onChange={handleCityChange}
        />
      </div>
      <div className="field">
        <button className="color-blue" onClick={handleSearchApi}>Get From Api</button>
      </div>
      <div className="field">
        <button className="color-yellow" onClick={handleSearchDb}>Get From DB</button>
      </div>
    </div>
  );
}

export default SearchForm