import React, { useEffect } from "react";
import styles from "./pomodoro.module.css";

const Pomodoro = () => {
    const [habitName, setHabitName] = React.useState(sessionStorage.getItem("habit") ?? "Habit")
    // const [timeRemaining, setTimeRemaining] = React.useState(25);
    // const [started, setStarted] = React.useState(false);
    let started = false;
    let timeRemaining = 25;
    const maxTime = 25;
    let isReset = false;

    const start = () => {
        // setStarted(true);
        started = true;
        const interval = setInterval(() => {
            if (timeRemaining > 0 && !isReset) {
                if (started) {
                    timeRemaining = timeRemaining - 1;
                    document.getElementById("time-remaining").innerText = `Time Remaining: ${timeRemaining}:00`  
                    drawCanvas(25 - timeRemaining) 
                }
            } else {
                clearInterval(interval);
                if (timeRemaining <= 0) {
                    document.getElementById("time-remaining").innerText = "Times Up!"
                }
                isReset = false;
            }
        }, 1000);
    }

    const pause = () => {
        started = !started;
    }

    const reset = () => {
        started = false;
        timeRemaining = maxTime;
        drawCanvas(0);
        isReset = true;
        document.getElementById("time-remaining").innerText = `Time Remaining: ${maxTime}:00`  
    }

    const drawCanvas = (interval) => {
        const canvas = document.getElementById("canvas");
        const ctx = canvas.getContext("2d");
        ctx.clearRect(0,0,canvas.width, canvas.height);

        ctx.beginPath();
        ctx.arc(canvas.width / 2, canvas.height / 2, 50, 0, Math.PI * 2);
        ctx.strokeStyle = "#000000";
        ctx.lineWidth = 1;
        ctx.stroke();

        ctx.beginPath();
        ctx.arc(canvas.width / 2, canvas.height / 2, 3, 0, Math.PI * 2);
        ctx.fill();

        const rad = ((2 * (1/maxTime * interval)) * Math.PI) - Math.PI * 0.5
        ctx.beginPath();
        ctx.moveTo(canvas.width / 2, canvas.height / 2);
        ctx.lineTo(canvas.width / 2 + 45 * Math.cos(rad), canvas.height / 2 + 45 * Math.sin(rad));
        ctx.stroke();

        ctx.beginPath();
        ctx.arc(canvas.width / 2, canvas.height / 2, 50, - Math.PI / 2, rad);
        ctx.strokeStyle = "#FF0000";
        ctx.lineWidth = 2;
        ctx.stroke();
    }

    useEffect(() => {
        drawCanvas(25 - timeRemaining);
    }, [timeRemaining]);

    return (
        <div className={styles.pomodoro}>
            <h1>Pomodoro Timer</h1>
            <h2>{habitName}</h2>
            <canvas id="canvas" className={styles.canvas}></canvas>
            <p id="time-remaining">Time Remaining: {timeRemaining}:00</p>
            <div className={styles.flexRow}>
                <button onClick={start} id="start">Start</button>
                <button onClick={pause} id="pauseplay">Pause</button>
                <button onClick={reset} id="reset">Reset</button>
                <button onClick={() => window.close()}>Close</button>
            </div>
        </div>
    )
}

export default Pomodoro;