import React, { useState, useEffect } from 'react';
import Api from './utils/api';

function App() {
  const [data, setData] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    Api.getFromApi('');
  }, []);  
}

export default App;
