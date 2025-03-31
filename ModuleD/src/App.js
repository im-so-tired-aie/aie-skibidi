import "./App.css";
import { useState, useEffect } from "react";
import { mockExchangeRates } from './mockData/mockExchangeData';
import { mockHotels } from "./mockData/mockHotelData";
import HotelCard from "./components/HotelCard";
import ReviewPopup from "./components/ReviewPopup";

function App() {
  const [hotels, setHotels] = useState([]);
  const [exchangeRates, setExchangeRates] = useState({});
  const [sortBy, setSortBy] = useState('distance');
  const [currency, setCurrency] = useState('USD');
  const [selectedHotel, setSelectedHotel] = useState(null);

  useEffect(() => {
    // SUPPOSE TO FETCH THEIR API HERE  
    // fetch('http://wsXX.worldskills.org/webwanderer/module_d_api-cors-version.php/hotel.json')
    // .then(response => response.json())
    // .then(data => setHotels(data));

    // fetch('http://wsXX.worldskills.org/webwanderer/module_d_api-cors-version.php/exchange.json')
    //   .then(response => response.json())
    //   .then(data => setExchangeRates(data));

    mockHotels.map((hotel) =>{
      let hotelRating = 0;
      hotel.userReviews.forEach(review => {
        hotelRating += parseFloat(review.rating);
      });
      hotelRating = (hotelRating / hotel.userReviews.length).toFixed(2);
      console.log(hotelRating);
      hotel.rating = hotelRating;
    })

    setHotels(mockHotels);
    setExchangeRates(mockExchangeRates);
  }, []);

  const sortedHotels = [...hotels].sort((a, b) => {
    if (sortBy === 'distance'){
      return parseFloat(a.distance) - parseFloat(b.distance);
    }
    else if (sortBy === 'amentities-lh'){
      return parseInt(a.amentities) - parseInt(b.amentities);
    }
    else if (sortBy === 'amentities-hl'){
      return parseInt(b.amentities) - parseInt(a.amentities);
    }
    else if (sortBy === 'price-lh'){
      return parseFloat(a.price) - parseFloat(b.price);
    }
    else if (sortBy === 'price-hl'){
      return parseFloat(b.price) - parseFloat(a.price);
    }
    else if (sortBy === 'rating-lh'){
      return parseFloat(a.rating) - parseFloat(b.rating);
    }
    else if (sortBy === 'rating-hl'){
      return parseFloat(b.rating) - parseFloat(a.rating);
    }
  });

  return (
    <div className="container">
      {/* Dropdowns */}
      <div className="header">
        <div className="dropdownContainer">
          <label>Sort by</label>
          <select onChange={(e) => setSortBy(e.target.value)}>
            <option value="distance">Distance</option>
            <option value="amentities-lh">Amentities: low-high</option>
            <option value="amentities-hl">Amentities: high-low</option>
            <option value="price-lh">Price: low-high</option>
            <option value="price-hl">Price: high-low</option>
            <option value="rating-lh">Rating: low-high</option>
            <option value="rating-hl">Rating: high-low</option>
          </select>
        </div>
        <div className="dropdownContainer">
          <label>Select currency</label>
          <select onChange={(e) => setCurrency(e.target.value)}>
            {Object.keys(exchangeRates).map((currencyCode) => (
              <option key={currencyCode} value={currencyCode}>
                {currencyCode}
              </option>
            ))}
          </select>
        </div>
      </div>

      {/* Hotel Listings */}
      <div className="hotelSection">
        <h2>Hotels in Singapore</h2>
        <div className="hotelRows">
        {sortedHotels.slice(0, 5).map(hotel => (
          <HotelCard 
            key={hotel.id} 
            hotel={hotel} 
            currency={currency} 
            exchangeRates={exchangeRates} 
            onReviewClick={() => {
              setSelectedHotel(hotel);
            }}
          />
        ))}
        </div>
      </div>

      {/* Reviews Popup */}
      {selectedHotel && (
        <ReviewPopup 
          hotel={selectedHotel} 
          onClose={() => setSelectedHotel(null)} 
        />
      )}
    </div>
  );
}

export default App;
