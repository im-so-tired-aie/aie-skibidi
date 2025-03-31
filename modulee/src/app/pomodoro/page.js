"use client";
import styles from "./page.module.css"
import { useEffect } from "react";
import { useSearchParams } from "next/navigation";

const Pomodoro = () => {
    const searchParams = useSearchParams();

    useEffect(() => {
        let timer;
        let seconds = 25;
        let running = false;
        const canvas = document.getElementById("canvas");
        const ctx = canvas.getContext("2d");

        document.getElementById("time-remaining").innerText = `Time Remaining: ${seconds}s`;

        function setupCanvas(progress) {
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            // Draw Outline
            ctx.beginPath();
            ctx.arc(canvas.width/2, canvas.height/2, 40, 0, 2 * Math.PI);
            ctx.strokeStyle = "#000";
            ctx.lineWidth = 1;
            ctx.stroke();

            // Draw Centre Circle
            ctx.beginPath();
            ctx.arc(canvas.width/2, canvas.height/2, 2, 0, 2* Math.PI);
            ctx.fillStyle = "#000"
            ctx.fill();

            const angle = (progress * Math.PI) - Math.PI / 2;

            // Draw Clock Hands
            ctx.beginPath();
            ctx.moveTo(canvas.width/2, canvas.height/2);
            ctx.lineTo(canvas.width/2 + 35 * Math.cos(angle), canvas.height/2 + 35 * Math.sin(angle));
            ctx.strokeStyle = "#000";
            ctx.stroke();

            // Draw Progress
            ctx.beginPath();
            ctx.arc(canvas.width/2, canvas.height/2, 40, -(0.5 * Math.PI), angle, false);
            ctx.lineWidth = 2.5;
            ctx.strokeStyle = "#FF0000";
            ctx.stroke();
        }

        function startTimer() {
            if (running) return;
            running = true;
            timer = setInterval(() => {
                if (seconds > 0) {
                    if (running) {
                        seconds -= 1;
                        setupCanvas(2 * (1 - seconds / 25));
                        document.getElementById("time-remaining").innerText = `Time Remaining: ${seconds}s`;
                    }
                } else {
                    document.getElementById("time-remaining").innerText = `Times Up!`;
                    clearInterval(timer);
                    running = false;
                    setupCanvas(0);
                }
            }, 1000)
        }

        function pauseTimer() {
            if (running) {
                running = false
                document.getElementById("pauseplay").innerText = "Play";
            } else {
                running = true
                document.getElementById("pauseplay").innerText = "Pause";
            }
        }

        function resetTimer() {
            setupCanvas(0);
            clearInterval(timer);
            running = false;
            seconds = 25;
            document.getElementById("time-remaining").innerText = `Time Remaining: ${seconds}s`;
        }

        setupCanvas(0);


        // Add event listeners to buttons
        document.getElementById("start").addEventListener("click", startTimer)
        document.getElementById("pauseplay").addEventListener("click", pauseTimer)
        document.getElementById("reset").addEventListener("click", resetTimer)
    }, [])

    return (
        <div className={styles.container}>
            <h1>Pomodoro Timer</h1>
            <h2>{ searchParams.get("habit") }</h2>
            <canvas className={styles.canvas} id="canvas"></canvas>
            <p id="time-remaining"></p>
            <div className={styles.buttonRow}>
                <button id="start">Start</button>
                <button id="pauseplay">Pause</button>
                <button id="reset">Reset</button>
                <button>Close</button>
            </div>
        </div>
    )
}

export default Pomodoro;