import ForecastsList from "./ForecastsList"

function DbDetails({cityName, updatedAt, forecasts}) {
  return (
    <>
    <div className='details'>
      <h2>{cityName}</h2>
      <h3>Updated at: {updatedAt} UTC</h3>
    </div>
    {forecasts && <ForecastsList forecasts={forecasts}/>}
    </>
  );
}

export default DbDetails