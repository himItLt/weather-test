
function ForecastsList({forecasts}) {
    return (
    <div className="results-table">
      <table>
        <thead>
          <th>Datetime</th>
          <th>Min temp</th>
          <th>Max temp</th>
          <th>Wind speed</th>
        </thead>
        <tbody>
          {forecasts && (
            <ul>
              {forecasts.map((item) => (
                <tr key={item.timestamp_dt}>
                  <td>{item.text_dt} pm</td>
                  <td>{item.min_temp} &deg;C</td>
                  <td>{item.max_temp} &deg;C</td>
                  <td>{item.wind_speed} km/h</td>
                </tr>
              ))}
            </ul>
          )}
        </tbody>
      </table>
    </div>
  );
}

export default ForecastsList