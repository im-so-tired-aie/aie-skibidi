import { Suspense, useEffect, useState } from "react";
import styles from "./hotel.module.css";

export default function HotelDetail({hotel, currency, exchangeRate}) {
    const [index, setIndex] = useState(0);
    const [rating, setRating] = useState(0);
    const [price, setPrice] = useState(hotel.price);

    useEffect(() => {
        let rating = 0;
        for (let i = 0; i < hotel.userReviews.length; i++) {
            rating += hotel.userReviews[i].rating;
        }
        setRating(Math.round(rating / hotel.userReviews.length));
    }, []);

    useEffect(() => {
        setPrice(Math.round(hotel.price * exchangeRate * 100) / 100);
    }, [exchangeRate])

    return (
        <div className={styles.container}>
            <Suspense fallback={<div>Loading...</div>}>
                <Image imageUrls={hotel.images} index={index} name={hotel.name} />
            </Suspense>
            <div className={styles.infoContainer}>
                <p className={styles.title}>{hotel.name}</p>
                <div className={styles.flexRow}>
                    <div>
                        <div>
                            <p className={styles.smol}>{hotel.distance} miles</p>
                            <p><b>Rating: {rating} out of 5.0</b></p>
                            <p className={styles.smol}>Based on {hotel.userReviews.length} reviews</p>
                        </div>
                        <br />
                        <p>Total Amenities: {hotel.amentities}</p>
                    </div>

                    <div className={styles.priceContainer}>
                        <p><b>From* <span className={styles.price}>${price} {currency}</span></b></p>
                        <button className={styles.button}>Reviews</button>
                    </div>
                </div>
            </div>
        </div>
    );
}

function Image({imageUrls, index, name}) {
    return (
        <div className={styles.imageContainer}>
            <div>
                <img className={styles.image} src={imageUrls[index]} alt={`Image ${index + 1}`} />
            </div>
            <div className={styles.overlay}>
                <p>{name}</p>
            </div>
        </div>
    )
}