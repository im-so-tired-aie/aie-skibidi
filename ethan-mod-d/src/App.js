import { useEffect, useState } from 'react';
import './App.css';

// Mock Data
import { mockExchangeRates } from './sampledata/mockExchangeData';
import { mockHotels } from './sampledata/mockHotelData';
import HotelDetail from './components/hotel';

function App() {
  const [exchangeRates, setExchangeRates] = useState({});
  const [selectedCurrency, setSelectedCurrency] = useState("USD");
  const [sortOption, setSortOption] = useState('distance');
  const [hotels, setHotels] = useState([]);

  const sort = (val) => {
    val.sort((a,b) => {
      switch (sortOption) {
        case "distance":
          return a.distance - b.distance;
        case "amenities-lh":
          return a.amentities - b.amentities;
        case "amenities-hl":
          return b.amentities - a.amentities;
        case "price-lh":
          return a.price - b.price;
        case "price-hl":
          return b.price - a.price;
        case "rating-lh":
          return (a.userReviews.reduce((acc, cur) => acc + cur.rating,0)/a.userReviews.length) - (b.userReviews.reduce((acc, cur) => acc + cur.rating,0)/b.userReviews.length);
        case "rating-hl":
          return (b.userReviews.reduce((acc, cur) => acc + cur.rating,0)/b.userReviews.length) - (a.userReviews.reduce((acc, cur) => acc + cur.rating,0)/a.userReviews.length);
      }
    })
    return val;
  }

  useEffect(() => {
    const fetchExchangeRates = async () => {
      // const res = await fetch("wsXX.worldskills.org/webwanderer/module_d_api-cors-version.php/exchange.json");
      // const json = await res.json();

      // MOCK THE FUNCTIOOOOOn
      const json = mockExchangeRates;
      setExchangeRates(json);
    };

    const fetchHotels = async () => {
      // const res = await fetch("wsXX.worldskills.org/webwanderer/module_d_api-cors-version.php/hotel.json");
      // const json = await res.json();

      // MOCK THE FUNCTIOOOOOn
      const json = mockHotels;
      setHotels(json);
    }

    fetchExchangeRates();
    fetchHotels();
  }, [])

  useEffect(() => {
    if (hotels.length !== 0) {
      setHotels(sort([...hotels]))
    }
  }, [sortOption, hotels])

  // if (Object.keys(exchangeRates).length === 0 || hotels.length === 0) {
  //   return (
  //     <div className='main'>
  //       <h2>Loading Data...</h2>
  //     </div>
  //   );
  // }

  return (
    <div className='main'>
      <div className='flex-row border'>
        <div>
          <p><b>Sort by</b></p>
          <select value={sortOption} onChange={(e) => setSortOption(e.target.value)}>
            <option value="distance">Distance</option>
            <option value="amenities-lh">Amenities: low-high</option>
            <option value="amenities-hl">Amenities: high-low</option>
            <option value="price-lh">Price: low-high</option>
            <option value="price-hl">Price: high-low</option>
            <option value="rating-lh">Ratings: low-high</option>
            <option value="rating-hl">Ratings: high-low</option>
          </select>
        </div>

        <div>
          <p><b>Select currency</b></p>
          <select value={selectedCurrency} onChange={(e) => setSelectedCurrency(e.target.value)}>
            { Object.keys(exchangeRates).map((currency) => (
              <option key={currency} value={currency}>{currency}</option>
            ))}
          </select>
        </div>
      </div>

      <div className='content'>
        <h2>Hotels in Miami</h2>

        <div className='flex-row overflow'>
            {hotels.map((hotel, index) => (
              <HotelDetail hotel={hotel} key={index} currency={selectedCurrency} exchangeRate={exchangeRates[selectedCurrency]} />
            ))}
        </div>
      </div>
    </div>
  );
}

export default App;
