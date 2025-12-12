
function Message({message}) {
    return (
    <div className={`message ${message.ok ? 'success' : 'error'}`}>
        <h2>{message.ok ? 'Success' : 'Error'}</h2>        
        <h3>{message.text}</h3>
        {message.errors && (
            <ul>
                {message.errors.map((error) => (
                  <li key={error.attr}><b>{error.attr}</b> {error.msg}</li>
                ))}
            </ul>
        )}
    </div>
  );
}

export default Message