import React from 'react';
import styles from './habitrow.module.css';

const HabitRow = ({ habit, setHabit, deleteHabit }) => {
    const [streak, setStreak] = React.useState(0);

    const calcStreak = () => {
        let max = 0;
        let current = 0;
        for (let i = 0; i < habit.streak.length + 1; i++) {
            if (habit.streak[i]) {
                current += 1;
            } else {
                if (current > max) {
                    max = current;
                    current = 0;
                }
            }
        }
        setStreak(max);
    }

    const updateStreak = (index) => {
        const newHabit = { ...habit };
        newHabit.streak[index] = !newHabit.streak[index];
        setHabit(newHabit)
        calcStreak()
    }

    React.useEffect(() => {
        calcStreak();
    }, [habit]);

    return (
        <div className={styles.habitRow}>
            <div className={styles.flexRowSB}>
                <div className={styles.flexRow}>
                    <p><b>{habit.title}</b></p>
                    <button>Timer</button>
                </div>

                <button className={styles.deleteBtn} onClick={() => deleteHabit(habit)}>Delete</button>
            </div>
            <table className={styles.table}>
                <thead>
                    <tr>
                        <th>Mon</th>
                        <th>Tue</th>
                        <th>Wed</th>
                        <th>Thu</th>
                        <th>Fri</th>
                        <th>Sat</th>
                        <th>Sun</th>
                        <th>Streak</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input checked={habit.streak[0]} onChange={() => updateStreak(0)} type='checkbox'/></td>
                        <td><input checked={habit.streak[1]} onChange={() => updateStreak(1)} type='checkbox'/></td>
                        <td><input checked={habit.streak[2]} onChange={() => updateStreak(2)} type='checkbox'/></td>
                        <td><input checked={habit.streak[3]} onChange={() => updateStreak(3)} type='checkbox'/></td>
                        <td><input checked={habit.streak[4]} onChange={() => updateStreak(4)} type='checkbox'/></td>
                        <td><input checked={habit.streak[5]} onChange={() => updateStreak(5)} type='checkbox'/></td>
                        <td><input checked={habit.streak[6]} onChange={() => updateStreak(6)} type='checkbox'/></td>
                        <td className={`${styles.streakCell} ${streak === 7 ? styles.highlighted : ""}`}>Streak: {streak}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    );
}

export default HabitRow;