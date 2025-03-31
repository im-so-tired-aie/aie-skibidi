import { useEffect, useState } from "react";
import styles from "../page.module.css";

const HabitContainer = (props) => {
    const [numStreak, setNumStreak] = useState(0);
    const [habit, setHabit] = useState(props.habit);

    const determineStreak = (days) => {
        let currCounter = 0;
        let streak = 0;
        for (let i = 0; i < 7; i++) {
            if (days[i]) {
                currCounter++;
            } else {
                streak = Math.max(streak, currCounter);
                currCounter = 0;
            }
        }
        streak = Math.max(streak, currCounter);

        setNumStreak(streak);
    }

    useEffect(() => {
        determineStreak(habit.days);
    }, []);

    const updateHabitStreak = (index) => {
        const updatedHabit = { ...habit };
        updatedHabit.days[index] = !updatedHabit.days[index];
        determineStreak(updatedHabit.days);
        setHabit(updatedHabit);

        const allHabits = JSON.parse(localStorage.getItem("habits"));
        const updatedAllHabits = { ...allHabits };
        console.log(updatedAllHabits[props.habit.category], props.val)
        updatedAllHabits[props.habit.category][props.val] = updatedHabit;
        localStorage.setItem("habits", JSON.stringify(updatedAllHabits));
    }

    return (
        <div>
            <div className={`${styles.flexRow} ${styles.spaceBetween}`}>
              <div className={styles.flexRow}>
                <h3>{props.habit.title}</h3>
                <button
                  onClick={() => window.open(`/pomodoro?habit=${props.habit.title}`, "_blank", "width=300px,height=450px;")}
                >Pomo</button>
              </div>
              <button className={styles.destructive}>Delete</button>
            </div>

            <table className={styles.table}>
              <thead>
                <tr>
                    <th className={styles.tableHeader}>Mon</th>
                    <th className={styles.tableHeader}>Tue</th>
                    <th className={styles.tableHeader}>Wed</th>
                    <th className={styles.tableHeader}>Thu</th>
                    <th className={styles.tableHeader}>Fri</th>
                    <th className={styles.tableHeader}>Sat</th>
                    <th className={styles.tableHeader}>Sun</th>
                    <th className={styles.tableHeader}>Streak</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                    <td className={styles.tableCell}><input type="checkbox" checked={habit.days[0]} onChange={() => updateHabitStreak(0)} /></td>
                    <td className={styles.tableCell}><input type="checkbox" checked={habit.days[1]} onChange={() => updateHabitStreak(1)} /></td>
                    <td className={styles.tableCell}><input type="checkbox" checked={habit.days[2]} onChange={() => updateHabitStreak(2)} /></td>
                    <td className={styles.tableCell}><input type="checkbox" checked={habit.days[3]} onChange={() => updateHabitStreak(3)} /></td>
                    <td className={styles.tableCell}><input type="checkbox" checked={habit.days[4]} onChange={() => updateHabitStreak(4)} /></td>
                    <td className={styles.tableCell}><input type="checkbox" checked={habit.days[5]} onChange={() => updateHabitStreak(5)} /></td>
                    <td className={styles.tableCell}><input type="checkbox" checked={habit.days[6]} onChange={() => updateHabitStreak(6)} /></td>
                    <td className={`${styles.tableCell} ${numStreak === 7 && styles.specialCell}`}>Streak: {numStreak}</td>
                </tr>
              </tbody>
            </table>
        </div>
    )
}

export default HabitContainer;