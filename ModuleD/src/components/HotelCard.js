import React, { useState } from 'react';
import './HotelCard.css';

function HotelCard({ hotel, currency, exchangeRates, onReviewClick }) {
  const [currentImageIndex, setCurrentImageIndex] = useState(0);
  const nextImage = () => setCurrentImageIndex((prev) => (prev + 1) % hotel.images.length);
  const prevImage = () => setCurrentImageIndex((prev) => (prev - 1 + hotel.images.length) % hotel.images.length);
  
  // Get the exchange rate based on the hotel's currency and the selected currency
  const exchangeRate = exchangeRates[currency] / exchangeRates[hotel.currency];

  // Convert the price to the selected currency
  const convertedPrice = (hotel.price * exchangeRate).toFixed(2);
  
  return (
    <div className="card">
      <div className="image-section">
        <img src={hotel.images[currentImageIndex]} alt={hotel.name} />
        <button onClick={prevImage} className="arrow left">&lt;</button>
        <button onClick={nextImage} className="arrow right">&gt;</button>
        <div className="tag">{hotel.name}</div>
        <div className="imgCountLabel">{currentImageIndex + 1} / {hotel.images.length}</div>
      </div>
      
      <div className="content">
        <div className="details">
          <h3>{hotel.name}</h3>
          <div className="rating">Rating: {hotel.rating} / 5.0</div>
          <small>{hotel.reviewCount} Based on {hotel.reviewCount} reviews</small>
          <br></br>
          <small>{hotel.distance} miles</small>
          <p>Total Amentities: {hotel.amentities}</p>
        </div>
        
        <div className="price">
          <div>
            <p>From*</p>
            <div className="amount">${convertedPrice} {currency}</div>
          </div>
          <button className="reviewBtn" onClick={onReviewClick}>Reviews</button>
        </div>
      </div>
    </div>
  );
}

export default HotelCard;