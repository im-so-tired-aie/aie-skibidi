'use client';
import HabitContainer from "./components/habitcontainer";
import styles from "./page.module.css";
import { useEffect, useState } from "react";

export default function Home() {
  const [theme, setTheme] = useState("light");
  const [habits, setHabits] = useState({
    "health": [],
    "learning": [],
    "productivity": []
  });

  // Create Habit Attributes
  const [name, setName] = useState("");
  const [category, setCategory] = useState("");
  const handleAddHabit = () => {
    const newHabit = {
      title: name,
      category: category,
      days: [false, false, false, false, false, false, false]
    }

    const updatedHabits = { ...habits };
    updatedHabits[category].push(newHabit);
    setHabits(updatedHabits);
    localStorage.setItem("habits", JSON.stringify(updatedHabits));

    setName("");
    setCategory("");
  }

  useEffect(() => {
    const updateHabits = () => {
      if (localStorage.getItem("habits") === null) {
        localStorage.setItem("habits", JSON.stringify({
          "health": [],
          "learning": [],
          "productivity": []
        }));
      } else {
        setHabits(JSON.parse(localStorage.getItem("habits")));
      }
    }

    window.addEventListener("storage", function () {
      updateHabits();
    });

    updateHabits();
  }, []);

  const handleTheme = () => {
    if (theme === "light") {
      document.documentElement.setAttribute("data-theme", "dark");
      setTheme("dark");
    } else {
      document.documentElement.setAttribute("data-theme", "light");
      setTheme("light");
    }
  }

  return (
    <div className={styles.main}>
      <header className={styles.header}>
        Habit Tracker
        
        <button
          className={styles.themeBtn}
          onClick={handleTheme}
        >{theme === "light" ? "Dark" : "Light"} Mode</button>
      </header>

      <div className={styles.container}>
        <h1 className={styles.marginBottom}>Add New Habit</h1>

        <form>
          <div className={styles.inputContainer}>
            <input className={styles.input} name="habitName" placeholder="Habit Name" value={name} onChange={(e) => setName(e.target.value)} required />
            <select className={styles.input} name="category" value={category} onChange={(e) => setCategory(e.target.value)} required>
              <option value="">Select Category</option>
              <option value="health">Health</option>
              <option value="learning">Learning</option>
              <option value="productivity">Productivity</option>
            </select>
          </div>

          <button
            className={styles.button}
            onClick={handleAddHabit}
          >
            Add Habit
          </button>
        </form>
      </div>

      <div className={styles.container}>
        <h1 className={styles.marginBottom}>Your Habits</h1>

        <div className={styles.habitContainer}>
          <h2 className={styles.habitTitle}>Health</h2>
          <div id="health-habits">
            { habits.health && habits.health.map((habit, index) => (
              <HabitContainer key={index} habit={habit} val={index} />
            ))}
          </div>
          <hr />
        </div>

        <div className={styles.habitContainer}>
          <h2 className={styles.habitTitle}>Learning</h2>
          <div id="learning-habits">
            { habits.learning && habits.learning.map((habit, index) => (
              <HabitContainer key={index} habit={habit} val={index} />
            ))}
          </div>
          <hr />
        </div>

        <div className={styles.habitContainer}>
          <h2 className={styles.habitTitle}>Productivity</h2>
          <div id="productivity-habits">
            { habits.productivity && habits.productivity.map((habit, index) => (
              <HabitContainer key={index} habit={habit} val={index} />
            ))}
          </div>
          <hr />
        </div> 
      </div>
    </div>
  );
}
