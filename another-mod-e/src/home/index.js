import React from 'react';
import HabitRow from "../components/HabitRow.js"
import '../App.css';

function Home() {
  const [habits, setHabits] = React.useState(null);
  const [theme, setTheme] = React.useState("Light");

  // Handle Creation
  const [newHabitName, setNewHabitName] = React.useState("");
  const [selectedCategory, setSelectedCategory] = React.useState("");

  React.useEffect(() => {
    if (localStorage.getItem("habits") === null) {
      const template = {
        "Health": [],
        "Learning": [],
        "Productivity": []
      };
      localStorage.setItem("habits", JSON.stringify(template));
      setHabits(template);
    } else {
      setHabits(JSON.parse(localStorage.getItem("habits")));
    }
  }, []);

  const createHabit = () => {
    const newHabit = {
      "title": newHabitName,
      "category": selectedCategory,
      "streak": [false, false, false, false, false, false, false]
    }

    const updatedHabits = { ...habits };
    updatedHabits[selectedCategory].push(newHabit);
    setHabits(updatedHabits);
    localStorage.setItem("habits", JSON.stringify(updatedHabits));
  }

  const updateHabit = (habit) => {
    const updatedHabits = { ...habits };
    for (let i = 0; i < updatedHabits[habit.category]; i++) {
      if (updatedHabits[habit.category][i].title === habit.title) {
        updatedHabits[habit.category][i] = habit;
      }
    }
    setHabits(updatedHabits);
    localStorage.setItem("habits", JSON.stringify(updatedHabits));
  }

  const deleteHabit = (habit) => {
    let updatedHabits = { ...habits };
    updatedHabits[habit.category] = updatedHabits[habit.category].filter((val) => val.title != habit.title);
    setHabits(updatedHabits);
    localStorage.setItem("habits", JSON.stringify(updatedHabits));
  }

  const updateTheme = () => {
    if (theme === "Light") {
        setTheme("Dark")
        document.documentElement.setAttribute("media-theme", "dark");
    } else {
        setTheme("Light")
        document.documentElement.setAttribute("media-theme", "light");
    }
  }

  if (habits === null) {
    return (
      <div>
        <p>Loading...</p>
      </div>
    )
  }

  return (
    <div className="App">
      <header>
        <h1>Habit Tracker</h1>
        <button className='btn' onClick={updateTheme}>{theme} Mode</button>
      </header>
      <div className="content">
        <div className='container'>
          <h2 className='title'>Add New Habit</h2>
          <form className="form">
            <input id='habit_name' type='text' placeholder='Habit Name' value={newHabitName} onChange={(e) => setNewHabitName(e.target.value)} />
            <select value={selectedCategory} onChange={(e) => setSelectedCategory(e.target.value)}>
              <option value="">Select Category</option>
              <option value="Health">Health</option>
              <option value="Learning">Learning</option>
              <option value="Productivity">Productivity</option>
            </select>
            <button className='submit' onClick={createHabit}>Add Habit</button>
          </form>
        </div>
        <div className='container'>
          <h2 className='title'>Your Habits</h2>
          <div>
            <h3>Health</h3>
            <div id='health-habits'>
              {habits["Health"].map((habit, index) => (
                <HabitRow habit={habit} setHabit={updateHabit} deleteHabit={deleteHabit} key={index} />
              ))}
            </div>
            <hr />
          </div>
          <div>
            <h3>Learning</h3>
            <div id='learning-habits'>
              {habits["Learning"].map((habit, index) => (
                <HabitRow habit={habit} setHabit={updateHabit} deleteHabit={deleteHabit} key={index} />
              ))}
            </div>
            <hr />
          </div>
          <div>
            <h3>Productivity</h3>
            <div id='productivity-habits'>
              {habits["Productivity"].map((habit, index) => (
                <HabitRow habit={habit} setHabit={updateHabit} deleteHabit={deleteHabit} key={index} />
              ))}
            </div>
            <hr />
          </div>
        </div>
      </div>
    </div>
  );
}

export default Home;