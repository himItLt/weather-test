import ForecastsList from "./ForecastsList"

function ApiDetails({cityName, start, end, onForecastSave, forecasts}) {
  return (
    <>
    <div className='details'>
      <h2>{cityName}</h2>
      <h3>Period</h3>
      <div>
        <p>Startes at: {start} pm</p>
        <p>Ends at: {end} pm</p>
      </div>
      <button className="color-green" onClick={onForecastSave}>Save forecast</button>
    </div>
    {forecasts && <ForecastsList forecasts={forecasts}/>}
    </>
  );
}

export default ApiDetails