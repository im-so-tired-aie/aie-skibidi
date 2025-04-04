import React from 'react';
import './App.css';
import Home from './home';
import Pomodoro from './pomodoro';

function App() {
  const [route, setRoute] = React.useState(window.location.pathname);

  React.useEffect(() => {
    const handlePopState = () => {
      setRoute(window.location.pathname)
    }

    window.addEventListener("popstate", handlePopState);
    return () => window.removeEventListener("popstate", handlePopState);
  }, []);

  const handleRoute = () => {
    switch (route) {
      case "/":
        return <Home />
      case "/pomodoro":
        return <Pomodoro />
      default:
        return <h1>Not Found</h1>
    }
  }

  return (
    <div>
      {handleRoute()}
    </div>
  );
}

export default App;
